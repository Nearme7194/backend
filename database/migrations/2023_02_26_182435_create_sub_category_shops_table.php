<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_category_shops', function (Blueprint $table) {
            $table->increments('id');
            // for sub_category id
            $table->unsignedInteger('sub_category_id')->default(0);
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')
                                        ->onDelete('cascade')->onUpdate('cascade');
            
            // for sub_category id
            $table->unsignedInteger('shop_id')->default(0);
            $table->foreign('shop_id')->references('id')->on('shops')
                                        ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_category_shops');
    }
};
