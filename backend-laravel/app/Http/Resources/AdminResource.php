<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
                'data' => $this->resource->map(function ($admin) {
                    return [
                        'id' => $admin->id, 
                        'nama' => $admin->nama,
                        'email' => $admin->email,
                        'password' => $admin->password,
                        'created_at' => $admin->created_at,
                        'updated_at' => $admin->updated_at,
                        'image_url' => $admin->image,  
                    ];
                }),
            ];
        } else {
            return [
                'success' => $this->status,
                'message' => $this->message,
                'data' => [
                    'id' => $this->resource->id, 
                    'nama' => $this->resource->nama,
                    'email' => $this->resource->email,
                    'password' => $this->resource->password,
                    'created_at' => $this->resource->created_at,
                    'updated_at' => $this->resource->updated_at,
                    'image_url' => $this->resource->image,
                ],
            ];
        }
    }
    
}
