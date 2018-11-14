<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('news')->insert([
            'headline' => str_random(10),
            'content' => str_random(10),
            'img_name' => 'images/Pickle-Rick-giveaway.jpg',
            'author_id' => 1
        ]);
    }
}
