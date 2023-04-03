<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    public function index(request $request){
        $menu='master';
        $data=Supplier::orderBy('kode_supplier','Asc')->get();
        return view('supplier.index',compact('menu','data'));
    }

    public function form(request $request){
        error_reporting(0);
        $menu='master';
        if($request->id==0){
            $id=0;
        }else{
            $id=$request->id;
        }
        $data=Supplier::where('id',$id)->first();
        return view('supplier.form',compact('menu','data','id'));
    }

    public function hapus(request $request){
        error_reporting(0);
        $count=count($request->id);
        if($count>0){
            for($x=0;$x<$count;$x++){
                $hapus=Supplier::where('id',$request->id[$x])->delete();
            }
            echo'@ok';
        }else{
            echo'<div style="padding:1%;color:#000;text-transform:uppercase">Pilih data yang akan dihapus</div>';
        }
    }
    public function simpan(request $request){
        error_reporting(0);
        

            $rules = [
                'name'=> 'required',
                'no_hp'=> 'required',
                'alamat'=> 'required',
            ];

            $messages = [
                'name.required'=> 'Tentukan Nama',
                'alamat.required'=> 'Tentukan alamat',
                'no_hp.required'=> 'Tentukan Harga Nomor Handphone',
            ];
       
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div style="padding:1%;color:#000;text-transform:uppercase">';
            foreach(parsing_validator($val) as $value){
                foreach($value as $isi){
                    echo'-&nbsp;'.$isi.'<br>';
                }
            }
            echo'</div>';
        }else{
            if($request->id==0){
                    $cek=Supplier::count();
                    if($cek>0){
                        $tiket=Supplier::orderBy('kode_supplier','Desc')->firstOrfail();
                        $urutan = (int) substr($tiket['kode_supplier'], 2, 5);
                        $urutan++;
                        $nomor='SP'.sprintf("%05s", $urutan);
                    }else{
                        $nomor='SP'.sprintf("%05s", 1);
                    }
                    $data           = New Supplier;
                    $data->name     = $request->name;
                    $data->kode_supplier     = $nomor;
                    $data->no_hp     = $request->no_hp;
                    $data->alamat= $request->alamat;
                    $data->save();
                    
                    echo'@ok';
            }else{
                
                    $data           = Supplier::find($request->id);
                    $data->name     = $request->name;
                    $data->no_hp     = $request->no_hp;
                    $data->alamat= $request->alamat;
                    $data->save();

                    echo'@ok';
                
            }
        }
    }
}
