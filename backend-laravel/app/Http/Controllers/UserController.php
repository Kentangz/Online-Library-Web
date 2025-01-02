<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class UserController extends Controller
{
    // Menampilkan daftar semua user
    public function index()
    {
        // Mengambil semua data user
        $users = User::all();  
    
        // Mengembalikan koleksi data user dengan status dan message
        return new UserResource(true, 'Users retrieved successfully', $users);
    }
    
    
    
    
    
    
    

    // Menampilkan data user berdasarkan ID
    public function show($id)
    {
        // Mencari user berdasarkan ID
        $user = User::find($id);
        
        // Jika user tidak ditemukan
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
    
        // Mengembalikan data user dengan resource, menambahkan status dan message
        return new UserResource(true, 'User found successfully', $user);
    }
    

    // Membuat user baru
    public function store(Request $request)
    {
        // Validasi input menggunakan Validator
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:8',
            'nomor_hp' => 'required|string',
            'alamat' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika validasi gagal, kembalikan respons error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Proses penyimpanan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/users', 'public');
        }

        // Membuat user baru
        $user = User::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'nomor_hp' => $request->input('nomor_hp'),
            'alamat' => $request->input('alamat'),
            'image' => $imagePath,
        ]);

        // Mengembalikan data pengguna dalam format resource
        return new UserResource(true, 'User created successfully', $user);
    }
    

    // Mengupdate data user
    public function update(Request $request, $id)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'nullable|email',
            'password' => 'nullable|string|min:8',
            'nomor_hp' => 'nullable|string',
            'alamat' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar (opsional)
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
    
        // Mencari user berdasarkan ID
        $user = User::find($id);
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }
        
        $oldImagePath = $user->image;

        if ($request->hasFile('image')) {
            $imagepath = $request->file('image')->store('images/users', 'public');
            
            if ($oldImagePath && Storage::exists('public/images/users/' . basename($oldImagePath))) {
                Storage::delete('public/images/users/' . basename($oldImagePath));
            }
    
            $user->image = $imagepath;
        }
    
        // Update data user dengan input yang ada (mengecek apakah field diisi)
        if ($request->has('nama')) {
            $user->nama = $request->input('nama');
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Warning: Nama is not filled in the form data'
            ], Response::HTTP_BAD_REQUEST);
        }
    
        if ($request->has('email') && $request->input('email') !== null) {
            $user->email = $request->input('email');
        }
    
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
    
        if ($request->has('nomor_hp')) {
            $user->nomor_hp = $request->input('nomor_hp');
        }
    
        if ($request->has('alamat')) {
            $user->alamat = $request->input('alamat');
        }
    
        // Menyimpan perubahan pada user
        $user->save();
    
        // Mengembalikan response menggunakan UserResource dengan status dan pesan
        return new UserResource(true, 'User updated successfully', $user);
    }


    // Menghapus data user dan gambar
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
        // Menghapus gambar jika ada
        if ($user->image) {
            Storage::delete('public/images/users/' . basename($user->image));
        }

        // Menghapus data user
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully'
        ], Response::HTTP_OK);
    }
}
