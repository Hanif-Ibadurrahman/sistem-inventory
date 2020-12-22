<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade as Laratrust;
use App\Models\Inventory;
use App\Models\User;


class HomeController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if (Laratrust::hasRole('member')) {
        //     $listInventory = DB::table('inventory')
        //         ->join('loker', function ($join) {
        //             $join->on('inventory.id', '=', 'loker.inventory_id')
        //             ->where('inventory.status_id', 1);
        //         })->select('*')->get();
        // return view('peminjaman.index', compact('listInventory'));
            return redirect()->route('peminjaman.index');
        }

        if (Laratrust::hasRole('admin')) {
        	$admin = User::role('admin')->count();
        	$member = User::role('member')->count();
        	$inventory = Inventory::all()->count();
            return view('dashboard.admin', compact('admin', 'member', 'inventory'));
        }

        return view('auth.login');
    }

}
