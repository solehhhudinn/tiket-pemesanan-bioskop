<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusColumnInPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending')->change(); // Perbarui kolom status
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('status')->default('pending')->change(); // Kembalikan kolom status jika rollback
        });
    }
}
