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
        Schema::create('slot_modals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable()->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('slot_timing_id')->nullable()->unsigned()->index();
            $table->foreign('slot_timing_id')->references('id')->on('slot_timing_modals')->onDelete('cascade');
            $table->bigInteger('day_id')->nullable()->unsigned()->index();
            $table->foreign('day_id')->references('id')->on('day_modals')->onDelete('cascade');
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
        Schema::dropIfExists('slot_modals');
    }
};
