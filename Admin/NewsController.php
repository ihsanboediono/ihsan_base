<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Support\Str;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.add', ['categories' => NewsCategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,News $news)
    {
        Validator::make(
            $request->all(),
            [
                'title_id' => ['required', 'max:200'],
                'description_id' => ['required'],
                'category' => ['required'],
                'date' => ['required'],
                'image'=>['required', 'image','file','max:3024'],
                // 'title_en' => ['required', 'max:200'],
                // 'description_en' => ['required'],
                // 'type_news' => ['required'],
            ],
            [

            ],
            [
                'title_id'=> __('attributes.title_id'),
                'description_id' => __('attributes.description_id'),
                'category' => __('attributes.category'),
                'image' => __('attributes.image'),
                'date' => __('attributes.date'),
                // 'title_en'=> __('attributes.title_en'),
                // 'description_en' => __('attributes.description_en'),
                // 'type_news' => __('attributes.type_news'),
            ],
        )->validate();
        

        $insert = News::create([
            'title_id' => $request->title_id,
            'description_id' => $request->description_id,
            'news_category_id' => $request->category,
            'image' => !empty($request->file('image')) ? $request->file('image')->store('news/cover') : 'news/default.png',
            'date' => $request->date,
            'slug' => Str::slug($request->title_en, '-')
            // 'type' => $request->type_news,
            // 'description_en' => $request->description_en,
            // 'title_en' => $request->title_en,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('admin.news.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return redirect()->to(route('admin.news.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', ['news' => $news, 'categories' => NewsCategory::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        Validator::make(
            $request->all(),
            [
                'title_id' => ['required', 'max:200'],
                'description_id' => ['required'],
                'category' => ['required'],
                'date' => ['required'],
                // 'title_en' => ['required', 'max:200'],
                // 'description_en' => ['required'],
                // 'type_news' => ['required'],
            ],
            [],
            [
                'title_id'=> __('attributes.title_id'),
                'description_id' => __('attributes.description_id'),
                'category' => __('attributes.category'),
                'image' => __('attributes.image'),
                'date' => __('attributes.date'),
                // 'title_en'=> __('attributes.title_en'),
                // 'description_en' => __('attributes.description_en'),
                // 'type_news' => __('attributes.type_news'),
            ],
        )->validate();


        if ($request->file('image')) {
            Validator::make(
                $request->all(),
                [
                    'image'=>['required', 'image','file','max:3024'],
                ],
                [],
                [
                    'image' => __('attributes.image'),
                ],
            )->validate();
        }

        $data = [
            'title_id' => $request->title_id,
            'description_id' => $request->description_id,
            'news_category_id' => $request->category,
            'date' => $request->date,
            'slug' => Str::slug($request->title_en, '-')
            // 'title_en' => $request->title_en,
            // 'description_en' => $request->description_en,
            // 'type' => $request->type_news,
        ];
        if ($request->file('image')) {
            Storage::disk('public')->delete($news->image);
            $data['image'] = $request->file('image')->store('news/cover');
        }

        if ($news->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('admin.news.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if ($news->delete()) {
            Storage::disk('public')->delete($news->image);
            $response = array(
                'status' => 'success',
                'message' => 'Berita berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Berita tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(News::latest()->get())->make(true);
    }
}
