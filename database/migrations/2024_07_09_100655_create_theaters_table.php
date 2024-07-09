<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheatersTable extends Migration
{
    public function up()
    {
        Schema::create('theaters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->decimal('price', 8, 2)->nullable(); // Harga bisa kosong (nullable)
            $table->string('image')->nullable(); // Gambar bisa kosong (nullable)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('theaters');
    }
}
