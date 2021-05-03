<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Samkaveh\Course\Models\Episode;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('season_id')->nullable();
            $table->unsignedBigInteger('media_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->boolean('is_free')->default(false);
            $table->text('body')->nullable();
            $table->unsignedInteger('time')->nullable();
            $table->unsignedInteger('number')->nullable();
            $table->enum('status', Episode::$statuses);
            $table->enum('confirmation_status', Episode::$confirmation_status)->default(Episode::CONFIRMATION_STATUS_PENDING);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('CASCADE');
            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('SET NULL');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
