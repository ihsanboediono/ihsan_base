<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.about-client.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about-client.add');
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
                'nama' => ['required'],
                'logo' => ['required', 'image', 'file', 'max:2024'],
            ],
        )->validate();
        

        $insert = Client::create([
            'name' => $request->nama,
            'link' => $request->web,
            'logo' => !empty($request->file('logo')) ? $request->file('logo')->store('client') : 'client/default.png',
        ]);

        if ($insert) {
            Alert::toast('Berhasil menambah data.', 'success');
        } else {
            Alert::toast('Gagal menambah data.', 'error');
        }

        return redirect()->to(route('admin.client.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return redirect()->to(route('admin.client.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('admin.about-client.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        Validator::make(
            $request->all(),
            [
                'nama' => ['required'],
            ],
        )->validate();

        if ($request->file('logo')) {
            Validator::make(
                $request->all(),
                [
                    'logo' => ['image', 'file', 'max:2024'],
                ],
            )->validate();
        }

        $data = [
            'name' => $request->nama,
            'link' => $request->web,
        ];
        if ($request->file('logo')) {
            Storage::disk('public')->delete($client->logo);
            $data['logo'] = $request->file('logo')->store('client');
        }

        if ($client->update($data)) {
            Alert::toast('Berhasil mengubah data.', 'success');
        } else {
            Alert::toast('Gagal mengubah data.', 'error');
        }
        return redirect()->to(route('admin.client.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if ($client->delete()) {
            Storage::disk('public')->delete($client->logo);
            $response = array(
                'status' => 'success',
                'message' => 'Partner berhasil dihapus',
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Partner tidak berhasil dihapus!',
            );
        }

        echo json_encode($response);
    }

    public function data()
    {
        return DataTables::of(Client::all())->make(true);
    }
}
