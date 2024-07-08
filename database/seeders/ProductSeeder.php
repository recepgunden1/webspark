<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Urun 1',
            'image' => 'images/shoe_1.jpg',
            'category_id' => 1,
            'short_text' => 'kısa bilgi',
            'price' => 100,
            'size' => 'small',
            'color' => 'Beyaz',
            'qty' => 10,
            'status' => '1',
            'content' => '<p>ürün baya iyi</p>',
        ]);

        Product::create([
            'name' => 'Urun 2',
            'image' => 'images/cloth_2.jpg',
            'category_id' => 1,
            'short_text' => 'kısa bilgi 2',
            'price' => 150,
            'size' => 'large',
            'color' => 'Siyah',
            'qty' => 5,
            'status' => '1',
            'content' => '<p>ürün baya iyi</p>',
        ]);
    }
}
