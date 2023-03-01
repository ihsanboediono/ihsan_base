<?php

namespace App\Http\Controllers\Admin;

use App\Models\Management;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.management.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.management.add');
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
                'name' => ['required'],
                'position_id' => ['required'],
                // 'position_en' => ['required'],
                'image' => ['required', 'image', 'file', 'max:1024'],
            ],
            [], 
            [
                'name'=> __('attributes.name'),
                'position_id'=> __('attributes.position_id'),
                // 'position_en'=> __('attributes.position_en'),
                'image' => __('attributes.image'),
            ],
        )->validate();

        $attributes = [
            'name' => $request->name,
            'position_id' => $request->position_id,
            // 'position_en' => $request->position_en,
            'image' => $request->file('image')->store('management-image'),
        ];


        if (Management::create($attributes)) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        

        Alert::toast('Sukses Menambah Data', 'success');

        return redirect()->to(route('admin.management.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Management  $management
     * @return \Illuminate\Http\Response
     */
    public function show(Management $management)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Management  $management
     * @return \Illuminate\Http\Response
     */
    public function edit(Management $management)
    {
        return view('admin.management.edit', ['management' => $management]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Management  $management
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Management $management)
    {
        Validator::make(
            $request->all(),
            [
                'name' => ['required'],
                'position_id' => ['required'],
                // 'position_en' => ['required'],
                'image' => ['image', 'file', 'max:1024'],
            ],
            [], 
            [
                'name'=> __('attributes.name'),
                'position_id'=> __('attributes.position_id'),
                // 'position_en'=> __('attributes.position_en'),
                'image' => __('attributes.image'),
            ],
        )->validate();

        $attributes = [
            'name' => $request->name,
            'position_id' => $request->position_id,
            // 'position_en' => $request->position_en,
        ];

        if ($request->file('image')) {
            Storage::disk('public')->delete($management->image);
            $attributes['image'] = $request->file('image')->store('management-image');
        }

        if ($management->update($attributes)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }


        return redirect()->to(route('admin.management.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Management  $management
     * @return \Illuminate\Http\Response
     */
    public function destroy(Management $management)
    {
        
        if ($management->delete()) {
            Storage::disk('public')->delete($management->image);
            $response = array(
                'status' => 'success',
                'message' => 'Manajemen berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Manajemen tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(Management::query())->make(true);
    }
}
