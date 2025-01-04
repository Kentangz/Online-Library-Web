<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $books = Book::with('kategori')->get();
        
        $BookResources = $books->map(function($book) {
            return new BookResource(true, 'Success', $book);
        });
        return response()->json([
            'success' => true,
            'message' => 'Books list retrieved successfully',
            'data' => $BookResources,
        ]);

    }
        /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        $book = Book::with('kategori')->find($id);
    
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found',
                'data' => null
            ], 404); // Mengembalikan status 404 Not Found jika buku tidak ditemukan
        }
    
        // Kembalikan respons dengan BookResource jika buku ditemukan
        return new BookResource(true, 'Data fetched successfully', $book);
    }
    public function store(Request $request)
{
    // Validasi input dari request
    $validator = Validator::make($request->all(), [
        'judul' => 'required|string|max:255',
        'kategori_id' => 'required|exists:categories,id_kategori',
        'penulis' => 'required|string|max:255',
        'penerbit' => 'required|string|max:255',
        'stok' => 'required|integer|min:1',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 400);
    }

    // Jika ada gambar, simpan gambar di folder public/images/admins
    $imagePath = null;
    if ($request->hasFile('image')) {
        // Menyimpan gambar dengan nama unik dan mendapatkan path relatif
        $imagePath = $request->file('image')->store('images/books', 'public');
    }

    // Membuat buku baru dengan data yang ada
    $book = Book::create([
        'judul' => $request->judul,
        'kategori_id' => $request->kategori_id,
        'penulis' => $request->penulis,
        'penerbit' => $request->penerbit,
        'stok' => $request->stok,
        'image' => $imagePath, // Menyimpan path gambar
    ]);

    // Memuat relasi kategori setelah buku dibuat
    $book->load('kategori');

    // Mengembalikan response dengan BookResource
    return new BookResource(true, 'Book created successfully', $book);
}
    /**
     * Remove the specified book from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
public function update(Request $request, $id)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'judul' => 'required|string|max:255',
        'kategori_id' => 'nullable|exists:categories,id_kategori',
        'penulis' => 'nullable|string|max:255',
        'penerbit' => 'nullable|string|max:255',
        'stok' => 'nullable|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Temukan buku berdasarkan ID
    $book = Book::find($id);
    if (!$book) {
        return response()->json([
            'success' => false,
            'message' => 'Book not found',
        ], 404);
    }

    $oldImagePath = $book->image; // Simpan path gambar lama
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images/books', 'public');

        if ($oldImagePath && Storage::exists('public/images/books/' . basename($oldImagePath))) {
            Storage::delete('public/images/books/' . basename($oldImagePath));
        }
        $book->image = $imagePath;

    }
    if ($request->has('judul')) {
        $book->judul = $request->input('judul');
    }else {
        return response()->json([
            'success' => false,
            'message' => 'Judul is required',
        ], 400);
    }
    if ($request->has('kategori_id') && $request->input('kategori_id') != null) {
        $book->kategori_id = $request->input('kategori_id');
    }
    if ($request->has('penulis') && $request->input('penulis') != null) {
        $book->penulis = $request->input('penulis');}

    if ($request->has('penerbit')&& $request->input('penerbit') != null) {
        $book->penerbit = $request->input('penerbit');
    }
    if ($request->has('stok')&& $request->input('stok') != null) {
        $book->stok = $request->input('stok');
    }
    $book->load('kategori');
    $book->save();
    // Kembalikan response dengan BookResource
    return new BookResource(true, 'Book updated successfully', $book);
}

    /**
     * Remove the specified book from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Temukan buku berdasarkan ID
        $book = Book::find($id);

        // Jika buku tidak ditemukan
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found',
            ], 404);
        }

        if ($book->image) {
            Storage::delete('public/images/books/' . basename($book->image));
        }

        // Hapus buku dari database
        $book->delete();

        return new BookResource(true, 'Book deleted successfully', null);
    }

}
