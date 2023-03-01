<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                // 'coordinate'=> ['required'],
                // 'type'=> ['required'],
                // 'name_en'=> ['required', 'max:100'],
                // 'description_en' => ['required'],
                'name_id'=> ['required', 'max:100'],
                'description_id' => ['required'],
                'start_date' => ['required'],
                'end_date' => [Rule::requiredIf($request->status == 'finished'), 'after_or_equal:start_date'],
                'status' => ['required'],
                'image' => ['required', 'image', 'file', 'max:1024'],
            ],
            [],
            [
                // 'coordinate' => __('attributes.coordinate'),
                // 'type' => __('attributes.type'),
                // 'name_en' => __('attributes.name_en'),
                // 'description_en' => __('attributes.description_en'),
                'name_id' => __('attributes.name_id'),
                'description_id' => __('attributes.description_id'),
                'start_date' => __('attributes.start_date'),
                'end_date' => __('attributes.end_date'),
                'status' => __('attributes.status'),
                'image' => __('attributes.image'),
            ],
        )->validate();

        $attributes = [
            // 'coordinate' => $request->coordinate,
            // 'type' => $request->type,
            // 'name_en' => $request->name_en,
            // 'description_en' => $request->description_en,
            'name_id' => $request->name_id,
            'description_id' => $request->description_id,
            'start_date' => $request->start_date,
            'status' => $request->status,
            'image' => $request->file('image')->store('project-image'),
            'slug' => Str::of($request->name_en)->slug('-'),
        ];

        if ($request->end_date) {
            $attributes['end_date']= $request->end_date;
        }

        Project::create($attributes);

        Alert::toast('Sukses Menambah Data', 'success');

        return redirect()->to(route('admin.project.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view(
            'admin.projects.edit',
            ['project' => $project],
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        Validator::make(
            $request->all(),
            [
                // 'coordinate'=> ['required'],
                // 'type'=> ['required'],
                // 'name_en'=> ['required', 'max:100'],
                // 'description_en' => ['required'],
                'name_id'=> ['required', 'max:100'],
                'description_id' => ['required'],
                'start_date' => ['required'],
                'end_date' => [Rule::requiredIf($request->status == 'finished'), 'after_or_equal:start_date'],
                'status' => ['required'],
                'image' => ['image', 'file', 'max:1024'],
            ],
            [],
            [
                // 'coordinate' => __('attributes.coordinate'),
                // 'type' => __('attributes.type'),
                // 'name_en' => __('attributes.name_en'),
                // 'description_en' => __('attributes.description_en'),
                'name_id' => __('attributes.name_id'),
                'description_id' => __('attributes.description_id'),
                'start_date' => __('attributes.start_date'),
                'end_date' => __('attributes.end_date'),
                'status' => __('attributes.status'),
                'image' => __('attributes.image'),
            ],
        )->validate();

        $attributes = [
            // 'coordinate' => $request->coordinate,
            // 'type' => $request->type,
            // 'name_en' => $request->name_en,
            // 'description_en' => $request->description_en,
            'name_id' => $request->name_id,
            'description_id' => $request->description_id,
            'start_date' => $request->start_date,
            'status' => $request->status,
            'slug' => Str::of($request->name_en)->slug('-'),
        ];

        if ($request->end_date) {
            $attributes['end_date']= $request->end_date;
        }

        if ($request->file('image')) {
            Storage::delete($project->image);
            $attributes['image'] = $request->file('image')->store('project-image');
        }

        $project->update(attributes: $attributes);

        Alert::toast('Sukses Update Data', 'success');

        return redirect()->to(route('admin.project.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        
        if ($project->delete()) {
            Storage::disk('public')->delete($project->image);
            $response = array(
                'status' => 'success',
                'message' => 'Projek berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Projek tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(Project::query())->make(true);
    }
}
