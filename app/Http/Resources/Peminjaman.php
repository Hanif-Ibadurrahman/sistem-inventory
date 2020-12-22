<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Peminjaman extends JsonResource
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
            'no_peminjaman' => $this->no_peminjaman,
            'peminjam' => $this->email,
            'label_loker' => $this->label_loker,
            'nama_inventory' => $this->nama_inventory,
            'jumlah' => $this->jumlah,
            'pemilik' => $this->pemilik,
            'deskripsi' => $this->deskripsi,
            'lokasi' => $this->lokasi,
            'alasan_peminjaman' => $this->alasan_peminjaman,
            'status_peminjaman' => $this->status_peminjaman,
            'kondisi_inventory' => $this->kondisi_inventory,
            'dibooking' => $this->created_at,
            'dipinjam' => $this->dipinjam,
            'dikembalikan' => $this->dikembalikan,
        ];
    }
}
