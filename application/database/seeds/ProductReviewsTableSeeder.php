<?php

use Faker\Factory as Fake;
use Illuminate\Database\Seeder;

class ProductReviewsTableSeeder extends Seeder
{
    public function run()
    {
        $fake = Fake::create('ja_JP');
        $userIds = DB::table('users')->pluck('id')->toArray();
        foreach (DB::table('products')->pluck('id') as $productId) {
            for ($i = 0; $i < 10; $i++) {
                DB::table('product_reviews')->insert([
                    'product_id' => $productId,
                    'user_id' => $userIds[array_rand($userIds, 1)],
                    'title' => $fake->words(5, true),
                    'body' => $fake->text,
                    'rank' => $fake->numberBetween(1, 5),
                    'created_at' => new Datetime(),
                ]);
            }
        }
    }
}
