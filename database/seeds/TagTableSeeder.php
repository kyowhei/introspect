<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [ 'id' => '1', 'name' => '嬉しい' ],
            [ 'id' => '2', 'name' => '悲しい' ],
            [ 'id' => '3', 'name' => '腹が立つ' ],
            [ 'id' => '4', 'name' => '楽しい' ],
            [ 'id' => '5', 'name' => 'つまらない' ],
            [ 'id' => '6', 'name' => '興味深い' ],
            [ 'id' => '7', 'name' => '気に入らない' ],
            [ 'id' => '8', 'name' => '好き' ],
            [ 'id' => '9', 'name' => '嫌い' ],
            [ 'id' => '10', 'name' => '後悔' ],
            [ 'id' => '11', 'name' => '誇らしい' ],
            [ 'id' => '12', 'name' => '恥ずかしい' ],
            ]);
    }
}
