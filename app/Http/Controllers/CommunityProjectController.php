<?php

namespace App\Http\Controllers;

use App\Models\CommunityProject;
use Inertia\Inertia;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

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

        $query = CommunityProject::join('academic_periods', 'community_projects.academic_period_id', '=', 'academic_periods.id')
            ->select(
                'community_projects.*',
                'academic_periods.period as academic_period_name'
            )
            ->get();

        return response()->json($query);
       // return back()->with($query);
        /*return response()->json(CommunityProject::all());*/
    }

    public function store(Request $request)
    {
        /* $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'academic_period_id' => 'required|string|max:255',
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
*/
        $course = CommunityProject::create(attributes: $request->all());
        return response()->json($course, 201);
    }

    public function update(Request $request, CommunityProject $project)
    {
        /* $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'banner_code' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
*/
        $project->update($request->all());
        return response()->json($project);
    }

    public function destroy(CommunityProject $project)
    {
        $project->delete();
        return response()->json(null, 204);
    }

}
