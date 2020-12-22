<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;
use App\Models\Status;
use App\Models\Inventory;
use App\Models\Loker;
use App\Models\Setting;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lokasi = [
           'AA101',
           'AA102',
           'AA103',
           'AA201',
           'AA202',
           'AA301',
           'AA302',
           'GSG101',
        ];
   
        foreach ($lokasi as $l) {
             Lokasi::create(['nama_lokasi' => $l]);
        }

        $status = [
           'Tersedia',
           'Booking',
           'Dipinjam',
        ];
   
        foreach ($status as $s) {
             Status::create(['status_inventory' => $s]);
        }

        $inventory = [

                [
                    'nama_inventory' => 'Laptop',
                    'jumlah' => '1',
                    'pemilik' => 'JTIK',
                    'deskripsi' => 'Asus',
                    'status_id' => '1',
                    'user_id' => null,
                ],
                [
                    'nama_inventory' => 'Proyektor',
                    'jumlah' => '1',
                    'pemilik' => 'JTIK',
                    'deskripsi' => 'LG',
                    'status_id' => '1',
                    'user_id' => null,
                ],
                [
                    'nama_inventory' => 'Table',
                    'jumlah' => '1',
                    'pemilik' => 'JTIK',
                    'deskripsi' => 'Samsung',
                    'status_id' => '1',
                    'user_id' => null,
                ],
                [
                    'nama_inventory' => 'Router',
                    'jumlah' => '1',
                    'pemilik' => 'JTIK',
                    'deskripsi' => 'Huawei',
                    'status_id' => '1',
                    'user_id' => null,
                ],
                [
                    'nama_inventory' => 'Kamera',
                    'jumlah' => '1',
                    'pemilik' => 'JTIK',
                    'deskripsi' => 'Canon',
                    'status_id' => '1',
                    'user_id' => null,
                ],

        ];
        Inventory::insert($inventory);

        $loker = [

                [
                    'label_loker' => '1',
                    'status' => '0',
                    'aktif' => '1',
                    'inventory_id' => '1',
                    'token' => null,
                    'token_return' => null,
                ],
                [
                    'label_loker' => '2',
                    'status' => '0',
                    'aktif' => '1',
                    'inventory_id' => '2',
                    'token' => null,
                    'token_return' => null,
                ],
                [
                    'label_loker' => '3',
                    'status' => '0',
                    'aktif' => '1',
                    'inventory_id' => '3',
                    'token' => null,
                    'token_return' => null,
                ],
                [
                    'label_loker' => '4',
                    'status' => '0',
                    'aktif' => '1',
                    'inventory_id' => '4',
                    'token' => null,
                    'token_return' => null,
                ],
                [
                    'label_loker' => '5',
                    'status' => '0',
                    'aktif' => '1',
                    'inventory_id' => '5',
                    'token' => null,
                    'token_return' => null,
                ],

        ];
        Loker::insert($loker);

        $create_permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
        ];
   
        foreach ($create_permissions as $p) {
             Permission::create(['name' => $p]);
        }

        $setting = new Setting();
        $setting->durasi_delete = 30;
        //$setting->durasi_booking = '00:15:00';
        $setting->durasi_booking = 10;
        $setting->waktu_pengembalian = '17:00:00';
        $setting->save();

        $data_admin = User::create([
            'name' => 'administrator', 
            'email' => 'admin.example@tik.pnj.ac.id',
            'email_verified_at' => Carbon::now(),
            'nip' => '3276050000000000',
            'password' => Hash::make('admin'),
        ]);
  
        $role = Role::create(['name' => 'admin']);
        $role->syncPermissions($create_permissions);
        $data_admin->assignRole([$role->id]);

        $data_member = User::create([
            'name' => 'member', 
            'email' => 'member.tik16@mhsw.pnj.ac.id',
            'email_verified_at' => Carbon::now(),
            'nip' => '3276050000000001',
            'password' => Hash::make('member'),
        ]);
  
        $role = Role::create(['name' => 'member']);
        $data_member->assignRole([$role->id]);
    }
}
