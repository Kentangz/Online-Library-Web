<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'id_user' => 'required|exists:users,id_user',
            'id_buku' => 'required|exists:books,id_buku',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after:tanggal_pinjam',
            'status' => 'required|in:dipinjam,kembali,telat',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        $transaction = Transaction::create([
            'id_user' => $request->id_user,
            'id_buku' => $request->id_buku,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->status,
        ]);

        $transaction->createOrUpdateFine($transaction->id_transaksi);
        $transaction->load('book', 'user');

        return new TransactionResource(true, 'Transaksi berhasil dibuat', $transaction);
    }


    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return new TransactionResource(false, 'Transaksi tidak ditemukan', null);
        }

        $validator = Validator::make($request->all(), [
            'id_user' => 'nullable|exists:users,id_user',
            'id_buku' => 'nullable|exists:books,id_buku',
            'tanggal_pinjam' => 'nullable|date',
            'tanggal_kembali' => 'nullable|date|after:tanggal_pinjam',
            'status' => 'nullable|in:dipinjam,kembali,telat',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

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

        if (!$transaction->isDirty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada perubahan pada data',
            ], 400);
        }

        $transaction->createOrUpdateFine($transaction->id_transaksi);
        $transaction->load('book', 'user');
        $transaction->save();

        return new TransactionResource(true, 'Transaksi berhasil diperbarui', $transaction);
    }

    
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return new TransactionResource(false, 'Transaksi tidak ditemukan', null);
        }

        $transaction->delete();

        return new TransactionResource(true, 'Transaksi berhasil dihapus', null);
    }
}
