<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->text('content');
            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('thumbnail')->nullable();
            $table->boolean('allowed')->default(0);
            $table->integer('view_count')->default(0);
            $table->boolean('is_about')->default(0);
            $table->timestamp('published_at')->nullable();

            //referencias
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
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
