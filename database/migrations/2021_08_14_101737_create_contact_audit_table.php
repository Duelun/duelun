<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_audits', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->string('user_agent', 255);
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('subject', 40);
            $table->text('message');
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
        Schema::dropIfExists('contact_audit');
    }
}
