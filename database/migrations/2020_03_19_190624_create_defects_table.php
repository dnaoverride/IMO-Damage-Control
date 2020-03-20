<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('centers_id')->unsigned();
            $table->foreign('centers_id')
                ->references('id')->on('centers')
                ->onDelete('cascade');
            $table->text('description');
            $table->enum('priority', ['critical', 'low', 'medium', 'high']);
            $table->enum('status', ['solved', 'unsolved'])->default('unsolved');
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
        Schema::dropIfExists('defects');
    }
}
