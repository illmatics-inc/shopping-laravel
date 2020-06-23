<?php

use Faker\Factory as Fake;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        if (!Storage::exists('product_images')) {
            Storage::makeDirectory('product_images');
        }
        $files = File::glob(database_path('seeds/product_images/*.{jpeg,jpg,png}'), GLOB_BRACE);
        $fileCount = count($files);
        $fake = Fake::create('ja_JP');
        foreach (DB::table('product_categories')->pluck('id') as $categoryIndex => $categoryId) {
            $productCount = $fake->numberBetween(10, 30);
            for ($i = 0; $i < $productCount; $i++) {
                $fileRealPath = storage_path('app/public/product_images/'.Str::random(40));
                $fileIndex = ($categoryIndex + $i) % $fileCount;
                File::copy($files[$fileIndex], $fileRealPath);
                DB::table('products')->insert([
                    'product_category_id' => $categoryId,
                    'name' => $fake->words(5, true),
                    'price' => $fake->numberBetween(100, 100000),
                    'description' => $fake->text,
                    'image_path' => 'product_images/'.basename($fileRealPath),
                    'created_at' => new Datetime(),
                ]);
            }
        }
    }
}
