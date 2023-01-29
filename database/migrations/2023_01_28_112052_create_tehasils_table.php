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
        Schema::create('tehasils', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->unsignedInteger('state_id')->default(0);
            $table->foreign('state_id')->references('id')->on('states')
                                        ->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('district_id')->default(0);
            $table->foreign('district_id')->references('id')->on('districts')
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
        Schema::dropIfExists('tehasils');
    }
};
