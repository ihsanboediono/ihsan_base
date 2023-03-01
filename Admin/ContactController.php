<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $contact = Contact::all()->first();
        return view(
            view: 'admin.contact.edit',
            data: ['contact' => $contact]
        );
        // return $contact;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        Validator::make(
            $request->all(),
            [
                'whatsapp' => ['required'],
                'instagram' => ['required'],
                'linkedin' => ['required'],
                'facebook' => ['required'],
                'email' => ['required', 'email'],
                'address' => ['required'],
                'phone' => ['required'],
            ],
            [],
            [
                'address' => __('attributes.address'),
                'phone' => __('attributes.telephone')
            ]
        )->validate();

        $contact = Contact::all()->first();
        
        $contact->update([
            'whatsapp' => $request->whatsapp,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'facebook' => $request->facebook,
            'email' => $request->email,
            'address' => $request->address,
            'telephone' => $request->phone,
        ]);

        Alert::toast('Sukses Update Data', 'success');

        return redirect()->to(route('admin.contact.index'));
    }
}
