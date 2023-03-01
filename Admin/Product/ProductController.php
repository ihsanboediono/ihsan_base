<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Models\ProductSubcategory;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = ProductCategory::all();
        return view('admin.products.add', [
            'categories' => $category,
        ]);
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
                'name_id'=>['required', 'max:100'],
                // 'name_en'=>['required', 'max:100'],
                'category'=>['required'],
                'description_id'=>['required'],
                // 'description_en'=>['required'],
                'image'=>['required', 'image', 'file', 'max:1024'],
            ],
            [], 
            [
                'name_id'=> __('attributes.name_id'),
                // 'name_en'=> __('attributes.name_en'),
                'category'=> __('attributes.category'),
                'description_id'=> __('attributes.description_id'),
                // 'description_en'=> __('attributes.description_en'),
                'image'=> __('attributes.image'),
            ],
        )->validate();

        $attributes = [
            'name_id'=> $request->name_id,
            // 'name_en'=> $request->name_en,
            'product_category_id'=> $request->category,
            'description_id'=> $request->description_id,
            // 'description_en'=> $request->description_en,
            'image'=> $request->file('image')->store('product-image'),
            'slug'=> Str::of($request->name_en)->slug('-'),
        ];

        if ($request->link) {
            $attributes['link'] = $request->link;
        }

        Product::create($attributes);

        Alert::toast('Sukses Menambah Data', 'success');

        return redirect()->to(route('admin.product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $category = ProductCategory::all();
        return view('admin.products.edit', [
            'categories' => $category,
            'product'=>$product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        Validator::make(
            $request->all(),
            [
                'name_id'=>['required', 'max:100'],
                // 'name_en'=>['required', 'max:100'],
                'category'=>['required'],
                'description_id'=>['required'],
                // 'description_en'=>['required'],
                'image'=>['image', 'file', 'max:1024'],
            ],
            [], 
            [
                'name_id'=> __('attributes.name_id'),
                // 'name_en'=> __('attributes.name_en'),
                'subcategory'=> __('attributes.subcategory'),
                'description_id'=> __('attributes.description_id'),
                // 'description_en'=> __('attributes.description_en'),
                'image'=> __('attributes.image'),
            ],
        )->validate();

        $data = [
            'name_id'=> $request->name_id,
            // 'name_en'=> $request->name_en,
            'product_category_id'=> $request->category,
            'description_id'=> $request->description_id,
            // 'description_en'=> $request->description_en,
            'slug'=> Str::of($request->name_en)->slug('-'),
        ];

        if ($request->file('image')) {
            Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('image')->store('product-image');
        }

        if ($request->link) {
            $data['link'] = $request->link;
        }else {
            $data['link'] = null;
        }

        $product->update($data);

        Alert::toast('Sukses Update Data', 'success');

        return redirect()->to(route('admin.product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        if ($product->delete()) {
            Storage::disk('public')->delete($product->image);
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
        return DataTables::of(Product::query())->make(true);
    }
}
