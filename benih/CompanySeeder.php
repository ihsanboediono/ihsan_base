<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = [
            [
                'description_id' => 'Global Cipta Niaga adalah perusahaan nasional yang didirikan pada tahun 2004 oleh sekelompok berpengalaman profesional teknis dan bisnis dengan perpaduan antara keahlian dan komitmen untuk membantu dan mempertahankan pelanggan kami dalam penghargaan tertinggi. Tujuan kami adalah untuk menjadi mitra yang dapat diandalkan dalam pasokan dan layanan dengan menyediakan produk, layanan, dan solusi total berkualitas tinggi untuk meningkatkan produktivitas dalam pendekatan hemat biaya. Kami didukung oleh manufaktur terkemuka di industri. Tim kami berpengalaman dalam penilaian, teknik, instalasi, dan konsultasi yang dapat memberikan nilai tambah untuk mitra kami dalam memahami, memecahkan masalah dan meningkatkan kinerja.',
                'description_en' => 'Global Cipta Niaga is a national company that Gestablished in 2004 by a group of experienced technical and business professionals with a blend of expertise and commitment to assist and hold our customers in the highest esteem. Our aim is to be reliable partner in supplies and services by providing high quality products, services and total solutions for improving productivity in cost-effective approach. We are supported by leading manufactures in the industry. Our team are experienced in assessment, engineering, installation, and consulting that could give additional values for our partner in understanding, solving the problems and improve the performance.',
                'image' => 'assets/img-custom/img-card-1.png'
            ],
        ];

        CompanyProfile::insert($company);
    }
}
