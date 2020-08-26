<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DailyHoroscopes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_horoscopes', function (Blueprint $table) {
            $table->date('date');
            $table->string('star_sign');
            $table->tinyInteger('overall_score');
            $table->string('overall_content');
            $table->tinyInteger('relationship_score');
            $table->string('relationship_content');
            $table->tinyInteger('career_score');
            $table->string('career_content');
            $table->tinyInteger('finance_score');
            $table->string('finance_content');
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
        Schema::dropIfExists('users');
    }
}
