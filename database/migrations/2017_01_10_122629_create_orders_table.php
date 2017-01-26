<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->char('sn', 30);
            $table->timestamp('created');
            $table->timestamp('updated')->nullable()->onUpdate('CURRENT_TIMESTAMP');
            $table->timestamp('closed')->nullable();
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('user_created');
            $table->unsignedInteger('user_closed')->nullable();
            $table->unsignedInteger('user_resp')->nullable();
            $table->text('description')->nullable();
            $table->mediumInteger('cost')->unsigned();
            $table->mediumInteger('pay')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('model_id')->unsigned();

                $table->foreign('client_id')->references('id')->on('clients')
                    ->onDelete('RESTRICT')
                    ->onUpdate('CASCADE');
            if(Schema::hasTable('models')) {
                $table->foreign('model_id')->references('id')->on('models')
                    ->onDelete('RESTRICT')
                    ->onUpdate('CASCADE');
            }
            if(Schema::hasTable('statuses')) {
                $table->foreign('status_id')->references('id')->on('statuses')
                    ->onDelete('RESTRICT')
                    ->onUpdate('CASCADE');
            }
            if(Schema::hasTable('users')) {
                $table->foreign('user_created')->references('id')->on('users')
                    ->onDelete('RESTRICT')
                    ->onUpdate('CASCADE');
                $table->foreign('user_closed')->references('id')->on('users')
                    ->onDelete('RESTRICT')
                    ->onUpdate('CASCADE');
                $table->foreign('user_resp')->references('id')->on('users')
                    ->onDelete('RESTRICT')
                    ->onUpdate('CASCADE');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
