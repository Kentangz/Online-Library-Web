<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Http\Resources\FineResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FineController extends Controller
{
    public function index()
    {
        $fines = Fine::with('transaction')->get();
        return new FineResource(true, 'Data denda ditemukan', $fines);
    }


    public function show($id)
    {
        $fine = Fine::with('transaction')->find($id);

        if (!$fine) {
            return response()->json([
                'success' => false,
                'message' => 'Denda tidak ditemukan',
            ], 404);
        }

        return new FineResource(true, 'Denda ditemukan', $fine);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required|exists:transactions,id_transaksi',
            'jumlah_denda' => 'required|numeric|min:0',
            'status_denda' => 'required|in:belum dibayar,dibayar',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        $fine = Fine::create([
            'id_transaksi' => $request->id_transaksi,
            'jumlah_denda' => $request->jumlah_denda,
            'status_denda' => $request->status_denda,
        ]);

        $fine->load('transaction');

        return new FineResource(true, 'Denda berhasil dibuat', $fine);
    }


    public function update(Request $request, $id)
    {
        $fine = Fine::find($id);

        if (!$fine) {
            return response()->json([
                'success' => false,
                'message' => 'Denda tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'nullable|exists:transactions,id_transaksi',
            'jumlah_denda' => 'nullable|numeric|min:0',
            'status_denda' => 'nullable|in:belum dibayar,dibayar',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 400);
        }

        $isUpdated = false;

        if ($request->has('id_transaksi') && !is_null($request->id_transaksi) && $fine->id_transaksi != $request->id_transaksi) {
            $fine->id_transaksi = $request->id_transaksi;
            $isUpdated = true;
        }

        if ($request->has('jumlah_denda') && !is_null($request->jumlah_denda) && $fine->jumlah_denda != $request->jumlah_denda) {
            $fine->jumlah_denda = $request->jumlah_denda;
            $isUpdated = true;
        }

        if ($request->has('status_denda') && !is_null($request->status_denda) && $fine->status_denda != $request->status_denda) {
            $fine->status_denda = $request->status_denda;
            $isUpdated = true;
        }

        if (!$isUpdated) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada perubahan data denda',
            ], 400);
        }

        $fine->load('transaction');
        $fine->save();

        return new FineResource(true, 'Denda berhasil diperbarui', $fine);
    }

    
    public function destroy($id)
    {
        $fine = Fine::find($id);

        if (!$fine) {
            return response()->json([
                'success' => false,
                'message' => 'Denda tidak ditemukan',
            ], 404);
        }

        $fine->delete();

        return response()->json([
            'success' => true,
            'message' => 'Denda berhasil dihapus',
        ]);
    }
}
