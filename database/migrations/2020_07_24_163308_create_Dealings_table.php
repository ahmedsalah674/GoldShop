<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Dealings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('tel');
            $table->double('weight');
            $table->integer('caliber');
            $table->double('price');
            $table->integer('type');
            $table->string('typetitle');
            $table->integer('role');
            $table->integer('finsh')->default(0);
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
        Schema::dropIfExists('buys');
    }
}
