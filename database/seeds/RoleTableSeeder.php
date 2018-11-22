<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = ['admin', 'author', 'user'];
        foreach ($roles as $role) {
            \Illuminate\Support\Facades\DB::table('roles')->insert([
                'name' => $role,
                'description' => null,
                'created_at' => \Carbon\Carbon::now()
        ]);
        }
    }
}
