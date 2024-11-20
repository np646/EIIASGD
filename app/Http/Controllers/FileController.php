<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class FileController extends Controller
{
    public function index($parentId = null)
    {
        if (is_null($parentId)) {
            $files = File::whereNull('parent_id')->get();
        } else {
            $files = File::where('parent_id', $parentId)->get();
        }

        return inertia('Graduation/StudentFiles', [
            'files' => $files,
            'parentId' => $parentId,
        ]);
    }

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
        $file->created_by = Auth::id();

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
            $storagePath ="uploads/{$file->path}";
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

        //return redirect()->route('files.index', ['parentId' => $file->parent_id]);
       // return redirect()->back()->with('success', 'Ha sido creado exitosamente.');
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

    public function destroy($id)
    {
        $file = File::findOrFail($id);
        if ($file->path && Storage::exists($file->path)) {
            Storage::delete($file->path);
        }
        $file->delete();

        return redirect()->back()->with('success', 'Ha sido eliminado exitosamente.');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        return response()->download(storage_path("app/uploads/{$file->path}"));
    }

    public function open($id)
    {
        $file = File::findOrFail($id);
        return response()->file(storage_path("app/uploads/{$file->path}"));
    }

    public function getLastId(){
        $fileId = File::latest()->pluck('id')->first();        
        return $fileId;
    }
}
