<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->foreignId('theater_id')->constrained()->onDelete('cascade');
            $table->foreignId('schedule_id')->constrained()->onDelete('cascade');
            $table->time('time'); // Mengganti 'times' menjadi 'time' untuk konsistensi dengan nama variabel di controller
            $table->integer('seat_count');
            $table->json('selected_seats')->nullable(); // Menyimpan daftar kursi yang dipilih
            $table->decimal('total_price', 10, 2); // Menyimpan total harga pembayaran
            $table->string('payment_proof')->nullable(); // Menyimpan path bukti pembayaran
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending'); // Mengganti 'Di Terima' dan 'Di Tolak' menjadi 'Accepted' dan 'Rejected'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}

