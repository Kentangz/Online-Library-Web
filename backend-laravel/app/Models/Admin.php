<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'admins';

    // Kolom yang bisa diisi secara massal (mass-assignment)
    protected $fillable = [
        'nama', 'email', 'password', 'image'
    ];

    // Untuk memastikan bahwa password selalu terenkripsi
    protected static function booted()
    {
        static::creating(function ($admin) {
            $admin->password = bcrypt($admin->password);  // Enkripsi password sebelum disimpan
        });
    }


    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/' . $value);  
        }
        return null;
    }

    public function getPasswordAttribute($value)
    {
        return $value;
    }


    public function getNamaAttribute($value)
    {
        return ucfirst($value);  // Menambahkan logika misalnya untuk kapitalisasi nama
    }

    public function getEmailAttribute($value)
    {
        return strtolower($value);  // Menjamin bahwa email disimpan dalam format lowercase
    }
}
