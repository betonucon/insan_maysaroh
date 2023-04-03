<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persediaan extends Model
{
    protected $table = 'persediaan';
    public $timestamps = false;
    
    function supplier(){
		return $this->belongsTo('App\Supplier','kode_supplier','kode_supplier');
    }
}
