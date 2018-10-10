<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->char('gender');
            $table->string('email');
            $table->string('handphone');
            $table->integer('working_experience')->nullable()->default(0);
            $table->text('industry')->nullable();
            $table->boolean('type')->default(false); //1=candidate, 2=application
            $table->integer('field_id')->nullable();
            $table->string('telephone')->nullable();
            $table->text('summary_keywords')->nullable();
            $table->date('birthdate')->nullable();
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
        Schema::dropIfExists('candidates');
    }
}
