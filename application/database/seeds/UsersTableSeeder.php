<?php

use Faker\Factory as Fake;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        if (!Storage::exists('user_images')) {
            Storage::makeDirectory('user_images');
        }
        $files = File::glob(database_path('seeds/user_images/*.{jpeg,jpg,png}'), GLOB_BRACE);
        $fileCount = count($files);
        $fileRealPath = storage_path('app/public/user_images/'.Str::random(40));
        File::copy($files[0], $fileRealPath);
        DB::table('users')->insert([
            'name' => '顧客',
            'email' => 'user@a.com',
            'password' => Hash::make('pass'),
            'image_path' => 'user_images/'.basename($fileRealPath),
            'created_at' => new Datetime(),
        ]);
        $fake = Fake::create('ja_JP');
        for ($i = 0; $i < 13; $i++) {
            $fileRealPath = storage_path('app/public/user_images/'.Str::random(40));
            $fileIndex = $i % $fileCount;
            File::copy($files[$fileIndex], $fileRealPath);
            DB::table('users')->insert([
                'name' => $fake->name,
                'email' => $fake->email,
                'password' => Hash::make('pass'),
                'image_path' => 'user_images/'.basename($fileRealPath),
                'created_at' => new Datetime(),
            ]);
        }
    }
}
