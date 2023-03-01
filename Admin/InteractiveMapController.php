<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\InteractiveMap;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class InteractiveMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            view: 'pages.maps.index',
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
            view: 'pages.maps.add',
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
                'name_id'=> ['required', 'max:100'],
                'name_en'=> ['required', 'max:100'],
                'description_id' => ['required'],
                'description_en' => ['required'],
                'icon' => ['required', 'image', 'file', 'max:1024'],
                'coordinate'=> ['required'],
                'type'=> ['required'],
            ],
            messages: [
                'name_id'=> __('attributes.name_id'),
                'name_en'=> __('attributes.name_en'),
                'description_id' => __('attributes.description_id'),
                'description_en' => __('attributes.description_en'),
                'icon' => __('attributes.icon'),
                'coordinate' => __('attributes.coordinate'),
                'type' => __('attributes.type'),
            ],
        )->validate();

        InteractiveMap::create([
            'name_id'=> $request->name_id,
            'name_en'=> $request->name_en,
            'description_id' => $request->description_id,
            'description_en' => $request->description_en,
            'icon' => $request->file('icon')->store('interactive-map-icon'),
            'coordinate' => $request->coordinate,
            'type' => $request->type,
        ]);

        Alert::toast('Sukses Tambah Data', 'success');

        return redirect()->to(route('admin.interactive-map.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InteractiveMap  $interactiveMap
     * @return \Illuminate\Http\Response
     */
    public function show(InteractiveMap $interactiveMap)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InteractiveMap  $interactiveMap
     * @return \Illuminate\Http\Response
     */
    public function edit(InteractiveMap $interactiveMap)
    {
        return view(
            view: 'pages.maps.edit',
            data: ['interactiveMap' => $interactiveMap],
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InteractiveMap  $interactiveMap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InteractiveMap $interactiveMap)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name_id'=> ['required', 'max:100'],
                'name_en'=> ['required', 'max:100'],
                'description_id' => ['required'],
                'description_en' => ['required'],
                'coordinate'=> ['required'],
                'type'=> ['required'],
            ],
            messages: [
                'name_id'=> __('attributes.name_id'),
                'name_en'=> __('attributes.name_en'),
                'description_id' => __('attributes.description_id'),
                'description_en' => __('attributes.description_en'),
                'icon' => __('attributes.icon'),
                'coordinate' => __('attributes.coordinate'),
                'type' => __('attributes.type'),
            ],
        )->validate();

        $attributes = [
            'name_id'=> $request->name_id,
            'name_en'=> $request->name_en,
            'description_id' => $request->description_id,
            'description_en' => $request->description_en,
            // 'icon' => $request->file('icon')->store('interactive-map-icon'),
            'coordinate' => $request->coordinate,
            'type' => $request->type,
        ];

        if ($request->file('icon')) {
            Storage::delete($interactiveMap->icon);
            $attributes['icon'] = $request->file('icon')->store('interactive-map-icon');
        }

        $interactiveMap->update(attributes: $attributes);

        Alert::toast('Sukses Update Data', 'success');

        return redirect()->to(route('admin.interactive-map.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InteractiveMap  $interactiveMap
     * @return \Illuminate\Http\Response
     */
    public function destroy(InteractiveMap $interactiveMap)
    {
        Storage::delete($interactiveMap->icon);
        $interactiveMap->delete();
        return 'success';
    }

    public function data()
    {
        return DataTables::of(InteractiveMap::query())->make(true);
    }
}
