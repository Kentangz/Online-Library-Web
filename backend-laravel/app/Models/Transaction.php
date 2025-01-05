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

    // Relasi dengan tabel books
    public function book()
    {
        return $this->belongsTo(Book::class, 'id_buku', 'id_buku');
    }

    // Relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi dengan tabel fines (denda)
    public function fines()
    {
        return $this->hasMany(Fine::class, 'id_transaksi');
    }

    // Fungsi untuk menghitung denda jika statusnya telat
    public function calculateFine()
    {
        // Misalnya denda per hari keterlambatan adalah 5000
        $dendaPerHari = 500;

        // Ambil tanggal pinjam dan tanggal kembali
        $tanggalPinjam = Carbon::parse($this->tanggal_pinjam);
        $tanggalKembali = $this->tanggal_kembali ? Carbon::parse($this->tanggal_kembali) : Carbon::now();

        // Cek jika status transaksi 'telat'
        if ($tanggalKembali->greaterThan($tanggalPinjam) && $this->status === 'telat') {
            // Hitung keterlambatan dalam hari
            $daysLate = $tanggalPinjam->diffInDays($tanggalKembali);

            // Hitung total denda
            $totalFine = $daysLate * $dendaPerHari;

            return $totalFine;
        }

        return 0; // Tidak ada denda jika tidak telat
    }

    // Fungsi untuk membuat denda otomatis
    public function createFine()
    {
        // Periksa apakah statusnya 'telat' dan denda perlu dihitung
        if ($this->status === 'telat') {
            $fineAmount = $this->calculateFine();

            // Jika ada denda, simpan ke tabel fines
            if ($fineAmount > 0) {
                $this->fines()->create([
                    'jumlah_denda' => $fineAmount,
                    'status_denda' => 'belum dibayar',
                ]);
            }
        }
    }
}
