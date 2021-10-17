<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Model\Projects;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //List All Projects
        $projects = Projects::all();
        return Response::json($projects, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //Creating Projects
        $v = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($v->fails()) {
            return response()->json([
                "message" => $v->errors()
            ], 422);
        } else {
            //Store Projects
            $project = new Projects();
            $project->fill($request->validated());
            try {
                $project->saveOrFail();
            } catch (\Exception $exception) {
                return response()->json([
                    "message" => $exception
                ], 500);
            }
            return response()->json([
                "message" => "Project record created"
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Model\Projects $projects
     * @return \Illuminate\Http\Response
     */
    public function show(Projects $projects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Model\Projects $projects
     * @return \Illuminate\Http\Response
     */
    public function edit(Projects $projects)
    {
        //Edit Projects


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Model\Projects $projects
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProjectRequest $request, Projects $project)
    {
        //Update Project
        $v = Validator::make($request->all(), [
            'name' => 'required|min:10|max:255',
        ]);

        if ($v->fails()) {
            return response()->json([
                "message" => $v->errors()
            ], 422);
        } else {
            //Store Projects
            $project->fill($request->validated());
            try {
                $project->saveOrFail();
            } catch (\Exception $exception) {
                return response()->json([
                    "message" => $exception
                ], 500);
            }

            return response()->json([
                "message" => "Project record Updated"
            ], 201);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Model\Projects $projects
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Projects $project)
    {
        //Delete Record
        try {
            $project->deleteOrFail();
            return response()->json([
                "message" => "Project record Deleted"
            ], 500);
        } catch (\Exception $exception) {
            return response()->json([
                "message" => $exception
            ], 500);
        }
    }
}
