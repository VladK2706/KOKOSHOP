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
            $table->id('Id_producto');
            $table->string('nombre', 30);
            $table->integer('precio');
            $table->integer('cantidad_total');
            $table->string('tipo_producto', 16);
            $table->string('nombre_imagen', 30);
            $table->timestamps();
        });

        Schema::create('cantidad_talla', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Id_producto');
            $table->string('talla');
            $table->integer('cantidad');
            $table->foreign('Id_producto')->references('Id_producto')->on('productos')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('productos', function (Blueprint $table) {
            $table->string('nombre')->default(' ')->change();
            $table->float('precio')->default(20000.0)->change();
            $table->string('tipo_producto')->default(' ')->change();
            $table->string('nombre_imagen')->default(' ')->change();
        });

        Schema::table('cantidad_talla', function (Blueprint $table) {
            $table->string('talla')->default(' ')->change();
            $table->integer('cantidad')->default(0)->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
        Schema::dropIfExists('cantidad_talla');
    }
};
