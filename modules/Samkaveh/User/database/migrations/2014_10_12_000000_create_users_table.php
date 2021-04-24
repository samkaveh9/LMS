<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Samkaveh\User\Models\User;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username',50)->nullable();
            $table->string('mobile',14)->nullable();
            $table->string('headline')->nullable();
            $table->text('bio')->nullable();
            $table->string('ip')->nullable();
            $table->bigInteger("image_id")->unsigned()->nullable();
            $table->string('card_number', 16)->nullable();
            $table->string('shaba', 24)->nullable();
            $table->string('telegram')->nullable();          
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('status', User::$statuses)->default(User::STATUS_ACTIVE);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('image_id')->references('id')->on('media')->onDelete('SET NULL');
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
