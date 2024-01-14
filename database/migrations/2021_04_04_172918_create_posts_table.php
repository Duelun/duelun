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
            $table->id();
            $table->string('content');
            $table->date('release_on');
            $table->timestamps();
        });

        DB::table('posts')->insert(
            array(
                "content" => "This is a welcome post just for testing",
                "release_on" => "2021-01-31"
            )
        );
        DB::table('posts')->insert(
            array(
                "content" => "This is another test post",
                "release_on" => "2021-04-03"
            )
        );
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
