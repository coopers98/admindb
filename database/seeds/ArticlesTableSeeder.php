<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            'title' => 'Article1'
        ]);
        DB::table('articles')->insert([
            'title' => 'Article2'
        ]);
    }
}
