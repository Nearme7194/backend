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
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('body')->unique();
            $table->unsignedInteger('state_id')->default(0);
            $table->foreign('state_id')->references('id')->on('states')
                                        ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('district_id')->default(0);
            $table->foreign('district_id')->references('id')->on('districts')
                                        ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('tehasils_id')->default(0);
            $table->foreign('tehasils_id')->references('id')->on('districts')
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
        Schema::dropIfExists('addresses');
    }
};
