<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_user';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    // Gak perlu ditentukan, biarkan default
    // protected $keyType = 'unsignedBigInteger'; 

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'nama',
        'email',
        'password',
        'nomor_hp',
        'alamat',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Accessor for the 'nama' attribute.
     * Capitalizes the first letter of each word in the user's name.
     *
     * @return string
     */
    public function getNamaAttribute($value)
    {
        return ucwords($value);
    }

    /**
     * Accessor for the 'image' attribute.
     * Returns the full URL if the image path is stored.
     *
     * @return string|null
     */
    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('storage/' . $value); // Assumes images are stored in the 'storage' directory
        }
        return null;
    }

    /**
     * Accessor for the 'alamat' attribute.
     * Trims whitespace and ensures proper formatting.
     *
     * @return string
     */
    public function getAlamatAttribute($value)
    {
        return trim($value);
    }
}
