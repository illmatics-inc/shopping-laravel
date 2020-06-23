<?php

use Faker\Factory as Fake;
use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('admin_users')->insert([
            'name' => 'オーナー管理者',
            'email' => 'owner@a.com',
            'password' => Hash::make('pass'),
            'is_owner' => true,
            'created_at' => new Datetime(),
        ]);
        DB::table('admin_users')->insert([
            'name' => '一般管理者',
            'email' => 'admin@a.com',
            'password' => Hash::make('pass'),
            'is_owner' => false,
            'created_at' => new Datetime(),
        ]);
        $fake = Fake::create('ja_JP');
        for ($i = 0; $i < 13; $i++) {
            DB::table('admin_users')->insert([
                'name' => $fake->name,
                'email' => $fake->email,
                'password' => Hash::make('pass'),
                'is_owner' => false,
                'created_at' => new Datetime(),
            ]);
        }
    }
}
