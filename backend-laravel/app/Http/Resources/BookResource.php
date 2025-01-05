<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
        return [
            'success' => $this->status,
            'message' => $this->message,
            'data' => [
                'id_buku' => $this->id_buku,
                'image' => $this->image,
                'judul' => $this->judul,
                'penulis' => $this->penulis,
                'penerbit' => $this->penerbit,
                'stok' => $this->stok,
                'kategori' => new CategoryResource(true, 'Success', $this->whenLoaded('kategori')),
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]
        ];
    }
}
