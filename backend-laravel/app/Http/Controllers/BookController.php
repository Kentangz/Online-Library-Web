<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of books.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Ambil semua buku
        $books = Book::with('kategori')->get();
    
        // Manipulasi data untuk menambahkan status dan message pada setiap resource
        $bookResources = $books->map(function($book) {
            return new BookResource(true, 'Success', $book);
        });
    
        // Kembalikan respons JSON yang berisi koleksi BookResource
        return response()->json([
            'success' => true,
            'message' => 'Book list retrieved successfully',
            'data' => $bookResources,
        ]);
    }
    
    
    
        /**
     * Display the specified book.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $book = Book::find($id);
        
        if (!$book) {
            return new BookResource(false, 'Book not found', null);
        }
    
        // Kembalikan response dengan BookResource
        return new BookResource(true, 'Data fetched successfully', $book);
    }
    

    /**
     * Store a newly created book in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id_kategori',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'stok' => 'required|integer|min:1',
            'image' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }
        $book = Book::create($request->all());
        return new BookResource($book);
    }



    /**
     * Update the specified book in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'stok' => 'required|integer|min:1',
            'image' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        try {
            $book = Book::findOrFail($id);
            $book->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Book updated successfully',
                'data' => new BookResource($book),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update book',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified book from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            return response()->json([
                'success' => true,
                'message' => 'Book deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete book',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
