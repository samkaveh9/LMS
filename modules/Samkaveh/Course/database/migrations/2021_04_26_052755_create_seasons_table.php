<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Samkaveh\Course\Models\Season;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('slug');
            $table->unsignedTinyInteger('number');
            $table->enum('confirmation_status',Season::$confirmation_status)
                  ->default(Season::CONFIRMATION_STATUS_PENDING);
            $table->enum('status',Season::$statuses)
                  ->default(Season::STATUS_OPENED);
            $table->timestamps();
            
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}
