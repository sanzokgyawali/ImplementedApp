<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblManufactureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_manufacture', function (Blueprint $table) {
            $table->bigIncrements('manufacture_id');
            $table->string('manufacture_name');
            $table->string('manufacture_description');
            $table->integer('category_id');
            $table->integer('publication_status');
            $table->string('created_by');
            $table->string('modified_by')->nullable();
          //  $table->foreign('category_id')->references('category_id')->on('tbl_category');

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
        Schema::dropIfExists('tbl_manufacture');
    }
}
