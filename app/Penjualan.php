<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    public $timestamps = false;
    
    function konsumen(){
		return $this->belongsTo('App\Konsumen','konsumen_id','id');
    }
}
