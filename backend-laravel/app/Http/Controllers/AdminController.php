<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return new AdminResource(true, 'Admin list retrieved successfully', $admins);
    }

    
    public function show($id)
    {
        if (!$id) {
            return response()->json([
                'success' => false,
                'message' => 'ID not found. Please provide a valid ID.'
            ], 400);
        }

        try {
            $admin = Admin::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Admin with the given ID not found.'
            ], 404);
        }

        return new AdminResource(true, 'Admin details retrieved successfully', $admin);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|string|email|unique:admins,email',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/admins', 'public');
        }

        $admin = Admin::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'image' => $imagePath,
        ]);

        return new AdminResource(true, 'Admin added successfully', $admin);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'nullable|email',
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found'
            ], 404);
        }

        $oldImagePath = $admin->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/admins', 'public');

            if ($oldImagePath && Storage::exists('public/images/admins/' . basename($oldImagePath))) {
                Storage::delete('public/images/admins/' . basename($oldImagePath));
            }

            $admin->image = $imagePath;
        }
        if ($request->has('nama')) {
            $$admin->nama = $request->input('nama');
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Warning: Nama is not filled in the form data'
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($request->has('email') && $request->input('email') !== null) {
            $admin->email = $request->input('email');
        }

        if ($request->filled('password')) {
            $admin->password = bcrypt($request->input('password'));
        }

        $admin->save();

        return new AdminResource(true, 'Admin data updated successfully!', $admin);
    }


    public function destroy($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not found'
            ], 404);
        }

        if ($admin->image) {
            Storage::delete('public/images/admins/' . basename($admin->image));
        }

        $admin->delete();

        return response()->json([
            'success' => true,
            'message' => 'Admin and image deleted successfully!',
        ]);
    }

        // Method login
        public function login(Request $request)
        {
            // Validasi input email dan password
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
    
            // Mencari admin berdasarkan email
            $admin = Admin::where('email', $request->email)->first();
    
            // Jika admin tidak ditemukan atau password tidak cocok
            if (!$admin || !Hash::check($request->password, $admin->password)) {
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }
    
            // Jika login berhasil
            return new AdminResource(true, 'Login successful', $admin);
        }
}
