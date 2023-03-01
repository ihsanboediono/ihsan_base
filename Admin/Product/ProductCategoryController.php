<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-category.add');
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
                'name_id'=> ['required', 'max:100'],
                // 'name_en'=> ['required', 'max:100'],
            ],
            [], 
            [
                'name_id'=> __('attributes.name_id'),
                // 'name_en'=> __('attributes.name_en'),
            ],
        )->validate();

        $data = [
            'title_id' => $request->name_id,
            // 'title_en' => $request->name_en,
        ];

        if (ProductCategory::create($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }

        return redirect()->to(route('admin.product.category.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        return view(
            'admin.product-category.edit', 
            ['productCategory' => $productCategory]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        Validator::make(
            $request->all(),
            [
                'name_id'=> ['required', 'max:100'],
                // 'name_en'=> ['required', 'max:100'],
            ],
            [], 
            [
                'name_id'=> __('attributes.name_id'),
                // 'name_en'=> __('attributes.name_en'),
            ],
        )->validate();

        $attributes = [
            'title_id' => $request->name_id,
            // 'title_en' => $request->name_en,
        ];

        if ($productCategory->update($attributes)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }

        return redirect()->to(route('admin.product.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {

        if ($productCategory->delete()) {
            // Storage::disk('public')->delete($career->image);
            $response = array(
                'status' => 'success',
                'message' => 'Kategori Produk berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Kategori Produk tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(ProductCategory::query())->make(true);
    }
}