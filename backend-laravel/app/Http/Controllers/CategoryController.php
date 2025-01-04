<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $kategori = Category::all();
        return new CategoryResource(true, 'Data fetched successfully', $kategori);
    }


    public function show($id)
    {

        $kategori = Category::find($id);
        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return new CategoryResource(true, 'Data fetched successfully', $kategori);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        $kategori = Category::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return new CategoryResource(true, 'Category created successfully', $kategori);
    }


    public function update(Request $request, $id)
    {
        $kategori = Category::find($id);

        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 400);
        }

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return new CategoryResource(true, 'Category updated successfully', $kategori);
    }


    public function destroy($id)
    {
        $kategori = Category::find($id);
        if (!$kategori) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        $kategori->delete();

        return new CategoryResource(true, 'Category deleted successfully', null);
    }
}
