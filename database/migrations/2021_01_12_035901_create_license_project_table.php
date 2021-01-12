<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicenseProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('license_project', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('license_id');
            $table->unsignedBigInteger('required_least_count');
            //複合キーを定義
            $table->primary(['project_id','license_id']);
            //外部キー制約を定義
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('license_project');
    }
}
