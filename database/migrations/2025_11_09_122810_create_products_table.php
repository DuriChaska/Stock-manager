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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // La línea de brands está comentada para que la migración pueda ejecutarse sin la tabla 'brands'.
            // ¡Esto soluciona el error 1824!
            // $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade'); 
            $table->string('size')->nullable();
            $table->integer('stock')->default(0);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
