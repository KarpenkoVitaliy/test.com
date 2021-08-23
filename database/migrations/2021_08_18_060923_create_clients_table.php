<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable(false);
            $table->string('email')->unique(); 
            $table->string('address')->default(""); 
            $table->string('phone')->default("");
            $table->tinyInteger('type')->default(0);//0 = 'фіз.особа', 1 = 'приватний підприємець', 2 = 'юридична особа'
            $table->rememberToken(); 
            $table->timestamps();
            $table->index(['name']);
            $table->index(['email']);
            $table->index(['phone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
