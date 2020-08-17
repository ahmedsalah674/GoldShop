<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealersQuentityPremiumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dealers_premium', function (Blueprint $table) {
            $table->id();
            $table->integer('dealer_id');
            $table->decimal('premium_price')->nullable();
            $table->decimal('premium_gold')->nullable();
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
        Schema::dropIfExists('dealers_quentity_premium');
    }
}
