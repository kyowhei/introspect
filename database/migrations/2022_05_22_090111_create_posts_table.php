<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event', 100)->nullable();
            $table->string('impression', 100)->nullable();
            $table->string('reaction', 100)->nullable();
            $table->string('feedback', 100)->nullable();
            $table->integer('tag_id')->unsigned();
            //unsigned型で主テーブルのincrementsで生成されたデータと型を合わせる
            //'tag_id'は'tags'テーブルのidを参照する外部キー
            $table->integer('category_id')->unsigned();
            //'category_id'は'categories'テーブルのidを参照する外部キー
            $table->bigInteger('user_id')->unsigned();
            //'user_id'は'users'テーブルのidを参照する外部キー
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
