<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->text('name');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('brand_id');

            if(Schema::hasTable('types')) {
                $table->foreign('type_id')->references('id')->on('types')
                    ->onDelete('RESTRICT')
                    ->onUpdate('CASCADE');
            }
            if(Schema::hasTable('brands')) {
                $table->foreign('brand_id')->references('id')->on('brands')
                    ->onDelete('RESTRICT')
                    ->onUpdate('CASCADE');
            }
            $table->timestamp();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('models');
    }
}
