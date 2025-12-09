<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            if (!Schema::hasColumn('productos', 'proveedor_id')) {
                $table->unsignedBigInteger('proveedor_id')->nullable()->after('nombre');

                $table->foreign('proveedor_id')
                      ->references('id')
                      ->on('proveedores')
                      ->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            if (Schema::hasColumn('productos', 'proveedor_id')) {
                $table->dropForeign(['proveedor_id']);
                $table->dropColumn('proveedor_id');
            }
        });
    }
};
