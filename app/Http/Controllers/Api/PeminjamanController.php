<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Inventory;
use App\Models\Loker;
use App\Models\Peminjaman;
use App\Http\Resources\Peminjaman as PeminjamanResource;
use App\Http\Resources\Inventory as InventoryResource;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listInventory = DB::table('inventory')
        ->join('loker', function ($join) {
            $join->on('inventory.id', '=', 'loker.inventory_id')
                 ->where('inventory.status_id', 1)->where('aktif', 1);
        })->select('*')->get();

        // return response([ 'success' => true, 'data' => $listInventory, 'message' => 'Retrieved successfully'], 200);

        return response(['success' => true, 'data' => InventoryResource::collection($listInventory), 'message' => 'Retrieved successfully'], 200);

        // return response()->json([
        //     'success' => true,
        //     'data' => $listInventory,
        //     'message' => 'Inventory List',
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar()
    {
        $booking = Peminjaman::where('email', auth()->user()->email)
            ->where('status_peminjaman', 'Booking')
            ->get();

        $pinjam = Peminjaman::where('email', auth()->user()->email)
            ->where('status_peminjaman', 'Pinjam')
            ->get();

        return response(['success' => true, 'booking' => PeminjamanResource::collection($booking), 'pinjam' => PeminjamanResource::collection($pinjam), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['no_peminjaman'] = date('dmYHis');
        $data['email'] = auth()->user()->email;
        $data['status_peminjaman']= 'Booking';
        $data['token'] = Str::random(128);

        $inventory = Inventory::where('nama_inventory', $data['nama_inventory'])->first();

        if ($inventory->status_id != 1) {
            return response(['success' => false, 'message' => 'Inventory not found'], 205);
        }

        Peminjaman::create($data);
        $inventory->status_id = 2;
        $inventory->user_id = auth()->user()->id;
        $inventory->save();

        $loker = Loker::where('label_loker', $data['label_loker'])->first();
        $loker->token = $data['token'];
        $loker->save();

        return response(['success' => true, 'message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($no_peminjaman)
    {
        $peminjaman = Peminjaman::where('no_peminjaman', $no_peminjaman)->where('email', auth()->user()->email)->first();
        $inventory = Inventory::where('status_id', 2)->where('nama_inventory', $peminjaman->nama_inventory)->where('user_id', auth()->user()->id)->first();
        $inventory->status_id = 1;
        $inventory->user_id = null;
        $inventory->save();
        $loker = Loker::where('label_loker', $peminjaman->label_loker)->first();

        $loker->token = Str::random(128);
        $loker->save();
        $peminjaman->status_peminjaman = 'Dibatalkan';
        $peminjaman->save();
        

        return response(['success' => true, 'message' => 'Success'], 200);
    }

}
