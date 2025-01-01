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
        Schema::create('fines', function (Blueprint $table) {
            $table->id('id_denda');
            $table->foreignId('id_transaksi')->constrained('transactions', 'id_transaksi');  // Mengarah ke 'id_transaksi'
            $table->decimal('jumlah_denda', 10, 2);
            $table->enum('status_denda', ['dibayar', 'belum dibayar']);
            $table->timestamps();
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fines');
    }
};
