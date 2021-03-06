<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealersQuentityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealers_quentity', function (Blueprint $table) {
            $table->id();
            $table->double('weight');
            $table->double('price');
            // $table->string('typetitle');
            // $table->integer('caliber');
            $table->bigInteger('dealer_id');
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
        Schema::dropIfExists('dealers_quentity');
    }
}
