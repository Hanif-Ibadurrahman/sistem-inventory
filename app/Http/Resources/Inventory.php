<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Inventory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'label_loker' => $this->label_loker,
            'nama_inventory' => $this->nama_inventory,
            'jumlah' => $this->jumlah,
            'pemilik' => $this->pemilik,
            'deskripsi' => $this->deskripsi,
            // 'status_id' => $this->status_id,
            // 'user_id' => $this->user_id,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}
