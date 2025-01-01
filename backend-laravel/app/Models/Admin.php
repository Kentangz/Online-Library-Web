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
            $admin->password = bcrypt($admin->password);
        });
    }

    // Accessor untuk kolom 'image' yang mengembalikan URL lengkap
    public function getImageAttribute($value)
    {
        if ($value) {
            return url('storage/images/admins/' . $value);
        }
        return null;
    }

    // Accessor untuk password (biasanya tidak perlu menambahkan ini)
    public function getPasswordAttribute($value)
    {
        return $value;
    }
}


