<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('admin_id');
            $table->string('title')->nullable();
            $table->longText('body')->nullable();
            $table->string('post_img')->nullable();
            $table->string('post_video')->nullable();
            $table->string('post_slug')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });

        Schema::create('comments', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('post_id');
            $table->integer('reply_to')->nullable();
            $table->longText('body')->nullable();
            $table->timestamps();
        });

        Schema::create('logs', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id');
            $table->integer('action_id');
            $table->integer('user_id')->nullable();
            $table->integer('comment_id')->nullable();
            $table->integer('post_id')->nullable();
            $table->longText('description');
            $table->timestamps();
        });

        Schema::create('actions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('status', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description');
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
        Schema::dropIfExists('comments');
        Schema::dropIfExists('logs');
        Schema::dropIfExists('actions');
        Schema::dropIfExists('status');
    }
}
