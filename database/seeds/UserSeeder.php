<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "ihza",
            'email' => 'ihza@gmail.com',
            'password' => Hash::make('password'),
            'api_key' => Hash::make('1asdpassword')
        ]);
        DB::table('receipts')->insert([
            "amount" => "100",
            "amount_paid" => "100",
            "via" => 'tokped'
        ]);
    }
}
