<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Testimony;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $testimonys = Testimony::latest()->get();
        $data = [
            'testimonys' => $testimonys
        ];

        // dd($testimonys);
        return view('user.home', $data);
    }
}
