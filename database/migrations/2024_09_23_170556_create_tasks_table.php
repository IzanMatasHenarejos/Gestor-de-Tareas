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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->unsignedBigInteger('user_id');//Id que hace referencia al id de usuarios
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');/* Que user_id hace referencia al id de la tabla users 
            y que cuando el id que hace referencia al usuario se elimina el resto de la informacion asociada tambien. */
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
