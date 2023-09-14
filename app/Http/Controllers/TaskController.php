<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::query();

        if ($request->has('project_id')) {
            $tasks = Task::where('project_id', $request->get('project_id'));
        }

        return Inertia::render('Tasks/Index', [
            'tasks' => $tasks->orderBy('priority')->with('project')->get(),
            'projects' => Project::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $task = Task::orderBy('priority', 'DESC')->first();
        return Inertia::render('Tasks/Create', [
            'projects' => Project::all(),
            'priority' => $task ? $task->priority + 1 : 1
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskRequest  $request
     * @return \Inertia\Response
     */
    public function store(TaskRequest $request)
    {
        Task::create($request->all());
        return redirect(route('tasks.index'))->with('success', 'Task Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Inertia\Response
     */
    public function show(Task $task)
    {
        return Inertia::render('Tasks/Edit', ['task' => $task, 'projects' => Project::all(), 'update' => false]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Inertia\Response
     */
    public function edit(Task $task)
    {
        return Inertia::render('Tasks/Edit', ['task' => $task, 'projects' => Project::all(), 'update' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Inertia\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->all());
        return redirect(route('tasks.index'))->with('success', 'Task Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Inertia\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect(route('tasks.index'))->with('warning', 'Task Deleted Successfully');
    }

    /**
     * Update the priority of tasks.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function updateOrder(Request $request)
    {
        $tasks = $request->all();
        foreach ($tasks as $key => $task) {
            Task::find($task['id'])->update(['priority' => $key + 1]);
        }
    }
}