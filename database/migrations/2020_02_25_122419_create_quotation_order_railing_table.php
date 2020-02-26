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
        Schema::create('quotation_order_railing', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quotOrdID');
            $table->string('shapeImage');
            $table->string('glassHeight');
            $table->integer('bracket75Qty')->default(0);
            $table->integer('bracket100Qty')->default(0);
            $table->integer('bracket150Qty')->default(0);
            $table->string('bracketOther')->default('Other bracket');
            $table->integer('bracketOtherQty')->default(0);
            $table->string('sideCover');
            $table->integer('sideCoverQty')->default(0);
            $table->integer('accesCornerQty')->default(0);
            $table->integer('accesWCQty')->default(0);
            $table->integer('accesConnectorQty')->default(0);
            $table->integer('accesEndcapQty')->default(0);
            $table->string('handRail');
            $table->integer('handRailQty')->default(0);
            $table->integer('handrailNo');
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
