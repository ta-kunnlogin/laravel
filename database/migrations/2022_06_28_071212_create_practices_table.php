<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('morning', '40');
            $table->integer('type_id_1');
            $table->string('afternoon', '40');
            $table->integer('type_id_2');
            $table->string('comment', '400')->nullable();
            $table->string('image', '400')->nullable();
            $table->string('feedback', '400')->nullable();
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
        Schema::dropIfExists('practices');
    }
}
