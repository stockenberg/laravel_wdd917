<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
           'name' => 'admin',
           'email' => 'admin@admin.de',
           'password' => bcrypt('12345678'),
           'created_at' => \Carbon\Carbon::now()
        ]);
    }
}
