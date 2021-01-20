<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_profile', function (Blueprint $table) {
           $table->unsignedBigInteger('profile_id');
            $table->unsignedBigInteger('license_id');
            
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('license_id')->references('id')->on('licenses');
            
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
        Schema::dropIfExists('license_profile');
    }
}
