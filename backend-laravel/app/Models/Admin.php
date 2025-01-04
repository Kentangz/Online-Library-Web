<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';
    protected $fillable = [
        'nama', 'email', 'password', 'image'
    ];
    protected static function booted()
    {
        static::creating(function ($admin) {
            $admin->password = bcrypt($admin->password);
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
        return ucfirst($value);
    }

    public function getEmailAttribute($value)
    {
        return strtolower($value);
    }
}
