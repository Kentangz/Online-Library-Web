<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'jumlah_denda',
        'status_denda',
    ];

    // Relasi dengan tabel transaksi
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi');
    }
}
