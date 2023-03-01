<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class CompanyProfileController extends Controller
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
     * @param  \App\Models\CompanyProfile  $companyProfile
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyProfile $companyProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyProfile  $companyProfile
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $company = CompanyProfile::latest()->first();
        // return $company;
        return view('admin.about-company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyProfile  $companyProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $company = CompanyProfile::latest()->first();
        Validator::make(
            $request->all(),
            [
                'description_id' => ['required'],
                // 'description_en' => ['required'],
            ],
            [],
            [
                'description_id' => __('attributes.description_id'),
                // 'description_en' => __('attributes.description_en'),
            ],
        )->validate();

        if ($request->file('image')) {
            $request->validate([
                'image'=>['image','file','max:1024'],
            ]);
        }

        $data = [
            'description_id' => $request->description_id,
            // 'description_en' => $request->description_en,
            'date' => date('Y-m-d H:i:s')
        ];
        if ($request->file('image')) {
            if (isset($company->image) != null) {
                Storage::disk('public')->delete($company->image);
            }
            $data['image'] = $request->file('image')->store('company');
        }
        if ($company != null) {
            $result = $company->update($data);
        }else{
            $result = CompanyProfile::create($data);
        }
        if ($result) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }

        return redirect()->to(route('admin.company.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyProfile  $companyProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyProfile $companyProfile)
    {
        //
    }
}
