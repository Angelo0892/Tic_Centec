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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',40);
            $table->string('nombre', 40);
            $table->string('detalle',50)->nullable();
            $table->float('precio');
            $table->integer('stock');
            $table->longText('imagen')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('marca_id');
            $table->foreignId('tipo_id')->references('tipo_id')->on('tiposproducto');
            $table->foreignId('marca_id')->references('marca_id')->on('marcaproducto');

        
        });
    }
   

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
