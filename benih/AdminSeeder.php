<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins=[
            [
                'name'=>'Super Admin',
                'email'=>'superadmin@example.com',
                'email_verified_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'is_admin'=>1,
                'is_active'=>1,
                'status'=>'root',
                'password'=>Hash::make('Password'),
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        User::insert($admins);
    }
}
