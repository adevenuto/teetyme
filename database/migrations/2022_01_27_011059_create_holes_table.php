<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holes', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->index();
            $table->integer('state_id')->index();
            $table->integer('number')->nullable();
            $table->integer('par')->nullable();
            $table->integer('length_yds')->nullable();
            $table->integer('length_m')->nullable();
            $table->integer('stroke_index')->nullable();
            $table->string('teebox')->nullable();
            $table->string('teebox_slope')->nullable();
            $table->decimal('teebox_rating', 3,2)->nullable();
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
        Schema::dropIfExists('holes');
    }
}
