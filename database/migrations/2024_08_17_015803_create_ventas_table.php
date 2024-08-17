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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id('Id_venta'); // Clave primaria autoincremental
            $table->unsignedBigInteger('Id_cli'); // Clave foránea para usuarios
            $table->unsignedBigInteger('Id_Emp'); // Clave foránea para usuarios (empleado)
            $table->float('precio_Total');
            $table->date('fecha_venta');
            $table->string('tipo_venta', 40);
            $table->string('estado', 10);

            // Definición de las claves foráneas
            $table->foreign('Id_cli')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('Id_Emp')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('productos_venta', function (Blueprint $table) {
            $table->unsignedBigInteger('Id_venta'); // Clave foránea para ventas
            $table->unsignedBigInteger('Id_producto'); // Clave foránea para productos
            $table->integer('cantidad_producto');
            $table->string('talla_producto', 16)->nullable(); // Puede ser null si no se especifica talla

            // Definición de las claves foráneas
            $table->foreign('Id_venta')->references('Id_venta')->on('ventas')->onDelete('cascade');
            $table->foreign('Id_producto')->references('Id_producto')->on('productos')->onDelete('cascade');

            // Clave primaria compuesta
            $table->primary(['Id_venta', 'Id_producto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
        Schema::dropIfExists('productos_venta');
    }
};
