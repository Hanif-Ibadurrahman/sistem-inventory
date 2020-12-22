<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inventory;
use App\Models\Loker;
use App\Models\Lokasi;
use App\Models\Setting;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $check = Loker::all(); //Loker::where('expired_token', '>=', Carbon::now());
        $setting = Setting::find(1);
        //if (!empty($check)) {

            foreach ($check as $c) {
                if (Carbon::parse($c->expired_token)->floatDiffInMinutes(Carbon::now()) > 0) {
                    $inventory = Inventory::find($c->inventory_id);
                    if (is_null($inventory->user_id)) {
                        $c->expired_token = Carbon::now()->addMinutes($setting->durasi_booking);
                        $c->token = Str::random(128);
                        $c->save();
                    }else {                        
                        $user = User::find($inventory->user_id);
                        $peminjaman = Peminjaman::where('nama_inventory', $inventory->nama_inventory)->where('status_peminjaman', 'Booking')->where('email', $user->email)->first();
                        $c->expired_token = Carbon::now()->addMinutes($setting->durasi_booking);
                        $c->token = Str::random(128);
                        $inventory->status_id = 1;
                        $inventory->user_id = null;
                        $peminjaman->status_peminjaman = 'Expired';
                        $peminjaman->save();
                        $inventory->save();
                        $c->save();
                    }
                }
            }
        //}

        $listInventory = DB::table('inventory')
        ->join('loker', function ($join) {
            $join->on('inventory.id', '=', 'loker.inventory_id')
                 ->where('inventory.status_id', 1)->where('aktif', 1);
        })->select('*')->get();
        
        return view('peminjaman.index', compact('listInventory'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar()
    {
        $booking = Peminjaman::where('email', Auth::user()->email)
            ->where('status_peminjaman', 'Booking')
            ->get();

        $pinjam = Peminjaman::where('email', Auth::user()->email)
            ->where('status_peminjaman', 'Dipinjam')
            ->get();

        return view('peminjaman.daftar', compact('booking', 'pinjam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'alasan_peminjaman' => ['required', 'unique:posts', 'max:255'],
        // ]);

        $data = $request->all();
        $user = Auth::user();
        $data['no_peminjaman'] = date('dmYHis'); 
        $data['email'] = $user->email;
        $data['status_peminjaman']= 'Booking';
        $data['token'] = Str::random(128);

        $inventory = Inventory::where('nama_inventory', $data['nama_inventory'])->first();

        if ($inventory->status_id != 1) {
            return redirect()->route('peminjaman.index');
        }

        Peminjaman::create($data);
        $inventory->status_id = 2;
        $inventory->user_id = $user->id;
        $inventory->save();

        $setting = Setting::find(1);
        $loker = Loker::where('label_loker', $data['label_loker'])->first();
        $loker->token = $data['token'];
        $loker->expired_token = Carbon::now()->addMinutes($setting->durasi_booking); // Carbon::now('Asia/Jakarta')->addMinutes(10);
        $loker->save();

        return redirect('/daftar-peminjaman');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = Inventory::find($id);
        $loker = Loker::find($id);
        $lokasi = Lokasi::all();
        if ($inventory->status_id != 1) {
        return redirect()->route('peminjaman.index');
        }
        return view('peminjaman.show', compact('lokasi', 'loker', 'inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($no_peminjaman)
    {
        $user = Auth::user();
        $peminjaman = Peminjaman::where('no_peminjaman', $no_peminjaman)->where('email', $user->email)->first();
        $peminjaman->status_peminjaman = 'Dibatalkan';
        $peminjaman->save();
        $inventory = Inventory::where('status_id', 2)->where('nama_inventory', $peminjaman->nama_inventory)->where('user_id', $user->id)->first();
        $inventory->status_id = 1;
        $inventory->user_id = null;
        $inventory->save();
        $setting = Setting::find(1);
        $loker = Loker::where('label_loker', $peminjaman->label_loker)->first();
        $loker->token = Str::random(128);
        $loker->expired_token = Carbon::now()->addMinutes($setting->durasi_booking); // 
        $loker->save();

        return redirect('/daftar-peminjaman');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        $input = $request->all();
        $input['token_return'] = Str::random(128);
        
        $loker = Loker::where('label_loker', $peminjaman->label_loker)->first();
        $loker->token_return = $input['token_return'];
        $loker->save();

        $peminjaman->update($input);
        
        return redirect('/daftar-peminjaman');
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $history = Peminjaman::where('email', Auth::user()->email)->orderBy('created_at', 'desc')->paginate(2);
        $i = ($history->perPage() * $history->currentPage()) - ($history->perPage() - 1);
        return view('peminjaman.history', compact('i', 'history'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function riwayat()
    {
        $history = DB::table('peminjaman')
                    ->orderBy('created_at', 'desc')
                    ->paginate(2);
        $i = ($history->perPage() * $history->currentPage()) - ($history->perPage() - 1);
        return view('peminjaman.riwayat', compact('i', 'history'));
    }

    /**
     * Search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $r = $request->keyword;
        $email = Auth::user()->email;
        $k = '%'.$r.'%';
        $history = DB::table('peminjaman')
                //->where('no_peminjaman', 'like', '%'.$r.'%')
                ->whereRaw('no_peminjaman like ? or email like ? or label_loker like ?  or nama_inventory like ? or jumlah like ? or pemilik like ? or deskripsi like ? or lokasi like ? or alasan_peminjaman like ? or status_peminjaman like ? or created_at like ? or dipinjam like ? or dikembalikan like ? and email = ?', [$k,$k,$k,$k,$k,$k,$k,$k,$k,$k,$k,$k,$k,$email])
                ->paginate(2);
        $i = ($history->perPage() * $history->currentPage()) - ($history->perPage() - 1);
        return view('peminjaman.history', compact('i', 'history'));
    }

    /**
     * Search.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cari(Request $request)
    {
        $r = $request->keyword;
        $email = Auth::user()->email;
        $k = '%'.$r.'%';
        $history = DB::table('peminjaman')
                //->where('no_peminjaman', 'like', '%'.$r.'%')
                ->whereRaw('no_peminjaman like ? or email like ? or label_loker like ?  or nama_inventory like ? or jumlah like ? or pemilik like ? or deskripsi like ? or lokasi like ? or alasan_peminjaman like ? or status_peminjaman like ? or created_at like ? or dipinjam like ? or dikembalikan like ? and email = ?', [$k,$k,$k,$k,$k,$k,$k,$k,$k,$k,$k,$k,$k,$email])
                ->paginate(2);
        $i = ($history->perPage() * $history->currentPage()) - ($history->perPage() - 1);
        return view('peminjaman.riwayat', compact('i', 'history'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function qrcode($no_peminjaman)
    {
        $peminjaman = Peminjaman::where('no_peminjaman', $no_peminjaman)
                            ->where('email', Auth::user()->email)
                            ->where('status_peminjaman', 'Booking')
                            ->first();
        if (empty($peminjaman)) {
            return redirect('/daftar-peminjaman');
        }        

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);
        // $qrcode = $writer->writeFile('Hello World!', 'qrcode.png');
        $qrcode = base64_encode($writer->writeString($peminjaman->token));

        return view('peminjaman.qrcode', compact('qrcode'));
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function return($no_peminjaman)
    {
        $peminjaman = Peminjaman::where('no_peminjaman', $no_peminjaman)
                            ->where('email', Auth::user()->email)
                            ->where('status_peminjaman', 'Dipinjam')
                            ->first();
                            
        if (empty($peminjaman)) {
            return redirect('/daftar-peminjaman');
        }           

            $renderer = new ImageRenderer(
                new RendererStyle(200),
                new ImagickImageBackEnd()
            );
            $writer = new Writer($renderer);
            // $qrcode = $writer->writeFile('Hello World!', 'qrcode.png');
            $qrcode = base64_encode($writer->writeString($peminjaman->token_return));

            return view('peminjaman.qrcode', compact('qrcode'));
        
    }

    /**
     * Export to excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function excel() 
    {
        //$filename = 'history_peminjaman_'.date('d-m-Y_H-i-s').'.xlsx';
        return Excel::download(new PeminjamanExport, 'history-peminjaman.xlsx');
    }

    /**
     * Export to pdf.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf() 
    {

        //return Excel::download(new PeminjamanExport, 'history-peminjaman.pdf');

        $i=1;
        $pdf = PDF::loadView('peminjaman.export', ['history' => Peminjaman::all(), 'i' => $i])->setPaper('a4', 'landscape');
        return $pdf->stream('history-peminjaman.pdf');
    }

}
