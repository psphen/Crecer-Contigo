<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('psychologists', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('person_id');
            $table->string('specialty')->nullable();
            $table->json('work_days')->nullable();
            $table->boolean('is_active')->default(true);

            $table->foreign('person_id')->references('id')->on('person_users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psychologists');
    }
};
