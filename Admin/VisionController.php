<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class VisionController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $vision = Vision::all()->first();
        return view('admin.about-vision.edit', ['vision' => $vision]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'description_id' => ['required'],
                // 'description_en' => ['required'],
            ],
            [],
            [
                'description_id'=> __('attributes.description_id'),
                // 'description_en'=> __('attributes.description_en'),
            ],
        )->validate();

        $vision = Vision::all()->first();

        $vision->update([
            'description_id' => $request->description_id,
            // 'description_en' => $request->description_en,
        ]);

        Alert::toast('Sukses Update Data', 'success');

        return redirect()->to(route('admin.vision.index'));
    }
}
