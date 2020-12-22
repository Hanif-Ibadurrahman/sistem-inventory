<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_inventory', 'jumlah', 'pemilik', 'deskripsi', 'status_id', 'user_id',
    ];

    public function status(){
    	return $this->belongsTo('App\Models\Status');
    }

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }

    public function loker(){
    	return $this->hasMany('App\Models\Loker');
    }

}
