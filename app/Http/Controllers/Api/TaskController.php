<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Taskrequest;
use App\Http\Requests\UpdateTaskeRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::all();
        return ApiResponse::sendResponse(200, 'Success', $tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Taskrequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $task = Task::create($validated);
        return ApiResponse::sendResponse(200, 'Success', $task);
     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $task = Task::find($id);
        return ApiResponse::sendResponse(200, 'Success', $task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskeRequest $request, string $id)
    {
        $task = Task::findOrFail($id);
        $validated = $request->validated();
        $task->update($validated);
        return ApiResponse::sendResponse(200, 'Success', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $task = Task::findOrFail($id);
        $task->delete();
        return ApiResponse::sendResponse(200, 'Success', null);
    }
}
