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
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('contact_number');
            $table->boolean('opne_24');
            $table->string('open_time');
            $table->string('close_time');
            $table->string('visit_count');
            // for address id
            $table->unsignedInteger('address_id')->default(0);
            $table->foreign('address_id')->references('id')->on('addresses')
                                        ->onDelete('cascade')->onUpdate('cascade');
            // for location 
            $table->unsignedInteger('location_id')->default(0);
            $table->foreign('location_id')->references('id')->on('locations')
                                        ->onDelete('cascade')->onUpdate('cascade');
            // for category
            $table->unsignedInteger('category_id')->default(0);
            $table->foreign('category_id')->references('id')->on('categories')
                                        ->onDelete('cascade')->onUpdate('cascade');
            // for subcategory
            $table->unsignedInteger('sub_category_id')->default(0);
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')
                                        ->onDelete('cascade')->onUpdate('cascade');
            
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
        Schema::dropIfExists('shops');
    }
};
