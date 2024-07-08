<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            'name'=>'adres',
            'data'=>'TEST adres'
        ]);

        SiteSetting::create([
            'name'=>'phone',
            'data'=>'000 000 00 00'
        ]);

        SiteSetting::create([
            'name'=>'email',
            'data'=>'test@domain.com'
        ]);

        SiteSetting::create([
            'name'=>'harita',
            'data'=>null
        ]);
    }
}
