<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Pastikan ini diimport

class CategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua kategori
        $kategori = Category::all();

        // Kembalikan response menggunakan CategoryResource
        return new CategoryResource(true, 'Data fetched successfully', $kategori);
    }

    /**
     * Menyimpan kategori baru
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Jika validasi gagal, kembalikan response dengan pesan error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        // Membuat kategori baru jika validasi berhasil
        $kategori = Category::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // Kembalikan response
        return new CategoryResource(true, 'Category created successfully', $kategori);
    }

    /**
     * Menampilkan kategori berdasarkan ID
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Cari kategori berdasarkan ID
        $kategori = Category::find($id);
        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        // Kembalikan response
        return new CategoryResource(true, 'Data fetched successfully', $kategori);
    }

    /**
     * Memperbarui kategori berdasarkan ID
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Cari kategori berdasarkan ID
        $kategori = Category::find($id);

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        // Jika validasi gagal, kembalikan response dengan pesan error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        // Update kategori
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // Kembalikan response
        return new CategoryResource(true, 'Category updated successfully', $kategori);
    }

    /**
     * Menghapus kategori berdasarkan ID
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cari kategori berdasarkan ID
        $kategori = Category::find($id);
        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }
        // Hapus kategori
        $kategori->delete();

        // Kembalikan response
        return new CategoryResource(true, 'Category deleted successfully', null);
    }
}
