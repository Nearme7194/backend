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
            $table->boolean('open_24');
            $table->string('open_time')->nullable();
            $table->string('close_time')->nullable();
            $table->string('visit_count')->default(0);
            
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
            //for user 
            $table->unsignedInteger('user_id')->default(0);
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('shops');
    }
};
