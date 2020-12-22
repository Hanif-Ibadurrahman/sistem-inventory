<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use App\Models\Loker;

class InventoryController extends Controller
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
                 ->where('inventory.status_id', 1);
        })->select('*')->get();
        return view('inventory.index', compact('listInventory'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $inventory = Inventory::find($id);
        $loker = Loker::where('inventory_id', $inventory->id)->first();
        return view('inventory.edit', compact('loker', 'inventory'));
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
        $inventory = Inventory::findOrFail($id);
        if ($inventory->status_id != 1) {
            return redirect()->route('inventory.index');
        }

        $inventory->nama_inventory = $request->nama_inventory;
        $inventory->jumlah = $request->jumlah;
        $inventory->pemilik = $request->pemilik;
        $inventory->deskripsi = $request->deskripsi;
        $inventory->save();

        return redirect()->route('inventory.index');

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lock($id)
    {
        $loker = Loker::findOrFail($id);
        if ($loker->status === 0) {
            return redirect()->route('inventory.edit', $id);
        }else{
            $loker->status = 0;
            $loker->save();
            return redirect()->route('inventory.edit', $id);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unlock($id)
    {
        $loker = Loker::findOrFail($id);
        if ($loker->status === 1) {
            return redirect()->route('inventory.edit', $id);
        }else{
            $loker->status = 1;
            $loker->save();
            return redirect()->route('inventory.edit', $id);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        $loker = Loker::findOrFail($id);
        if ($loker->aktif === 1) {
            return redirect()->route('inventory.edit', $id);
        }else{
            $loker->aktif = 1;
            $loker->save();
            return redirect()->route('inventory.edit', $id);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disabled($id)
    {
        $loker = Loker::findOrFail($id);
        if ($loker->aktif === 0) {
            return redirect()->route('inventory.edit', $id);
        }else{
            $loker->aktif = 0;
            $loker->save();
            return redirect()->route('inventory.edit', $id);
        }

    }
}
