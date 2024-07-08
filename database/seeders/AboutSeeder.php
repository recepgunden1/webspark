<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'name'=>'WEBSPARK E-Ticaret',
            'content'=>'Test hakkımızda yazısı',
            'text_1_icon'=>'icon-truck',
            'text_1'=>'ÜCRETSİZ KARGO',
            'text_1_content'=>'Ürünlerinizi ücretsiz teslim alabilirsiniz.',
            'text_2_icon'=>'icon-refresh2',
            'text_2'=>'GERİ İADE',
            'text_2_content'=>'15 gün içinde ücretsiz geri iade.',
            'text_3_icon'=>'icon-help',
            'text_3'=>'DESTEK',
            'text_3_content'=>'7/24 Bize ulaşabilirsiniz.',
        ]);
    }
}
