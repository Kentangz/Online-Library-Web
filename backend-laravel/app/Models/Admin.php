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

    // Accessor untuk kolom 'image' yang mengembalikan URL lengkap
    public function getImageAttribute($value)
    {
        if ($value) {
            // Memastikan hanya satu 'storage/' yang ada
            return url('storage/' . $value);  // Pastikan URL yang dikembalikan sudah benar
        }
        return null;
    }

    // Accessor untuk password (biasanya tidak perlu menambahkan ini)
    public function getPasswordAttribute($value)
    {
        return $value; // Karena password sudah terenkripsi, cukup kembalikan value-nya
    }

    // Jika ingin menambahkan accessor atau mutator lain, misalnya untuk email atau nama
    public function getNamaAttribute($value)
    {
        return ucfirst($value);  // Menambahkan logika misalnya untuk kapitalisasi nama
    }

    public function getEmailAttribute($value)
    {
        return strtolower($value);  // Menjamin bahwa email disimpan dalam format lowercase
    }
}
