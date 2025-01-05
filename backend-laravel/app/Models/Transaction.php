<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_user',
        'id_buku',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];


    public function book()
    {
        return $this->belongsTo(Book::class, 'id_buku', 'id_buku');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }


    public function fines()
    {
        return $this->hasMany(Fine::class, 'id_transaksi');
    }


    public function calculateFine()
    {
        $dendaPerHari = 500;
        $tanggalPinjam = Carbon::parse($this->tanggal_pinjam);
        $tanggalKembali = $this->tanggal_kembali ? Carbon::parse($this->tanggal_kembali) : Carbon::now();

        if ($tanggalKembali->greaterThan($tanggalPinjam) && $this->status === 'telat') {
            $daysLate = $tanggalPinjam->diffInDays($tanggalKembali);
            $totalFine = $daysLate * $dendaPerHari;
            return $totalFine;
        }

        return 0;
    }

    
    public function createOrUpdateFine()
    {
        $fine = $this->fines()->first();

        if (!$fine && $this->status === 'telat') {
            $fineAmount = $this->calculateFine();

            if ($fineAmount > 0) {
                $this->fines()->create([
                    'jumlah_denda' => $fineAmount,
                    'status_denda' => 'belum dibayar',
                ]);
            }
        } else if ($fine && $this->status === 'telat') {
            $fineAmount = $this->calculateFine();

            if ($fineAmount > 0) {
                $fine->update([
                    'jumlah_denda' => $fineAmount,
                    'status_denda' => 'belum dibayar',
                ]);
            }
        } else if ($fine && $this->status !== 'telat') {
            $fine->delete();
        }
    }
}
