<?php

namespace App\Http\Controllers\Admin;

use App\Models\History;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.about-history.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about-history.add');
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
                'year' => ['required', 'max:4'],
                'description_id' => ['required'],
                'image'=>['required', 'image','file','max:1024'],
                // 'name_en' => ['required'],
                // 'description_en' => ['required'],
                // 'image'=>['image','file','max:1024'],
            ],
            [], 
            [
                'name_id'=> __('attributes.name_id'),
                'description_id' => __('attributes.description_id'),
                'year' => __('attributes.year'),
                'image' => __('attributes.image'),
                // 'description_en' => __('attributes.description_en'),
                // 'name_en'=> __('attributes.name_en'),
            ],
        )->validate();
        
        $insert = History::create([
            'title_id' => $request->name_id,
            'description_id' => $request->description_id,
            'image' => !empty($request->file('image')) ? $request->file('image')->store('history') : 'history/default.png',
            'year' => $request->year
            // 'description_en' => $request->description_en,
            // 'title_en' => $request->name_en,
        ]);
        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('admin.history.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        return redirect()->to(route('admin.history.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        return view('admin.about-history.edit', ['history' => $history]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        Validator::make(
            $request->all(),
            [
                'name_id' => ['required'],
                'year' => ['required', 'max:4'],
                // 'name_en' => ['required'],
                'description_id' => ['required'],
                // 'description_en' => ['required'],
            ],
            [], 
            [
                'name_id'=> __('attributes.name_id'),
                'description_id' => __('attributes.description_id'),
                'year' => __('attributes.year'),
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
                [], 
                [
                    'image' => __('attributes.image'),
                ],
            )->validate();
        }

        $data = [
            'title_id' => $request->name_id,
            'title_en' => $request->name_en,
            'description_id' => $request->description_id,
            'description_en' => $request->description_en,
            'year' => $request->year
        ];
        if ($request->file('image')) {
            Storage::disk('public')->delete($history->image);
            $data['image'] = $request->file('image')->store('history');
        }

        if ($history->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }

        return redirect()->to(route('admin.history.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        if ($history->delete()) {
            Storage::disk('public')->delete($history->image);
            $response = array(
                'status' => 'success',
                'message' => 'Sejarah berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Sejarah tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(History::all())->make(true);
    }
}
