<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductCategory $productCategory)
    {
        return view('admin.product-subcategory.index', ['productCategory' => $productCategory]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductCategory $productCategory)
    {
        return view('admin.product-subcategory.add', ['productCategory' => $productCategory]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductCategory $productCategory)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name_id'=> ['required', 'max:100'],
                'name_en'=> ['required', 'max:100'],
            ],
            messages: [
                'name_id'=> __('attributes.title_id'),
                'name_en'=> __('attributes.title_en'),
            ],
        )->validate();

        ProductSubcategory::create([
            'product_category_id' => $productCategory->id,
            'name_id' => $request->name_id,
            'name_en' => $request->name_en,
            'slug' => Str::of($request->name_en)->slug('-'),
        ]);

        Alert::toast('Sukses Menambah Data', 'success');

        return redirect()->to(route('admin.product.category.subcategory.index', ['productCategory' => $productCategory->slug]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductSubcategory  $productSubcategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSubcategory $productSubcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductSubcategory  $productSubcategory
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory, ProductSubcategory $productSubcategory)
    {
        return view('admin.product-subcategory.edit', ['productCategory' => $productCategory, 'productSubcategory' => $productSubcategory]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductSubcategory  $productSubcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory, ProductSubcategory $productSubcategory)
    {
        Validator::make(
            data: $request->all(),
            rules: [
                'name_id'=> ['required', 'max:100'],
                'name_en'=> ['required', 'max:100'],
            ],
            messages: [
                'name_id'=> __('attributes.title_id'),
                'name_en'=> __('attributes.title_en'),
            ],
        )->validate();

        $productSubcategory->update(
            attributes: [
                'name_id' => $request->name_id,
                'name_en' => $request->name_en,
                'slug' => Str::of($request->name_en)->slug('-'),
            ],
        );

        Alert::toast('Sukses Update Data', 'success');

        return redirect()->to(route('admin.product.category.subcategory.index', ['productCategory' => $productCategory->slug]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductSubcategory  $productSubcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory, ProductSubcategory $productSubcategory)
    {
        $productSubcategory->delete();
        return 'success';
    }

    public function data(ProductCategory $productCategory)
    {
        return DataTables::of(ProductSubcategory::query()->where('product_category_id', $productCategory->id))->make(true);
    }
}
