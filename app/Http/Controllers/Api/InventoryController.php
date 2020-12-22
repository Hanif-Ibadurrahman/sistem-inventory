<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use App\Models\Loker;
use Validator;
use App\Http\Resources\Inventory as InventoryResource;
// use App\Http\Resources\Inventory;

class InventoryController extends BaseController
// class InventoryController extends Controller
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

        // $listInventory = Inventory::all();

        return $this->sendResponse(InventoryResource::collection($listInventory), 'List inventory retrieved successfully.');

        // return response(['listInventory' => InventoryResource::collection($listInventory), 'message' => 'Retrieved successfully'], 200);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Inventory List',
        //     'data' => $listInventory
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'label_loker' => ['required', 'string', 'unique:loker'],
            'nama_inventory' => ['required', 'string', 'unique:inventory'],
        ]);   

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
            // return response(['error' => $validator->errors(), 'Validation Error']);       
        }

        $input['status_id'] = 1;
        $inventory = Inventory::create($input);

        $input['inventory_id'] = $inventory->id;
        $input['status'] = 0;
        $input['aktif'] = 0;
        $loker = Loker::create($input);
 
        return $this->sendResponse(new InventoryResource($inventory), 'Inventory created successfully.');
        // return response([ 'inventory' => new CEOResource($inventory), 'message' => 'Created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(Inventory $inventory)
    public function show($id)
    {
        $inventory = Inventory::find($id);

        if (is_null($inventory)) {
            return $this->sendError('Inventory not found.');
        }

        return $this->sendResponse(new InventoryResource($inventory), 'Inventory retrieved successfully.');
        // return response([ 'inventory' => new CEOResource($inventory), 'message' => 'Retrieved successfully'], 200);
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

    // public function update(Request $request, $id)
    public function update(Request $request, Inventory $inventory)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama_inventory' => ['required', 'string', 'unique:inventory'],
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
            // return response(['error' => $validator->errors(), 'Validation Error']);              
        }

        // $inventory->nama_inventory = $input['nama_inventory'];
        // $inventory->jumlah = $input['jumlah'];
        // $inventory->pemilik = $input['pemilik'];
        // $inventory->deskripsi = $input['deskripsi'];
        // $inventory->save();

        $inventory->update($input);
        return $this->sendResponse(new InventoryResource($inventory), 'Inventory updated successfully.');

        // $inventory->update($request->all());
        // return response([ 'inventory' => new InventoryResource($inventory), 'message' => 'Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return $this->sendResponse([], 'Inventory deleted successfully.');
        // return response(['message' => 'Deleted']);
    }
}
