<?php

namespace App\Http\Controllers\Admin;

use App\Models\HeaderVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HeaderVideo  $headerVideo
     * @return \Illuminate\Http\Response
     */
    public function show(HeaderVideo $headerVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HeaderVideo  $headerVideo
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('admin.video.video', ['video' => HeaderVideo::latest()->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HeaderVideo  $headerVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request )
    {
        $video = HeaderVideo::latest()->first();
        $request->validate([
            'video' => ['required','file', 'mimes:mp4,avi,mkv', 'max:10240'],
        ]);

        if ($video != null) {
            Storage::disk('public')->delete($video->file);
        }
        $data['file'] = $request->file('video')->store('video');

        if ($video != null ) {
           $insert = $video->update($data);
        }else{
            $insert = HeaderVideo::create($data);
        }

        if ($insert) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('admin.video.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HeaderVideo  $headerVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(HeaderVideo $headerVideo)
    {
        //
    }
}
