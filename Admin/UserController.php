<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required'],
            // 'username' => ['required'],
            'email' => ['required', 'email', Rule::unique(User::class)],
            'password' => ['required', Password::min(6)->mixedCase()],
            're-password' => ['required', 'same:password', Password::min(6)->mixedCase()],
        ]);
        


        User::create([

            'name' => $request->nama,
            // 'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0,
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Encyclopedia  $encyclopedia
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return redirect()->to(route('admin.users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Encyclopedia  $encyclopedia
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Encyclopedia  $encyclopedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => ['required'],
            // 'username' => ['required', Rule::unique(User::class)->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique(User::class)->ignore($user->id)],
        ]);
        if (isset($request->password)) {
            $request->validate([
                'password' => [Password::min(6)->mixedCase()],
            ]);
        }

        $data = [
            'name' => $request->nama,
            // 'username' => $request->username,
            'email' => $request->email,
        ];
        if (isset($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return redirect()->to(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Encyclopedia  $encyclopedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // return $user;
        if ($user->status != 'root') {
            $user->delete();
            $response = array(
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
            );
        } elseif ($user->status == 'root') {
            $response = array(
                'status' => 'error',
                'message' => 'Root can\'t be deleted!',
            );
        }
        
        echo json_encode($response);
    }

    public function switch(Request $request)
    {
        if (isset($request->id) && isset($request->isactive)) {
            $isactive = '1';
            if ($request->isactive == '1') {
                $isactive = '0';
            }
        
            
            $user = User::find($request->id);
            if ($user->status != 'root') {
        
                if($user->email_verified_at != NULL){
                    if ($user->update(array('is_active' => $isactive))) {
                        if ($isactive == '0') {
                            $message1 = "Pengguna Berhasil di non aktifkan";
                        }else{
                            $message1 = "Pengguna Berhasil di aktifkan";
                        }
                        $response = array(
                            'status' => 'success',
                            'message' => $message1,
                        );
                    } else {
                        if ($isactive == '0') {
                            $message2 = "Pengguna tidak berhasil di non aktifkan";
                        }else{
                            $message2 = "Pengguna tidak berhasil di aktifkan";
                        }
                        $response = array(
                            'status' => 'error',
                            'message' => $message2,
                        );
                    }
                }else{
                    $response = array(
                        'status' => 'error',
                        'message' => 'Email Belum di Verifikasi',
                    );
                }
        
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Root tidak bisa dinonaktifkan',
                );
            }
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Pengguna tidak ditemukan!',
            );
        }
        echo json_encode($response);
        
    }

    public function data()
    {
        return DataTables::of(User::all())->make(true);
    }
}
