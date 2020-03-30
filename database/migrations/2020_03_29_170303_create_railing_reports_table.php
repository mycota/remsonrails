<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRailingReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('railing_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('quotOrdID');
            $table->string('railingNo');
            $table->string('shapetype_RIN');
            $table->string('coner_RIN');
            $table->string('wc_RIN');
            $table->string('connt_RIN');
            $table->string('encap_RIN');
            $table->string('brcktype_RIN');
            $table->string('mg_RIN');
            $table->string('mgl_RIN');
            $table->string('conto_RIN');
            $table->string('glasNo_RIN');
            $table->string('glasNol_RIN');
            $table->string('mgc_RIN');
            $table->string('glasNoc_RIN');
            $table->string('mgr_RIN');
            $table->string('glasNor_RIN');
            $table->string('mgv_RIN');
            $table->string('glasNov_RIN');
            $table->string('mgh_RIN');
            $table->string('glasNoh_RIN');
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
        Schema::dropIfExists('railing_reports');
    }
}
