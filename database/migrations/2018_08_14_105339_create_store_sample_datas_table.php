<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreSampleDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_sample_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('job_title')->nullable()->unsigned();
            $table->text('job_description')->nullable()->unsigned();
            $table->text('category')->nullable()->unsigned();
            $table->text('skills')->nullable()->unsigned();
            $table->text('industry')->nullable()->unsigned();
            $table->text('prefered_years_experience')->nullable()->unsigned();
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
        Schema::dropIfExists('store_sample_datas');
    }
}
