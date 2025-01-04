<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('image')->nullable();
            $table->string('judul');
            $table->foreignId('kategori_id')
                  ->nullable() 
                  ->constrained('categories', 'id_kategori') 
                  ->onDelete('set null'); 
            $table->string('penulis');
            $table->string('penerbit');
            $table->integer('stok')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
