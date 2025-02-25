<?php

namespace App\Http\Controllers;

use App\Models\CommunityProject;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CommunityProjectController extends Controller
{
    public function projects()
    {
        $periodController = new AcademicPeriodController();
        $periods = $periodController->fetch();
        return Inertia::render('Internships/Community/Projects/Index', [
            'periods' => $periods
        ]);
    }

    public function apiIndex()
    {
        $query = CommunityProject::where('community_projects.status', 1)
            ->leftJoin('academic_periods', 'community_projects.academic_period_id', '=', 'academic_periods.id')
            ->select(
                'community_projects.*',
                'academic_periods.period as academic_period_name'
            )
            ->get();

        return response()->json($query);
    }

    public function store(Request $request)
    {
        $course = CommunityProject::create(attributes: $request->all());
        return response()->json($course, 201);
    }

    public function update(Request $request, $project_id)
    {
        $project = $this->fetchByProjectId($project_id);
        $project->update($request->all());
        return response()->json($project);

    }

    public function destroy(CommunityProject $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }
    public function remove($id)
    {
        $project = CommunityProject::findOrFail($id);
        $project->update(['status' => 0]);
        return response()->json(null, 204);
    }

    // For project files
    public function apiProjectFiles($project_id)
    {
        $files = CommunityProject::where('id', $project_id)->first();
        $fileArray = json_decode($files, true);

        $files = [
            ["id" => 1, "file" => "Informe del proyecto", "file_id" => $fileArray['project_report_id']],
        ];

        if (request()->wantsJson()) {
            return response()->json(['files' => $files]);
        }

        return back()->with(['files' => $files]);
    }

    public function storeFile(Request $request, $parentId)
    {
        $fileController = new FileController();
        $fileController->store($request, $parentId);
        $fileId = $fileController->getLastId();

        $projectFile = CommunityProject::where('id', $request['project_id'])->first();

        $file_column = $request['project_files_id'];

        switch ($file_column) {
            case 1:
                $projectFile->project_report_id = $fileId;
                break;
        };

        $projectFile->save();
    }

    public function fetchByProjectId($project_id)
    {
        return CommunityProject::where('id', $project_id)->first();
    }

    public function fetch()
    {
        $statuses = CommunityProject::where('status', 1)->get();
        return $statuses;
    }

    public function getSentDocumentation($id)
    {
        $query = CommunityProject::where('community_projects.academic_period_id', '=', $id)
            ->select(
                'community_projects.*',
            )
            ->get();

        $query->each(function ($item) {
            $item->project_report_is_null = !is_null($item->project_report_id) ? true : false;
        });

        return response()->json($query);
    }
}
