<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimony;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.testimony.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimony.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'jabatan' => ['required'],
                'perusahaan' => ['required'],
                'testimony_id' => ['required'],
                'image'=>['required', 'image','file','max:1024'],
                // 'testimony_en' => ['required'],
            ],
            [],
            [
                'testimony_id' => __('attributes.testimony_id'),
                // 'testimony_en' => __('attributes.testimony_en'),
                'image' => __('attributes.image'),
            ],
        )->validate();
        

        $insert = Testimony::create([
            'name' => $request->nama,
            'position' => $request->jabatan,
            'company' => $request->perusahaan,
            'testimony_id' => $request->testimony_id,
            // 'testimony_en' => $request->testimony_en,
            'image' => !empty($request->file('image')) ? $request->file('image')->store('testimony') : 'testimony/default.png',
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('admin.testimony.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimony $testimony)
    {
        return redirect()->to(route('admin.testimony.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimony $testimony)
    {
        return view('admin.testimony.edit', ['testimony' => $testimony]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimony $testimony)
    {
        Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
                'jabatan' => ['required'],
                'perusahaan' => ['required'],
                'testimony_id' => ['required'],
                'image'=>['image','file','max:1024'],
                // 'testimony_en' => ['required'],
            ],
            [],
            [
                'testimony_id' => __('attributes.testimony_id'),
                // 'testimony_en' => __('attributes.testimony_en'),
                'image' => __('attributes.image'),
            ],
        )->validate();

        
        // if ($request->file('image')) {
        //     Validator::make(
        //         data: $request->all(),
        //         rules: [
        //             'foto'=>['image','file','max:1024'],
        //         ],
        //         customAttributes: [
                    
        //         ],
        //     )->validate();
        // }

        $data = [
            'name' => $request->nama,
            'position' => $request->jabatan,
            'company' => $request->perusahaan,
            'testimony_id' => $request->testimony_id,
            // 'testimony_en' => $request->testimony_en,
        ];
        if ($request->file('image')) {
            Storage::disk('public')->delete($testimony->image);
            $data['image'] = $request->file('image')->store('testimony');
        }

        if ($testimony->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('admin.testimony.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimony $testimony)
    {
        if ($testimony->delete()) {
            Storage::disk('public')->delete($testimony->image);
            $response = array(
                'status' => 'success',
                'message' => 'Testimoni berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Testimoni tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(Testimony::latest())->make(true);
    }
}
