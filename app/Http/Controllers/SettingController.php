<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Mail\RemindMail;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use App\Models\Inventory;
use App\Models\Loker;
use App\Models\Lokasi;
use App\Models\Setting;
use App\Models\User;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $setting = Setting::find(1);
        $lokasi = DB::table('lokasi')
                    ->orderBy('nama_lokasi')
                    ->paginate(5);
        $i = ($lokasi->perPage() * $lokasi->currentPage()) - ($lokasi->perPage() - 1);

        return view('setting.index', compact('i', 'lokasi', 'setting', 'roles'));
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
        if ($request->has('nama_lokasi')) {
            $validatedData = $request->validate([
                'nama_lokasi' => ['unique:lokasi'],
            ]);
            $add = new Lokasi();
            $add->nama_lokasi = $request->nama_lokasi;
            $add->save();
            return redirect()->route('setting.index');    

        }elseif ($request->has('label_loker')) {
            $validatedData = $request->validate([
                'label_loker' => ['string', 'unique:loker'],
                'nama_inventory' => ['string', 'unique:inventory'],
            ]);

            $inventory = new Inventory();
            $inventory->nama_inventory = $request->nama_inventory;
            $inventory->jumlah = $request->jumlah;
            $inventory->pemilik = $request->pemilik;
            $inventory->deskripsi = $request->deskripsi;
            $inventory->status_id = 1;
            $inventory->save();

            $getIdInventory = Inventory::where('nama_inventory', $request->nama_inventory)->first();

            $loker = new Loker();
            $loker->label_loker = $request->label_loker;
            $loker->status = 0;
            $loker->aktif = 0;
            $loker->inventory_id = $getIdInventory->id;
            $loker->save();
            return redirect()->route('inventory.index');    

        }elseif ($request->has('email')) {
            $validatedData = $request->validate([
                'email' => ['string', 'email', 'regex:/^([a-z]+)(\.[a-z]+)(\.tik[0-9]+)*@\b(?:(?:mhsw?|tik).pnj.ac.id)+$/i', 'unique:users'],
                'nip' => ['min:16', 'unique:users'],
            ]);

            $name = strstr($request->email, '@', true);
            $password = Str::random(8);

            $add = new User();
            $add->name = $name;
            $add->email = $request->email;
            $add->email_verified_at = Carbon::now();
            $add->nip = $request->nip;
            $add->password = Hash::make($password);

            $details = [
                'title' => 'New User',
                'message' => 'You have just been registered by the admin as a new user. '
                        .'This your email : '.$request->email
                        .' & your password : '.$password
                        .'. Please, to login immediately and change your password.',
                'url' => 'http://127.0.0.1:8000/login'
            ];

            Mail::to($request->email)->send(new RemindMail($details));
            
            $add->save();
            $add->assignRole([$request->role]);

            Session::flash('notification', [
            'type' => 'success',
            'icon' => 'now-ui-icons ui-1_check',
            'message' => 'Add new user successfully'
            ]);

            return redirect()->route('setting.index');
        }

        $setting = Setting::find(1);
        if ($request->has('durasi_delete')) {
            $setting->durasi_delete = $request->durasi_delete;
            $setting->save();

            Session::flash('notification', [
            'type' => 'success',
            'icon' => 'now-ui-icons ui-1_check',
            'message' => 'Updated successfully'
            ]);
            // type : primary, info, success, warning, danger
            // icon : now-ui-icons ui-1_bell-53, now-ui-icons travel_info, now-ui-icons ui-1_check, now-ui-icons ui-1_simple-remove, now-ui-icons ui-2_settings-90
            // message : <strong></strong>, <b></b>

            return redirect()->route('setting.index');
        }elseif ($request->has('durasi_booking')) {
            $durasi= $request->durasi_booking; //'00:'.$request->durasi_booking.':00';
            $setting->durasi_booking = $durasi;
            $setting->save();

            Session::flash('notification', [
            'type' => 'success',
            'icon' => 'now-ui-icons ui-1_check',
            'message' => 'Updated successfully'
            ]);

            // type : primary, info, success, warning, danger
            // icon : now-ui-icons ui-1_bell-53, now-ui-icons travel_info, now-ui-icons ui-1_check, now-ui-icons ui-1_simple-remove, now-ui-icons ui-2_settings-90
            // message : <strong></strong>, <b></b>            

            return redirect()->route('setting.index');
        }else{
            $setting->waktu_pengembalian = $request->waktu_pengembalian;
            $setting->save();

            Session::flash('notification', [
            'type' => 'success',
            'icon' => 'now-ui-icons ui-1_check',
            'message' => 'Updated successfully'
            ]);

            // type : primary, info, success, warning, danger
            // icon : now-ui-icons ui-1_bell-53, now-ui-icons travel_info, now-ui-icons ui-1_check, now-ui-icons ui-1_simple-remove, now-ui-icons ui-2_settings-90
            // message : <strong></strong>, <b></b>  

            return redirect()->route('setting.index');            
        }    
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
        $hapus = Lokasi::destroy($id);
        return redirect()->route('setting.index');
    }

}
