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
        Schema::create('movimientos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('usuario_id')->constrained('users');
        $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); 
        $table->foreignId('proveedor_id')->nullable()->constrained('proveedores')->onDelete('cascade');
        
        $table->enum('tipo', ['entrada', 'salida']); 
        $table->integer('cantidad');
        $table->decimal('costo', 10, 2)->nullable();
        $table->date('fecha');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
    
};
