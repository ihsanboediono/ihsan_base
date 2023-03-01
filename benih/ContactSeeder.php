<?php

namespace Database\Seeders;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mission=[
            [
                'whatsapp' => '+6282112442087',
                'instagram' => 'https://www.instagram.com/tupaitech/',
                'linkedin' => 'https://www.linkedin.com/company/tupaitech',
                'facebook' => 'https://www.facebook.com/',
                'email' => 'contact@tupaitech.net',
                'address' => 'Jl Pramuka Raya kav. 15 IS Plaza, Utan kayu Utara, Matraman, Jakarta Timur',
                'telephone' => '(0271) 717417',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Contact::insert($mission);
    }
}
