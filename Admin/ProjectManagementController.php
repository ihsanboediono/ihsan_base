<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProjectManagement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProjectManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            view: 'pages.about-project.index',
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            view: 'pages.about-project.add',
        );
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
            data: $request->all(),
            rules: [
                'title_id'=> ['required', 'max:100'],
                'title_en'=> ['required', 'max:100'],
                'description_id' => ['required'],
                'description_en' => ['required'],
                'icon' => ['required', 'image', 'file', 'max:1024'],
            ],
            messages: [
                'title_id'=> __('attributes.title_id'),
                'title_en'=> __('attributes.title_en'),
                'description_id' => __('attributes.description_id'),
                'description_en' => __('attributes.description_en'),
                'icon' => __('attributes.icon'),
            ],
        )->validate();

        ProjectManagement::create([
            'title_id'=> $request->title_id,
            'title_en'=> $request->title_en,
            'description_id' => $request->description_id,
            'description_en' => $request->description_en,
            'icon' => $request->file('icon')->store('project-management-icon'),
        ]);

        Alert::toast('Sukses Menambah Data', 'success');

        return redirect()->to(route('admin.project-management.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectManagement  $projectManagement
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectManagement $projectManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectManagement  $projectManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectManagement $projectManagement)
    {
        return view(
            view: 'pages.about-project.edit',
            data: ['projectManagement' => $projectManagement],
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectManagement  $projectManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectManagement $projectManagement)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'title_id'=> ['required', 'max:100'],
                'title_en'=> ['required', 'max:100'],
                'description_id' => ['required'],
                'description_en' => ['required'],
                'icon' => ['image', 'file', 'max:1024'],
            ],
            messages: [
                'title_id'=> __('attributes.title_id'),
                'title_en'=> __('attributes.title_en'),
                'description_id' => __('attributes.description_id'),
                'description_en' => __('attributes.description_en'),
                'icon' => __('attributes.icon'),
            ],
        )->validate();

        $attributes = [
            'title_id'=> $request->title_id,
            'title_en'=> $request->title_en,
            'description_id' => $request->description_id,
            'description_en' => $request->description_en,
        ];

        if ($request->file('icon')) {
            Storage::delete($projectManagement->icon);
            $attributes['icon'] = $request->file('icon')->store('project-management-icon');
        }

        $projectManagement->update(attributes: $attributes);

        Alert::toast('Sukses Update Data', 'success');

        return redirect()->to(route('admin.project-management.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectManagement  $projectManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectManagement $projectManagement)
    {
        Storage::delete($projectManagement->icon);
        $projectManagement->delete();
        return 'success';
    }

    public function data()
    {
        return DataTables::of(ProjectManagement::query())->make(true);
    }
}
