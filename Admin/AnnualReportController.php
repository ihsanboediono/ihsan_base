<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\AnnualReport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AnnualReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.anual-report.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.anual-report.add');
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
                'title_id' => ['required' , 'max:100'],
                'year' => ['required', 'max:4', Rule::unique(AnnualReport::class)],
                'document' => ['required' , 'file', 'mimes:pdf,doc,docx,xls,csv,xlsx','max:5024'],
                // 'title_en' => ['required' , 'max:100'],
            ],
            [],
            [
                'title_id'=> __('attributes.title_id'),
                'year' => __('attributes.year'),
                'document' => __('attributes.document'),
                // 'title_en'=> __('attributes.title_en'),
            ],
        )->validate();
        

        $insert = AnnualReport::create([
            'title_id' => $request->title_id,
            'year' => $request->year,
            'file' => !empty($request->file('document')) ? $request->file('document')->store('report') : 'report/default.png',
            // 'title_en' => $request->title_en,
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        }else{
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('admin.report.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnnualReport  $annualReport
     * @return \Illuminate\Http\Response
     */
    public function show(AnnualReport $AnnualReport)
    {
        return redirect()->to(route('admin.report.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnnualReport  $annualReport
     * @return \Illuminate\Http\Response
     */
    public function edit(AnnualReport $AnnualReport)
    {
        return view('admin.anual-report.edit', ['report' => $AnnualReport]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnnualReport  $annualReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnnualReport $AnnualReport)
    {
        Validator::make(
            $request->all(),
            [
                'title_id' => ['required' , 'max:100'],
                'year' => ['required', 'max:4', Rule::unique(AnnualReport::class)->ignore($AnnualReport->id)],
                // 'title_en' => ['required' , 'max:100'],
            ],
            [],
            [
                'title_id'=> __('attributes.title_id'),
                'year' => __('attributes.year'),
                // 'title_en'=> __('attributes.title_en'),
            ],
        )->validate();

        if ($request->file('document')) {
            Validator::make(
                $request->all(),
                [
                    'document' => ['file', 'mimes:pdf,doc,docx,xls,csv,xlsx','max:5024'],
                ],
                [],
                [
                    'document' => __('attributes.document'),
                ],
            )->validate();
        }

        $data = [
            'title_id' => $request->title_id,
            'year' => $request->year,
            // 'title_en' => $request->title_en,
        ];
        if ($request->file('document')) {
            Storage::disk('public')->delete($AnnualReport->file);
            $data['file'] = $request->file('document')->store('report');
        }

        if ($AnnualReport->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        }else{
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('admin.report.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnnualReport  $annualReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnnualReport $AnnualReport)
    {
        if ($AnnualReport->delete()) {
            Storage::disk('public')->delete($AnnualReport->file);
            $response = array(
                'status' => 'success',
                'message' => 'Laporan Tahunan berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Laporan Tahunan tidak berhasil dihapus!',
            );
        }
        
        echo json_encode($response);
    }
    public function downoad(AnnualReport $AnnualReport)
    {
        $ext = explode('.', $AnnualReport->file);
        $ext = '.'.end($ext);
        return Storage::download($AnnualReport->file, $AnnualReport->title_id. $ext , ['']);
    }

    public function data()
    {
        return DataTables::of(AnnualReport::all())->make(true);
    }
}
