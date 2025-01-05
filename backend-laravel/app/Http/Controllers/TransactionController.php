<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Pastikan ini digunakan

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return new TransactionResource(true, 'Data transaksi ditemukan', $transactions);
    }


    public function show($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return new TransactionResource(false, 'Transaksi tidak ditemukan', null);
        }
        return new TransactionResource(true, 'Data transaksi ditemukan', $transaction);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_user' => 'required|exists:users,id_user',  // Pastikan user ada
            'id_buku' => 'required|exists:books,id_buku',  // Pastikan buku ada
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after:tanggal_pinjam',  // Jika ada tanggal kembali, harus setelah tanggal pinjam
            'status' => 'required|in:dipinjam,kembali,telat',
        ]);

        // Jika validasi gagal, kembalikan respons dengan error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        

        // Membuat transaksi baru
        $transaction = Transaction::create([
            'id_user' => $request->id_user,
            'id_buku' => $request->id_buku,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->status,
        ]);

        $transaction->load('book', 'user');

        // Mengembalikan response dengan resource transaksi
        return new TransactionResource(true, 'Transaksi berhasil dibuat', $transaction);
    }


    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
    
        // Jika transaksi tidak ditemukan
        if (!$transaction) {
            return new TransactionResource(false, 'Transaksi tidak ditemukan', null);
        }
    
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_user' => 'nullable|exists:users,id_user',
            'id_buku' => 'nullable|exists:books,id_buku',
            'tanggal_pinjam' => 'nullable|date',
            'tanggal_kembali' => 'nullable|date|after:tanggal_pinjam',
            'status' => 'nullable|in:dipinjam,kembali,telat',
        ]);
    
        // Jika validasi gagal, kembalikan respons dengan error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 400);
        }
    
        // Perbarui kolom manual
        if ($request->has('id_user') && !is_null($request->id_user)) {
            $transaction->id_user = $request->id_user;
        }
        if ($request->has('id_buku') && !is_null($request->id_buku)) {
            $transaction->id_buku = $request->id_buku;
        }
        if ($request->has('tanggal_pinjam') && !is_null($request->tanggal_pinjam)) {
            $transaction->tanggal_pinjam = $request->tanggal_pinjam;
        }
        if ($request->has('tanggal_kembali') && !is_null($request->tanggal_kembali)) {
            $transaction->tanggal_kembali = $request->tanggal_kembali;
        }
        if ($request->has('status') && !is_null($request->status)) {
            $transaction->status = $request->status;
        }
    
        // Simpan data hanya jika ada perubahan
        if (!$transaction->isDirty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada perubahan pada data',
            ], 400);
        }

        $transaction->load('book', 'user');
        $transaction->save();
    
        // Kembalikan respons sukses
        return new TransactionResource(true, 'Transaksi berhasil diperbarui', $transaction);
    }
    
    

    /**
     * Menghapus transaksi berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        // Jika transaksi tidak ditemukan
        if (!$transaction) {
            return new TransactionResource(false, 'Transaksi tidak ditemukan', null);
        }

        // Menghapus transaksi
        $transaction->delete();

        // Mengembalikan response sukses
        return new TransactionResource(true, 'Transaksi berhasil dihapus', null);
    }
}
