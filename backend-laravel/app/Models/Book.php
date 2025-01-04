<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Book extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak sesuai konvensi Laravel)
    protected $table = 'books';

    // Primary key
    protected $primaryKey = 'id_buku';

    // Tipe primary key (karena bigint unsigned)
    protected $keyType = 'int';

    // Auto increment
    public $incrementing = true;

    // Timestamps (created_at dan updated_at)
    public $timestamps = true;

    // Field yang dapat diisi (Mass Assignment)
    protected $fillable = [
        'image',
        'judul',
        'kategori_id',
        'penulis',
        'penerbit',
        'stok',
    ];

    // Relasi: Setiap buku memiliki satu kategori
    public function kategori()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Accessor untuk judul buku (title case)
     */
    public function getJudulAttribute($value)
    {
        return ucwords($value); // Mengubah menjadi Title Case
    }

    /**
     * Accessor untuk penulis buku (capitalizing the first letter of each word)
     */
    public function getPenulisAttribute($value)
    {
        return ucwords($value); // Mengubah penulis menjadi Title Case
    }

    /**
     * Accessor untuk penerbit buku (capitalizing the first letter of each word)
     */
    public function getPenerbitAttribute($value)
    {
        return ucwords($value); // Mengubah penerbit menjadi Title Case
    }

    /**
     * Accessor untuk stok buku (ensure it's always returned as an integer)
     */
    public function getStokAttribute($value)
    {
        return (int) $value; // Pastikan stok selalu berupa integer
    }

}
