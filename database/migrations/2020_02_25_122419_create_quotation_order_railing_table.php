<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationOrderRailingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_order_railings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quotation_order_id')->unsigned();
            $table->string('quotOrdID');
            $table->integer('railingNo');
            $table->string('shapeName'); //convertitto a real name
            $table->string('imageFile')->nullable();
            $table->integer('bracket50Qty')->nullable();
            $table->integer('bracket75Qty')->nullable();
            $table->integer('bracket100Qty')->nullable();
            $table->integer('bracket150Qty')->nullable();
            $table->string('bracketFP')->nullable();
            $table->integer('bracketFPQty')->nullable();
            $table->string('sideCover')->nullable();
            $table->integer('sideCoverQty')->nullable();
            $table->integer('accesWCQty')->nullable();
            $table->integer('accesCornerQty')->nullable();
            $table->integer('accesConnectorQty')->nullable();
            $table->integer('accesEndcapQty')->nullable();
            $table->string('acceshandRail');
            $table->integer('acceshandRailQty');
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
        Schema::dropIfExists('quotation_order_railing');
    }
}
