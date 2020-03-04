<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('currencies')->nullable(false)->comment("CURRENCY1->CURRENCY2->CURRENCY3");
            $table->decimal('satisfactory_threshold')->nullable(false)->unsigned();
            $table->decimal('warning_threshold')->nullable(false)->default(0);
            $table->boolean('is_active')->nullable(false);
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
        Schema::dropIfExists('currency_profiles');
    }
}
