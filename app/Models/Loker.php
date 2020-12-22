<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;

    protected $table = 'loker';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label_loker', 'status', 'aktif', 'inventory_id', 'token', 'expired_token','token_return',
    ];   

    public function inventory(){
    	return $this->belongsTo('App\Models\Inventory');
    }

}
