<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    public $timestamps = false;
    
    function kategori(){
		return $this->belongsTo('App\Kategori','kode_kategori','kode_kategori');
    }
}
