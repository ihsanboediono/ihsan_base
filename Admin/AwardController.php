<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Award::all();
        return view('admin.about-awards.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about-awards.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_id' => ['required'],
            'name_en' => ['required'],
            'description_id' => ['required'],
            'description_en' => ['required'],
            'image'=>['image','file','max:1024'],
        ]);
        

        $insert = Award::create([
            'name_id' => $request->name_id,
            'name_en' => $request->name_en,
            'description_id' => $request->description_id,
            'description_en' => $request->description_en,
            'image' => !empty($request->file('image')) ? $request->file('image')->store('award') : 'award/default.png',
            'date' => date('Y-m-d H:i:s')
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('admin.award.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function show(Award $award)
    {
        return redirect()->to(route('admin.award.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function edit(Award $award)
    {
        return view('admin.about-awards.edit', ['award' => $award]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Award $award)
    {
        $request->validate([
            'name_id' => ['required'],
            'name_en' => ['required'],
            'description_id' => ['required'],
            'description_en' => ['required'],
        ]);

        if ($request->file('image')) {
            $request->validate([
                'image'=>['image','file','max:1024'],
            ]);
        }

        $data = [
            'name_id' => $request->name_id,
            'name_en' => $request->name_en,
            'description_id' => $request->description_id,
            'description_en' => $request->description_en,
            'date' => date('Y-m-d H:i:s')
        ];
        if ($request->file('image')) {
            Storage::disk('public')->delete($award->image);
            $data['image'] = $request->file('image')->store('award');
        }

        if ($award->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('admin.award.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function destroy(Award $award)
    {
        if ($award->delete()) {
            Storage::disk('public')->delete($award->image);
            $response = array(
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Data tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }
}
