<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();  
        return new UserResource(true, 'Users retrieved successfully', $users);
    }

    public function show($id)
    {
        $user = User::find($id);
        

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }
    
        return new UserResource(true, 'User found successfully', $user);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:8',
            'nomor_hp' => 'required|string',
            'alamat' => 'nullable|string',
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
            $imagePath = $request->file('image')->store('images/users', 'public');
        }

        $user = User::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'nomor_hp' => $request->input('nomor_hp'),
            'alamat' => $request->input('alamat'),
            'image' => $imagePath,
        ]);

        return new UserResource(true, 'User created successfully', $user);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'nullable|email',
            'password' => 'nullable|string|min:8',
            'nomor_hp' => 'nullable|string',
            'alamat' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }
    
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
    
        $user->save();
    
        return new UserResource(true, 'User updated successfully', $user);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
        if ($user->image) {
            Storage::delete('public/images/users/' . basename($user->image));
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully'
        ], Response::HTTP_OK);
    }
}
