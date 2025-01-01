<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil semua data admin
        $admins = Admin::all();

        // Mengembalikan response dengan status dan message
        return new AdminResource(true, 'Daftar Admin berhasil diambil', $admins);
    }


    public function store(Request $request)
    {
        // Validasi request tanpa 'unique' untuk email
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Jika validasi gagal, kembalikan pesan kesalahan
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity
        }
    
        // Menyimpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Menyimpan gambar ke dalam public storage dan mendapatkan path relatif
            $imagePath = $request->file('image')->store('images/admins', 'public');
        }
    
        // Menyimpan admin baru
        $admin = Admin::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'image' => $imagePath,  // Simpan hanya path relatif
        ]);
    
        // Mengembalikan response dengan status dan pesan
        return new AdminResource(true, 'Admin berhasil ditambahkan', $admin);
    }

public function show($id)
{
    // Cek apakah ID ada
    if (!$id) {
        return response()->json([
            'success' => false,
            'message' => 'ID tidak ditemukan. Harap masukkan ID yang valid.'
        ], 400); // 400 Bad Request
    }

    // Mencari admin berdasarkan ID
    try {
        $admin = Admin::findOrFail($id);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Jika tidak ditemukan admin dengan ID tersebut
        return response()->json([
            'success' => false,
            'message' => 'Tidak dapat menemukan Admin dengan ID tersebut.'
        ], 404); // 404 Not Found
    }

    // Mengembalikan response dengan status dan pesan
    return new AdminResource(true, 'Detail Admin berhasil diambil', $admin);
}


     public function update(Request $request, $id)
     {
         // Define validation rules
         $validator = Validator::make($request->all(), [
             'nama'      => 'nullable|string',
             'email'     => 'nullable|email',
             'password'  => 'nullable|string|min:8',
             'image'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
         ]);
     
         // Check if validation fails
         if ($validator->fails()) {
             return response()->json($validator->errors(), 422);
         }
     
         // Find admin by ID
         $admin = Admin::find($id);
     
         // Store the old image path
         $oldImagePath = $admin->image;
     
         // Check if image is uploaded
         if ($request->hasFile('image')) {
     
             // Upload new image and store the path relative to 'public/images/admins'
             $imagePath = $request->file('image')->store('images/admins', 'public');
     
             // Delete old image if it exists
             if ($oldImagePath && Storage::exists('public/images/admins/' . basename($oldImagePath))) {
                 Storage::delete('public/images/admins/' . basename($oldImagePath));
             }
     
             // Update admin with new image
             $admin->image = $imagePath;
         }
     
         // Update other fields if they are present
         if ($request->has('nama')) {
             $admin->nama = $request->input('nama');
         }
         
         // Only update the email if it's provided and not null
         if ($request->has('email') && $request->input('email') !== null) {
             $admin->email = $request->input('email');
         }
     
         // Only update the password if a new password is provided
         if ($request->filled('password')) {
             $admin->password = bcrypt($request->input('password'));
         }
     
         // Save the changes to the database
         $admin->save();
     
         // Return response
         return new AdminResource(true, 'Data Admin Berhasil Diubah!', $admin);
     }
     
     
     public function destroy($id)
     {
         // Mencari admin berdasarkan ID
         $admin = Admin::find($id);
     
         // Jika admin tidak ditemukan, kembalikan peringatan
         if (!$admin) {
             return response()->json([
                 'success' => false,
                 'message' => 'Admin not found'
             ], 404); // 404 Not Found
         }
     
         // Menghapus gambar jika ada
         if ($admin->image) {
             // Menghapus gambar menggunakan basename
             Storage::delete('public/images/admins/' . basename($admin->image));
         }
     
         // Menghapus data admin
         $admin->delete();
     
         // Kembalikan respons dengan status dan pesan tanpa data
         return response()->json([
             'success' => true,
             'message' => 'Admin and image deleted successfully!',
         ]);
     }
     
     
     
     
     
     
     
    
}
