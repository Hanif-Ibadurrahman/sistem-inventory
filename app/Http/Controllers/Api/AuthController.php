<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Inventory;
use App\Models\Loker;
use App\Models\Setting;
use App\Mail\RemindMail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Resources\LokerResource;
use Validator;

// class AuthController extends Controller

class AuthController extends BaseController
{
    use PasswordValidationRules;

    /**
     * Register.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'regex:/^([a-z]+)(\.[a-z]+)(\.tik[0-9]+)*@\b(?:(?:mhsw?|tik).pnj.ac.id)+$/i','max:255', 'unique:users'],
            'nip' => ['required', 'numeric', 'min:16', 'unique:users'],
            'password' => $this->passwordRules(),
        ]);
  
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        $input['password'] = Hash::make($input['password']);
       
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return $this->sendResponse($success, 'User register successfully.');

        // return response()->json(['token' => $token], 200);
    }

    /**
     * Login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
    	$data = [
    		'email' => $request->email,
    		'password' => $request->password
			// 'password' => Hash::make($request->password)
    	];

        if(Auth::attempt($data)){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            $success['id'] =  $user->id;

            return $this->sendResponse($success, 'User login successfully.');

            // return response()->json(['token' => $token], 200);
        } 

        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);

            // return response()->json(['error' => 'Unauthorised'], 401);
        } 

    }

    /**
     * Check QR Code.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function qrcode(Request $request)
    {
        $peminjaman = Peminjaman::where('token', $request->token)->first();
        if (empty($peminjaman)) {
            $peminjaman = Peminjaman::where('token_return', $request->token)->first();
            if (empty($peminjaman)) {
                return response(['success' => false, 'message' => 'Invalid Qr Code'], 404);
            }
            $user = User::where('email', $peminjaman->email)->first();
            $inventory = Inventory::where('nama_inventory', $peminjaman->nama_inventory)->where('user_id', $user->id)->first();
            $loker = Loker::where('label_loker', $peminjaman->label_loker)->where('token_return', $request->token)->first();

            if (empty($inventory) || empty($loker)) {
                return response(['success' => false, 'message' => 'Expired Qr Code'], 205);
            }

            $setting = Setting::find(1);
            $peminjaman->status_peminjaman = 'Dikembalikan';
            $peminjaman->dikembalikan = date('Y-m-d H:i:s'); //Carbon::now('Asia/Jakarta');
            $peminjaman->save();
            $inventory->status_id = 1;
            $inventory->user_id = null;
            $inventory->save();
            $loker->status = 1;
            $loker->token = Str::random(128);
            $loker->token_return = Str::random(128);
            $loker->expired_token = Carbon::now()->addMinutes($setting->durasi_booking); // Carbon::now('Asia/Jakarta')->addMinutes(10);
            $loker->save();

            return response(['success' => true, 'message' => 'Success'], 200);

        }
        $user = User::where('email', $peminjaman->email)->first();
        $inventory = Inventory::where('nama_inventory', $peminjaman->nama_inventory)->where('user_id', $user->id)->first();
        $loker = Loker::where('label_loker', $peminjaman->label_loker)->where('token', $request->token)->first();

        if (empty($inventory) || empty($loker)) {
            return response(['success' => false, 'message' => 'Expired Qr Code'], 205);
        }

        $peminjaman->status_peminjaman = 'Dipinjam';
        $peminjaman->dipinjam = date('Y-m-d H:i:s');
        $inventory->status_id = 3;
        $loker->status = 1;

        if (is_null($peminjaman->notif_waktu_pengembalian)) {
            $setting = Setting::find(1);

            $details = [
                'title' => 'Reminder',
                'message' => 'Please, return inventory before '.$setting->waktu_pengembalian.'. When you want to return inventory. You can click button below',
                'url' => 'http://127.0.0.1:8000/daftar-peminjaman'
            ];

            Mail::to($peminjaman->email)->send(new RemindMail($details));
            // dd("Mail Send Successfully");

            // Mail::to($peminjam->email)
            //     ->cc($moreUsers)
            //     ->bcc($evenMoreUsers)
            //     ->send(new RemindMail($details));

            $peminjaman->notif_waktu_pengembalian = 1;
            $peminjaman->save();
            $inventory->save();
            $loker->save();    
        }
        
        return response(['success' => true, 'message' => 'Success'], 200);
    }

    /**
     * Display a listing of the resource.
     * This call by nodemcu's microcontroller ever 5s
     * @return \Illuminate\Http\Response
     */
    public function loker()
    {
        $loker = Loker::all();
        $this->autoLockAndAnother();
        return response(['success' => true, 'data' => LokerResource::collection($loker), 'message' => 'Retrieved successfully'], 200);
    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autoLockAndAnother()
    {
        $loker = Loker::all();
        foreach ($loker as $l) {
            if ($l->status != 0) {
                $l->status = 0;
                $l->save();
            }
        }
        $this->autoAnother();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autoAnother()
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
    
    }
}
