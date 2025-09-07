<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::dropIfExists('users');
}

public function down()
{
    // Recreate the table if needed for rollback
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        // Add other columns...
        $table->timestamps();
    });
}
};
