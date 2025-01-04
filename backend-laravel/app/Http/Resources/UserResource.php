<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public $status;
    public $message;

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message; 
    }


    public function toArray(Request $request): array
    {
        if ($this->resource instanceof \Illuminate\Database\Eloquent\Collection) {
            return [
                'success' => $this->status,
                'message' => $this->message,
                'data' => $this->resource->map(function ($user) {
                    return [
                        'id_user'   => $user->id_user,
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
            return [
                'success' => $this->status,
                'message' => $this->message,
                'data' => [
                    'id_user'   => $this->id_user,
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
