<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    public $timestamps = false;
    
    function produk(){
		  return $this->belongsTo('App\Produk','kode','kode');
    }
}
