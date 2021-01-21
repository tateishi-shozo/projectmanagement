<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDialyFeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dialy_fee', function (Blueprint $table) {
            $table->unsignedBigInteger('dialy_id');
            $table->unsignedBigInteger('fee_id');
            $table->double('weight',4,3);
            //複合キーを定義
            $table->primary(['dialy_id','fee_id']);
            //外部キー制約を定義
            $table->foreign('dialy_id')->references('id')->on('dialies');
            $table->foreign('fee_id')->references('id')->on('fees');
            
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
        Schema::dropIfExists('dialy_fee');
    }
}
