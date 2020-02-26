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
        Schema::create('quotation_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->string('quotOrdID')->unique();
            $table->integer('customer_id')->unsigned();
            $table->string('refby')->nullable();
            $table->integer('approxiRFT')->nullable();
            $table->string('glassTytpe');
            $table->string('glasSize1');
            $table->string('glasSize2');
            $table->string('productName');
            $table->string('productType');
            $table->string('productCover');
            $table->string('handrail');
            $table->string('productColor');
            $table->string('color');
            $table->string('orderStatus')->default('Pending');
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
        Schema::dropIfExists('quotation_order');
    }
}
