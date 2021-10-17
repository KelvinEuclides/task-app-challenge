<?php

namespace App\Http\Controllers;

use App\Models\Model\Projects;
use App\Models\Model\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //List all tasks by Priority
        $tasks = Tasks::orderBy('priority', 'desc')->get();
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
        //Creating Tasks
        $v = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'priority' => 'required|numeric',
            'project' => 'numeric'
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
                "message" => "Task record created"
            ], 201);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Model\Tasks $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Model\Tasks $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $tasks)
    {
        //Editing  Task


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Model\Tasks $tasks
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Tasks $tasks)
    {
        //Updating Tasks
        $v = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'priority' => 'required|numeric',
        ]);

        if ($v->fails()) {
            return response()->json([
                "message" => $v->errors()
            ], 422);
        } else {
            //Store Projects
            $tasks->fill($request->validated());
            try {
                $tasks->saveOrFail();
            } catch (\Exception $exception) {
                return response()->json([
                    "message" => $exception
                ], 500);
            }
            return response()->json([
                "message" => "Task record created"
            ], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Model\Tasks $tasks
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Tasks $tasks)
    {
        //Des task
        try {
            $tasks->deleteOrFail();
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
