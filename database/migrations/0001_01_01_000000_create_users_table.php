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

        Schema::create('roles', function (Blueprint $table) {
            $table->id('id');
            $table->string('rol');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 10);
            $table->string('lastname', 10);
            $table->unsignedBigInteger('id_rol');
            $table->string('tipo_doc', 10);
            $table->bigInteger('num_doc')->unique();
            $table->string('ciudad', 20);
            $table->string('direccion', 30);
            $table->string('telefono', 10);
            $table->string('email', 30)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->foreign('id_rol')->references('id')->on('roles')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_rol')->default(2)->change();
            $table->string('lastname')->default(' ')->change();
            $table->string('tipo_doc')->default('CC')->change();
            $table->integer('num_doc')->default(0)->change();
            $table->string('ciudad')->default('Bogota D.C')->change();
            $table->string('direccion')->default(' ')->change();
            $table->string('telefono')->default(' ')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
