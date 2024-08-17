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
            $table->string('nombre');
            $table->integer('precio');
            $table->integer('cantidad_total');
            $table->string('tipo_producto');
            $table->timestamps();
        });

        Schema::create('cantidad_talla', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Id_producto');
            $table->integer('talla1');
            $table->integer('talla2');
            $table->integer('talla3');
            $table->integer('talla4');
            $table->integer('talla5');

            $table->foreign('Id_producto')->references('Id_producto')->on('productos')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('productos', function (Blueprint $table) {
            $table->string('nombre')->default(' ')->change();
            $table->float('precio')->default(20000.0)->change();
            $table->string('tipo_producto')->default(' ')->change();
        });

        Schema::table('cantidad_talla', function (Blueprint $table) {
            $table->integer('talla1')->default(0)->change();
            $table->integer('talla2')->default(0)->change();
            $table->integer('talla3')->default(0)->change();
            $table->integer('talla4')->default(0)->change();
            $table->integer('talla5')->default(0)->change();
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
