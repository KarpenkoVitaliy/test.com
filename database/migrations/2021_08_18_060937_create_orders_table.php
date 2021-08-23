<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable(false);
            $table->mediumText("description");
            $table->string('phone')->default('');  
            $table->tinyInteger('status')->default(0);//'new'=0, 'work'=1, 'pause'=2, 'cancel'=3, 'finish'=4
            $table->decimal('amount', 10, 2)->default(0);
            $table->unsignedInteger('client_id')->nullable(false);
            $table->unsignedInteger('employee_id');
            $table->dateTime('open_date');
            $table->dateTime('close_date');
            $table->timestamps();
            $table->index(['name']);
            $table->index(['phone']);
            $table->index(['close_date']);
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
