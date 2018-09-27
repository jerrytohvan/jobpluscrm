<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('description');
            $table->dateTime('date_reminder');
            $table->integer('user_id')->nullable();
            $table->integer('assigned_id')->nullable();
            $table->boolean('type')->default(true);//tasks = true, event = false
            $table->integer('order')->unsigned()->default(0);
            $table->integer('company_id')->nullable();
            $table->integer('contact_id')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
