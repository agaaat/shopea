<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'user_id' => 1,
            'name' => 'iPhone 12',
            'price' => 1000,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'image' => 'https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone-12-pro-family-hero?wid=940&hei=1112&fmt=png-alpha&.v=1604021660000',
        ]);
        Product::create([
            'user_id' => 1,
            'name' => 'iPhone 11',
            'price' => 5999000,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'image' => 'https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone-11-pro-max-gold-select-2019?wid=940&hei=1112&fmt=png-alpha&.v=1566953859459',
        ]);
        Product::create([
            'user_id' => 1,
            'name' => 'iPhone X',
            'price' => 4999000,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'image' => 'https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone-xr-blue-select-201809?wid=940&hei=1112&fmt=png-alpha&.v=1551226038669',
        ]);
        Product::create([
            'user_id' => 1,
            'name' => 'iPhone 8',
            'price' => 3999000,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'image' => 'https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone8-plus-silver-select-2018?wid=940&hei=1112&fmt=png-alpha&.v=1551226038669',
        ]);
        Product::create([
            'id' => 5,
            'user_id' => 1,
            'name' => 'iPhone 7',
            'price' => 2999000,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'image' => 'https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/iphone7-black-select-2016?wid=940&hei=1112&fmt=png-alpha&
                    .v=1551226038669',
        ]);
    }
}
