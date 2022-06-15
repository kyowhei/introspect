<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [ 'id' => '1', 'name' => 'about me' ],
            [ 'id' => '2', 'name' => 'around me'],
            [ 'id' => '3', 'name' => 'about sosial']
            ]);
    }
}
