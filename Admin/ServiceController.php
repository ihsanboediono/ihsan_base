<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.services.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.add');
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
                'name_id' => ['required'],
                'description_id' => ['required'],
                'image'=>['image','file','max:1024'],
                'icon'=>['image','file','max:1024'],
                // 'description_en' => ['required'],
                // 'name_en' => ['required'],
            ],
            [

            ],
            [
                'name_id'=> __('attributes.name_id'),
                'description_id' => __('attributes.description_id'),
                'icon' => __('attributes.icon'),
                'image' => __('attributes.image'),
                // 'name_en'=> __('attributes.name_en'),
                // 'description_en' => __('attributes.description_en'),
            ],
        )->validate();
        

        $insert = Service::create([
            'name_id' => $request->name_id,
            // 'name_en' => $request->name_en,
            'description_id' => $request->description_id,
            // 'description_en' => $request->description_en,
            'image' => !empty($request->file('image')) ? $request->file('image')->store('service') : 'service/default.png',
            'icon' => !empty($request->file('icon')) ? $request->file('icon')->store('service/icon') : 'service/icon/default.png',
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('admin.service.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return redirect()->to(route('admin.service.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {

        Validator::make(
            $request->all(),
            [
                'name_id' => ['required'],
                'description_id' => ['required'],
                // 'description_en' => ['required'],
                // 'name_en' => ['required'],
            ],
            [

            ],
            [
                'name_id'=> __('attributes.name_id'),
                'description_id' => __('attributes.description_id'),
                'icon' => __('attributes.icon'),
                'image' => __('attributes.image'),
                // 'name_en'=> __('attributes.name_en'),
                // 'description_en' => __('attributes.description_en'),
            ],
        )->validate();

        if ($request->file('image')) {
            Validator::make(
                $request->all(),
                [
                    'image'=>['image','file','max:1024'],
                ],
                [
    
                ],
                [
                    'image' => __('attributes.image'),
                ],
            )->validate();
        }
        if ($request->file('icon')) {
            Validator::make(
                $request->all(),
                [
                    'icon'=>['image','file','max:1024'],
                ],
                [
    
                ],
                [
                    'icon' => __('attributes.icon'),
                ],
            )->validate();
        }

        $data = [
            'name_id' => $request->name_id,
            // 'name_en' => $request->name_en,
            'description_id' => $request->description_id,
            // 'description_en' => $request->description_en,
        ];
        if ($request->file('image')) {
            Storage::disk('public')->delete($service->image);
            $data['image'] = $request->file('image')->store('service');
        }
        if ($request->file('icon')) {
            Storage::disk('public')->delete($service->icon);
            $data['icon'] = $request->file('icon')->store('service/icon');
        }

        if ($service->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('admin.service.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        if ($service->delete()) {
            Storage::disk('public')->delete($service->image);
            Storage::disk('public')->delete($service->icon);
            $response = array(
                'status' => 'success',
                'message' => 'Service berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Service tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(Service::all())->make(true);
    }
}
