<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public $status;
    public $message;

    /**
     * __construct
     *
     * @param mixed $status
     * @param mixed $message
     * @param mixed $resource
     * @return void
     */
    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource); // Inisialisasi parent constructor
        $this->status = $status; // Set status
        $this->message = $message; // Set message
    }

    /**
     * toArray
     *
     * @param mixed $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        // Cek apakah resource adalah koleksi atau model tunggal
        if ($this->resource instanceof \Illuminate\Database\Eloquent\Collection) {
            // Jika resource adalah koleksi (banyak data)
            return [
                'success' => $this->status,
                'message' => $this->message,
                'data' => $this->resource->map(function ($user) {
                    return [
                        'id_user'   => $user->id_user, // Mengakses id_user dari setiap user
                        'nama'      => $user->nama,
                        'email'     => $user->email,
                        'password'  => $user->password,
                        'nomor_hp'  => $user->nomor_hp,
                        'alamat'    => $user->alamat,
                        'image'     => $user->image,
                        'created_at' => $user->created_at->toDateTimeString(),
                        'updated_at' => $user->updated_at->toDateTimeString(),
                    ];
                }),
            ];
        } else {
            // Jika resource adalah model tunggal (1 data user)
            return [
                'success' => $this->status,
                'message' => $this->message,
                'data' => [
                    'id_user'   => $this->id_user,  // Mengakses id_user pada model tunggal
                    'nama'      => $this->nama,
                    'email'     => $this->email,
                    'nomor_hp'  => $this->nomor_hp,
                    'password'  => $this->password,
                    'alamat'    => $this->alamat,
                    'image'     => $this->image,
                    'created_at' => $this->created_at->toDateTimeString(),
                    'updated_at' => $this->updated_at->toDateTimeString(),
                ],
            ];
        }
    }
}
