<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $primaryKey = 'id_buku';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'image',
        'judul',
        'kategori_id',
        'penulis',
        'penerbit',
        'stok',
    ];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id', 'id_kategori'); 
    }
    

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('storage/' . $value); 
        }
        return null;
    }


    public function getJudulAttribute($value)
    {
        return ucwords($value);
    }


    public function getPenulisAttribute($value)
    {
        return ucwords($value);
    }


    public function getPenerbitAttribute($value)
    {
        return ucwords($value); 
    }

    
    public function getStokAttribute($value)
    {
        return (int) $value;
    }

}
