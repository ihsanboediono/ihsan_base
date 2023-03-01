<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.category.add');
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
                'name_id' => ['required' , 'max:100'],
                // 'name_en' => ['required' , 'max:100'],
            ],
            [],
            [
                'name_id'=> __('attributes.name_id'),
                // 'name_en'=> __('attributes.name_en'),
            ],
        )->validate();

        $insert = NewsCategory::create([
            'name_id' => $request->name_id,
            // 'name_en' => $request->name_en,
            'slug' => Str::slug($request->name_en, '-')
        ]);

        if ($insert) {
            Alert::toast('Kategori Berita Berhasil ditambahkan.', 'success');
        } else {
            Alert::toast('Kategori Berita gagal ditambahkan.', 'error');
        }

        return redirect()->to(route('admin.news.category.index'))->with('success', 'Kategori Berita Berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function show(NewsCategory $newsCategory)
    {
        return redirect()->to(route('admin.news.category.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsCategory $NewsCategory)
    {
        return view('admin.news.category.edit', ['category' => $NewsCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsCategory $NewsCategory)
    {
        Validator::make(
            $request->all(),
            [
                'name_id' => ['required' , 'max:100'],
                // 'name_en' => ['required' , 'max:100'],
            ],
            [],
            [
                'name_id'=> __('attributes.name_id'),
                // 'name_en'=> __('attributes.name_en'),
            ],
        )->validate();


        $data = [
            'name_id' => $request->name_id,
            // 'name_en' => $request->name_en,
            'slug' => Str::slug($request->name_en, '-')
        ];

        if ($NewsCategory->update($data)) {
            Alert::toast('Kategori Berita Berhasil diubah.', 'success');
        } else {
            Alert::toast('Kategori Berita Gagal diubah.', 'error');
        }

        return redirect()->to(route('admin.news.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsCategory $NewsCategory)
    {
        if ($NewsCategory->delete()) {
            $response = array(
                'status' => 'success',
                'message' => 'Kategori Berita berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Kategori Berita tidak berhasil dihapus!',
            );
        }

        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(NewsCategory::all())->make(true);
    }
}
