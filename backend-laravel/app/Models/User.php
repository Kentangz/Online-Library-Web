<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'image',
        'nama',
        'email',
        'password',
        'nomor_hp',
        'alamat',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getNamaAttribute($value)
    {
        return ucwords($value);
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('storage/' . $value);
        }
        return null;
    }

    public function getAlamatAttribute($value)
    {
        return trim($value);
    }
}
