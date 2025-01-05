<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id_kategori';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'nama_kategori', 
    ];


    public function books()
    {
        return $this->hasMany(Book::class);
    }


    public function getNamaKategoriAttribute($value)
    {
        return ucwords($value); 
    }

    
    public function setNamaKategoriAttribute($value)
    {
        $this->attributes['nama_kategori'] = strtolower($value); 
    }
}
