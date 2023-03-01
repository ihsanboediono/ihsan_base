<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class MissionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function edit(Mission $mission)
    {
        $mission = Mission::all()->first();
        return view(
            'admin.about-mision.edit', 
            ['mission' => $mission]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mission $mission)
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

        $mission = Mission::all()->first();

        $mission->update([
            'description_id' => $request->description_id,
            // 'description_en' => $request->description_en,
        ]);

        Alert::toast('Sukses Update Data', 'success');

        return redirect()->to(route('admin.mission.index'));
    }
}
