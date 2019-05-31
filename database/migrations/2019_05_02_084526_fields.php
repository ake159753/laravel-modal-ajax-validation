<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {

            $table->increments('id');
            $table->string('fieldName')->nullable();
            $table->string('feildType')->nullable();
            $table->string('fieldLable')->nullable();
            $table->string('fieldClass')->nullable();
            $table->string('field_id')->nullable();
            $table->string('field_btn_del')->nullable();
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
        Schema::dropIfExists('fields');
    }
}
