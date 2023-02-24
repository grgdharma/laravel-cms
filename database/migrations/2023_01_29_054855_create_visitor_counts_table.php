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
        Schema::create('visitor_counts', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('key_value')->nullable();
            $table->string('ip_address');
            $table->string('referrer')->nullable();
            $table->mediumText('user_agent')->nullable();
            $table->mediumText('notes')->nullable();
            $table->string('visited_date');
            $table->string('visited_time');
            $table->timestamps();
            $table->index(['key','key_value','ip_address']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitor_counts');
    }
};
