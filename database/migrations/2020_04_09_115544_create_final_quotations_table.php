<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('quotation_order_id')->unsigned();
            $table->string('quotOrdID');
            $table->integer('nofrailings');
            $table->string('rates_per_rft');
            $table->string('glassHeight');
            $table->string('glassUnit');
            $table->float('values');
            $table->string('gst');
            $table->string('transport');
            $table->string('payment_terms')->nullable();
            $table->string('payment_currency')->nullable();
            $table->boolean('deleted')->default(1);
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
        Schema::dropIfExists('final_quotations');
    }
}
