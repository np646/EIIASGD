<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{

    public function store(Request $request, $parentId = null)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_folder' => 'required|boolean',
            'file' => 'nullable|file',
        ]);

        // Create file or folder in database
        $file = new File();
        $file->name = $request->name;
        $file->is_folder = $request->is_folder;
        $file->parent_id = $parentId ?: null;
        $file->student_id = $request->student_id;
        $file->created_by = Auth::id();
        $file->updated_by = Auth::id();

        if ($parentId) {
            $parentFile = File::find($parentId);
            $parentPath = $parentFile->path;
            $file->path = $parentPath . $parentFile->id . '/';
        } else {
            $file->level = 1;
            $file->path = 'uploads/';
        }

        $file->save();

        // Store the file
        if ($request->hasFile('file')) {
            $fileToUpload = $request->file('file');
            $storagePath = "uploads/{$file->path}";
            $filePath = "{$file->path}";

            Storage::putFileAs($storagePath, $fileToUpload, $fileToUpload->getClientOriginalName());
            $file->path = $filePath . $fileToUpload->getClientOriginalName();
            $file->save();
        }

        // Generate level   
        $path = $file->path;
        $pathSegments = explode('/', $path);
        $file->level = count($pathSegments);
        $file->save();
    }

    public function update(Request $request, $id)
    {
        // This method only works to change the filename in the database
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $file = File::findOrFail($id);
        $file->name = $request->input('name');
        $file->updated_by = Auth::id();
        $file->save();

        return redirect()->back()->with('success', 'Ha sido actualizado exitosamente.');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        return response()->download(storage_path("app/uploads/{$file->path}"));
    }

    public function open($file_id)
    {
        $file = File::findOrFail($file_id);
        return response()->file(storage_path("app/uploads/{$file->path}"));
    }

    public function getLastId()
    {
        $fileId = File::latest()->pluck('id')->first();
        return $fileId;
    }

    // For graduation files

    public function destroyGraduation($student_id, $index, $file_id)
    {
        $file = File::findOrFail($file_id);

        $file->status = 0;
        $file->save();

        $graduationFilesController = new GraduationFilesController();
        $graduation_file = $graduationFilesController->fetchByStudentId($student_id);
        $columnName = "";

        switch ($index) {
            case 1:
                $columnName = "international_cert_id";
                break;
            case 2:
                $columnName = "english_cert_id";
                break;
            case 3:
                $columnName = "community_internship_id";
                break;
            case 4:
                $columnName = "preprofessional_internship_id";
                break;
            case 5:
                $columnName = "graduation_type_id";
                break;
            case 6:
                $columnName = "readers_id";
                break;
            case 7:
                $columnName = "plan_approval_id";
                break;
        };
        $graduation_file->update([$columnName => null]);

        $graduation_file->save();

        return redirect()->back()->with('success', 'Ha sido eliminado exitosamente.');
    }

    // For preprofessional internship files

    public function destroyPreprofessional($student_id, $index, $file_id)
    {
        $file = File::findOrFail($file_id);
        $file->status = 0;
        $file->save();

        $preprofessionalController = new PreprofessionalController();
        $preprofessional_file = $preprofessionalController->fetchByStudentId($student_id);
        $columnName = "";

        switch ($index) {
            case 1:
                $columnName = "external_cert_id";
                break;
            case 2:
                $columnName = "student_report_id";
                break;
            case 3:
                $columnName = "banner_cert_id";
                break;
        };

        $preprofessional_file->update([$columnName => null]);
        return redirect()->back()->with('success', 'Ha sido eliminado exitosamente.');
    }

    // For community internship files
    public function destroyCommunity($student_id, $index, $file_id)
    {
        $file = File::findOrFail($file_id);
        $file->status = 0;
        $file->save();

        $communityController = new CommunityController();
        $community_file = $communityController->fetchByStudentId($student_id);
        $columnName = "";

        switch ($index) {
            case 1:
                $columnName = "student_report_id";
                break;
        };

        $community_file->update([$columnName => null]);
        return redirect()->back()->with('success', 'Ha sido eliminado exitosamente.');
    }

    // For community project files
    public function destroyProject($project_id, $index, $file_id)
    {
        $file = File::findOrFail($file_id);
        $file->status = 0;
        $file->save();

        $projectController = new CommunityProjectController();
        $project_file = $projectController->fetchByProjectId($project_id);
        $columnName = "";

        switch ($index) {
            case 1:
                $columnName = "project_report_id";
                break;
        };

        $project_file->update([$columnName => null]);
        return redirect()->back()->with('success', 'Ha sido eliminado exitosamente.');
    }

    // For file info
    public function fileInfo($id)
    {
        $file = File::where('files.id', $id)
            ->join('users as creator', 'files.created_by', '=', 'creator.id')
            ->join('users as updater', 'files.updated_by', '=', 'updater.id')
            ->select(
                'files.name',
                'creator.name as created_by_name',
                'files.created_at',
                'updater.name as updated_by_name',
                'files.updated_at'
            )
            ->first();

        if ($file) {
            // Convert the file object to an array
            $data = $file->toArray();

            // Format the timestamps
            $data['created_at'] = $file->created_at->format('Y-m-d H:i:s');
            $data['updated_at'] = $file->updated_at->format('Y-m-d H:i:s');

            return response()->json($data);
        }

        return response()->json(null, 404);
    }
}
