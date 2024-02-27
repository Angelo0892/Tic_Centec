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
        Schema::create('detalleservicio', function (Blueprint $table) {
            $table->id();
            $table->float('subtotal');
            
            $table->unsignedBigInteger('id_servicios');
            $table->unsignedBigInteger('id_ventas');
            $table->foreign('id_servicios')->references('id')->on('servicios');
            $table->foreign('id_ventas')->references('id')->on('ventas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleservicio');
    }
};
