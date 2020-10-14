<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_translates', function (Blueprint $table) {
            $table->string('field_name');
            $table->text('value')->nullable();
            $table->string('model')->nullable()->index();
            $table->bigInteger('model_id')->nullable()->index();
            $table->string('lang')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text_translates');
    }
}
