<?php

namespace App\Http\Controllers\Admin;

use App\Models\Career;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.career.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.career.add');
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
                'title_id' => ['required', 'max:200'],
                'start_date' => ['required'],
                'end_date' => ['required'],
                'description_id' => ['required'],
                // 'title_en' => ['required', 'max:200'],
                // 'description_en' => ['required'],
                // 'image'=>['required', 'image','file','max:1024'],
            ],
            [],
            [
                'title_id'=> __('attributes.title_id'),
                'description_id' => __('attributes.description_id'),
                'start_date' => __('attributes.start_date'),
                'end_date' => __('attributes.end_date'),
                // 'title_en'=> __('attributes.title_en'),
                // 'description_en' => __('attributes.description_en'),
                // 'image' => __('attributes.image'),
            ],
        )->validate();
        

        $insert = Career::create([
            'title_id' => $request->title_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description_id' => $request->description_id,
            'status' => 'onprogress', 
            // 'title_en' => $request->title_en,
            // 'description_en' => $request->description_en,
            // 'image' => !empty($request->file('image')) ? $request->file('image')->store('career') : 'career/default.png',
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('admin.career.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show(Career $career)
    {
        return redirect()->to(route('admin.award.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        return view('admin.career.edit', ['career' => $career]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Career $career)
    {
        Validator::make(
            $request->all(),
            [
                'title_id' => ['required', 'max:200'],
                'start_date' => ['required'],
                'end_date' => ['required'],
                'description_id' => ['required'],
                // 'description_en' => ['required'],
                // 'title_en' => ['required', 'max:200'],
                // 'image'=>['image','file','max:1024'],
            ],
            [],
            [
                'title_id'=> __('attributes.title_id'),
                'description_id' => __('attributes.description_id'),
                'start_date' => __('attributes.start_date'),
                'end_date' => __('attributes.end_date'),
                // 'title_en'=> __('attributes.title_en'),
                // 'description_en' => __('attributes.description_en'),
                // 'image' => __('attributes.image'),
            ],
        )->validate();

        // if ($request->file('image')) {
        //     Validator::make(
        //         $request->all(),
        //         [
        //             'image' => ['image','file','max:1024'],
        //         ],
        //         [],
        //         [
        //             'image' => __('attributes.image'),
        //         ],
        //     )->validate();
        // }

        $data = [
            'title_id' => $request->title_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description_id' => $request->description_id,
            'date' => date('Y-m-d H:i:s')
            // 'title_en' => $request->title_en,
            // 'description_en' => $request->description_en,
        ];
        // if ($request->file('image')) {
        //     Storage::disk('public')->delete($career->image);
        //     $data['image'] = $request->file('image')->store('career');
        // }

        if ($career->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('admin.career.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy(Career $career)
    {
        if ($career->delete()) {
            // Storage::disk('public')->delete($career->image);
            $response = array(
                'status' => 'success',
                'message' => 'Karir berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Karir tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(Career::latest()->selectByLocale()->get()->append('status'))->make(true);
    }
}
