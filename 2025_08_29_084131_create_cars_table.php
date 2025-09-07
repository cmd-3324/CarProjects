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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
        // $table->uuid('uuid')->unique();

            $table->bigInteger('car_id');
            $table->string('name');
            $table->integer('available_as')->default(0); // number of available cars
            $table->integer("sell_number");
            $table->decimal('price', 12, 2); // e.g., 25000.00
             $table->string('engine')->nullable(); // e.g., 2.5L 4-cylinder
        $table->integer('horsepower')->nullable();
        $table->integer('torque')->nullable();
        $table->string('main_image')->nullable(); // Primary image path
        $table->json('gallery_images')->nullable(); // Array of image paths
            $table->longText('discription')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
