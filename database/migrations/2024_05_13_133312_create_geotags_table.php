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
        Schema::create('geotags', function (Blueprint $table) {
            $table->id();
						$table->string('name');
						$table->string('description')->nullable();
						$table->decimal('latitude', 11, 7);
						$table->decimal('longitude', 11, 7);
						$table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geotags');
    }
};
