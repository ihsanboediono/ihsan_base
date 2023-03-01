<?php

namespace Database\Seeders;

use App\Models\Mission;
use App\Models\Vision;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MissionSeeder extends Seeder
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
                'description_id'=>'<ol>
                    <li>Menjadi mitra terpercaya utama untuk produk, layanan dan solusi terbaik.</li>
                    <li>Mengembangkan sinergi melalui jaringan global untuk penciptaan nilai.</li>
                    <li>Untuk tumbuh bersama dengan mitra bisnis kami.</li>
                    <li>Untuk memaksimalkan nilai pemangku kepentingan kami.</li>
                    <li>Untuk berkontribusi pada komunitas dan lingkungan kita.</li>
                </ol>',
                'description_en'=>'<ol>
                    <li>To be prime reliable partner for best products, services and solutions.</li>
                    <li>To develop synergy through global network for value creation.</li>
                    <li>To grow together with our business partners.</li>
                    <li>To maximize our stakeholders value.</li>
                    <li>To contribute to our communities and environment.</li>
                </ol>',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        $vission=[
            [
                'description_id'=>'“Menjadi mitra bisnis utama yang andal untuk perbaikan berkelanjutan melalui sinergi di sumber dan pasar global”',
                'description_en'=>'“To be prime reliable
                    business partner for continuous
                    improvement through synergy in global
                    sources and markets”',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        Mission::insert($mission);
        Vision::insert($vission);
    }
}
