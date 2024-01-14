<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supporters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('details');
            $table->timestamps();
        });

        DB::table('supporters')->insert(
            array(
                "name" => "Peter",
                "details" => "Supporting with being awesome"
            )
        );

        DB::table('supporters')->insert(
            array(
                "name" => "My Wife",
                "details" => "Supporting with being awesome"
            )
        );

        DB::table('supporters')->insert(
            array(
                "name" => "David",
                "details" => "Supporting with being awesome"
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
        Schema::dropIfExists('supporters');
    }
}
