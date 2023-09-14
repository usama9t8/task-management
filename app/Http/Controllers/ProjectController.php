<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Projects/Index', [
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
        return Inertia::render('Projects/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectRequest  $request
     * @return \Inertia\Response
     */
    public function store(ProjectRequest $request)
    {
        Project::create($request->all());
        return redirect(route('projects.index'))->with('success', 'Project Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Inertia\Response
     */
    public function show(Project $project)
    {
        return Inertia::render('Projects/Edit', ['project' => $project, 'update' => false]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Inertia\Response
     */
    public function edit(Project $project)
    {
        return Inertia::render('Projects/Edit', ['project' => $project, 'update' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Inertia\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->all());
        return redirect(route('projects.index'))->with('success', 'Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Inertia\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect(route('projects.index'))->with('warning', 'Project Deleted Successfully');
    }
}