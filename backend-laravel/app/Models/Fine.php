<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_denda';

    protected $fillable = [
        'id_transaksi',
        'jumlah_denda',
        'status_denda',
    ];


    protected $casts = [
        'jumlah_denda' => 'float',
    ];


    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi');
    }

    
    public function updateFineStatus()
    {
        $this->update(['status_denda' => 'sudah dibayar']);
    }
}
