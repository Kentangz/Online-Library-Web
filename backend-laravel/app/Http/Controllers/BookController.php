<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('kategori')->get();
        
        $BookResources = $books->map(function($book) {
            return new BookResource(true, 'Success', $book);
        });
        return response()->json($BookResources);
    }

    public function show($id)
    {
        $book = Book::with('kategori')->find($id);
    
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found',
                'data' => null
            ], 404);
        }
        return new BookResource(true, 'Data fetched successfully', $book);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id_kategori',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'stok' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/books', 'public');
        }

        $book = Book::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'stok' => $request->stok,
            'image' => $imagePath,
        ]);

        $book->load('kategori');
        return new BookResource(true, 'Book created successfully', $book);
    }


    public function update(Request $request, $id)
    {
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

        $book = Book::find($id);
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found',
            ], 404);
        }

        $oldImagePath = $book->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/books', 'public');

            if ($oldImagePath && Storage::exists('public/images/books/' . basename($oldImagePath))) {
                Storage::delete('public/images/books/' . basename($oldImagePath));
            }
            $book->image = $imagePath;
        }

        if ($request->has('judul')) {
            $book->judul = $request->input('judul');
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Judul is required',
            ], 400);
        }

        if ($request->has('kategori_id') && $request->input('kategori_id') != null) {
            $book->kategori_id = $request->input('kategori_id');
        }
        if ($request->has('penulis') && $request->input('penulis') != null) {
            $book->penulis = $request->input('penulis');
        }
        if ($request->has('penerbit') && $request->input('penerbit') != null) {
            $book->penerbit = $request->input('penerbit');
        }
        if ($request->has('stok') && $request->input('stok') != null) {
            $book->stok = $request->input('stok');
        }

        $book->load('kategori');
        $book->save();

        return new BookResource(true, 'Book updated successfully', $book);
    }


    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found',
            ], 404);
        }

        if ($book->image) {
            Storage::delete('public/images/books/' . basename($book->image));
        }

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully',
        ]);
    }
}
