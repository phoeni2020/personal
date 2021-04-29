<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableError extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('errors', function (Blueprint $table) {
           $table->id();
           $table->integer('status_code');
           $table->integer('user');
           $table->string('massage');
           $table->string('file');
           $table->longText('trace');
           $table->longText('trace_as_string');
           $table->string('line');
           $table->string('previous');
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
        //
    }
}
