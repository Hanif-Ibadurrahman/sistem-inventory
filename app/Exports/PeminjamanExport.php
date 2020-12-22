<?php

namespace App\Exports;

use App\Models\Peminjaman;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

// class PeminjamanExport implements FromCollection
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
//     public function collection()
//     {
//         return Peminjaman::all();
//     }
// }

class PeminjamanExport implements FromView
{
    public function view(): View
    {
    	$i = 1;
        return view('peminjaman.export', ['history' => Peminjaman::all(), 'i' => $i]);
    }
}
