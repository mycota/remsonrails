<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->string('quotOrdID')->unique();
            $table->integer('customer_id')->unsigned();
            $table->string('refby')->nullable();
            $table->string('approxiRFT')->nullable();
            $table->integer('noOfRailing');
            $table->string('orderStatus')->default('Pending');
            $table->boolean('deleted')->default(1);
            $table->string('persons');
            $table->dateTime('prepared_date')->nullable();
            $table->dateTime('confirm_date')->nullable();
            $table->dateTime('transported_date')->nullable();
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
        Schema::dropIfExists('quotation_order');
    }
}
