<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_user')->constrained('users', 'id_user');
            $table->foreignId('id_buku')->constrained('books', 'id_buku');  // Ubah ke 'id_buku'
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();
            $table->decimal('denda', 10, 2)->default(0);
            $table->enum('status', ['dipinjam', 'kembali', 'telat'])->default('dipinjam');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
