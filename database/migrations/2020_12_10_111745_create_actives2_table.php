<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActives2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actives2', function (Blueprint $table) {
            $table->text('user_id');
            $table->integer('question_count');
            $table->integer('important_count');
            $table->integer('new_count');
            $table->integer('canel_count');
            $table->integer('event_count');
            $table->integer('setting_count');
            $table->integer('other_count');
            $table->timestamps('created_at');
            $table->timestamps('updated_at');
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actives2');
    }
}
