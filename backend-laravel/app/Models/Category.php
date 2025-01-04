<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Nama tabel (jika tidak sesuai konvensi Laravel)
    protected $table = 'categories';

    // Primary key
    protected $primaryKey = 'id_kategori';

    // Tipe primary key (karena bigint unsigned)
    protected $keyType = 'int';

    // Auto increment
    public $incrementing = true;

    // Timestamps (created_at dan updated_at)
    public $timestamps = true;

    // Field yang dapat diisi (Mass Assignment)
    protected $fillable = [
        'nama_kategori', // Field yang dapat diisi
    ];

    /**
     * Accessor untuk nama_kategori
     * 
     * Mengubah nilai nama_kategori menjadi Title Case
     */
    public function books()
{
    return $this->hasMany(Book::class);
}

    public function getNamaKategoriAttribute($value)
    {
        return ucwords($value); // Mengubah ke Title Case
    }

    /**
     * Mutator untuk nama_kategori
     * 
     * Mengubah nilai nama_kategori menjadi huruf kecil semua sebelum disimpan
     */
    public function setNamaKategoriAttribute($value)
    {
        $this->attributes['nama_kategori'] = strtolower($value); // Mengubah ke lowercase
    }
}
