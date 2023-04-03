<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Reture;
use App\VReture;
use App\Produk;
use App\Transaksi;

class ReturController extends Controller
{
    public function index(request $request){
        $menu='transaksi';
        $data=VReture::orderBy('no_retur','Asc')->get();
        return view('retur.index',compact('menu','data'));
    }

    public function form(request $request){
        error_reporting(0);
        $menu='transaksi';
        if($request->id==0){
            $id=0;
        }else{
            $id=$request->id;
        }
        $data=Reture::where('id',$id)->first();
        return view('retur.form',compact('menu','data','id'));
    }

    public function hapus(request $request){
        error_reporting(0);
        $count=count($request->id);
        if($count>0){
            for($x=0;$x<$count;$x++){
                $data=Reture::where('id',$request->id[$x])->first();
                $hapus=Reture::where('id',$request->id[$x])->where('sts',1)->delete();
                if($hapus){
                    $hapus2=Transaksi::where('no_transaksi',$data['no_retur'])->where('sts',0)->delete();
                }
            }
            echo'@ok';
        }else{
            echo'<div style="padding:1%;color:#000;text-transform:uppercase">Pilih data yang akan dihapus</div>';
        }
    }
    public function simpan(request $request){
        error_reporting(0);
        
        if($request->id==0){
            $rules = [
                'tanggal'=> 'required',
            ];

            $messages = [
                'tanggal.required'=> 'Tentukan Tanggal',
            ];
        }else{
            $rules = [
                'tanggal'=> 'required',
            ];

            $messages = [
                'tanggal.required'=> 'Tentukan Tanggal',
            ];
        }
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
                    $cek=Reture::count();
                    if($cek>0){
                        $tiket=Reture::orderBy('no_retur','Desc')->firstOrfail();
                        $urutan = (int) substr($tiket['no_retur'], 2, 8);
                        $urutan++;
                        $nomor='RT'.sprintf("%08s", $urutan);
                    }else{
                        $nomor='RT'.sprintf("%08s", 1);
                    }
                   
                    $data           = New Reture;
                    $data->no_retur     = $nomor;
                    $data->tanggal     = $request->tanggal;
                    $data->sts= 1;
                    $data->save();
                    
                    echo'@ok@'.$data->id;
            }else{
                
                    $data           = Reture::find($request->id);
                    $data->tanggal     = $request->tanggal;
                    $data->save();

                    echo'@ok@'.$request->id;
                
            }
        }
    }

    public function hapus_barang(request $request){
        $cekaktif=Reture::where('no_retur',$request->no_retur)->where('sts',1)->count();
        if($cekaktif>0){
            $hapus=Transaksi::where('id',$request->id)->delete();
            echo'@ok';
        }else{
            echo'<div style="padding:1%;color:#000;text-transform:uppercase"> Transaksi Sudah diproses</div>';
        }
    }
    public function proses(request $request){
        $cekaktif=Reture::where('no_retur',$request->no_retur)->where('sts',1)->count();
        if($cekaktif>0){
            $hapus=Reture::where('no_retur',$request->no_retur)->where('sts',1)->update([
                'sts'=>2
            ]);
            echo'@ok';
        }else{
            echo'<div style="padding:1%;color:#000;text-transform:uppercase"> Transaksi Sudah diproses</div>';
        }
    }
    public function terima(request $request){
        $cekaktif=Reture::where('id',$request->id)->where('sts',2)->count();
        $per=Reture::where('id',$request->id)->where('sts',2)->first();
        if($cekaktif>0){
            $data=Reture::where('id',$request->id)->where('sts',2)->update([
                'sts'=>3
            ]);
            if($data){
                $detail=Transaksi::where('no_transaksi',$per['no_retur'])->update([
                    'sts'=>1,
                    'tanggal'=>date('Y-m-d'),
                ]);
            }
            echo'@ok';
        }else{
            echo'<div style="padding:1%;color:#000;text-transform:uppercase"> Transaksi Sudah diproses</div>';
        }
    }

    public function simpan_barang(request $request){
        error_reporting(0);
        
       
        $rules = [
            'kode'=> 'required',
            'jumlah'=> 'required',
        ];

        $messages = [
            'kode.required'=> 'Tentukan Barang',
            'jumlah.required'=> 'Tentukan jumlah',
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
            
            $produk=Produk::where('kode',$request->kode)->first();
            $cekaktif=Reture::where('no_retur',$request->no_transaksi)->where('sts',1)->count();
            if($cekaktif>0){
                if($request->jumlah>stok($request->kode)){
                    echo'<div style="padding:1%;color:#000;text-transform:uppercase"> Stok Tidak mencukupi</div>';
                }else{
                    $cek=Transaksi::where('no_transaksi',$request->no_transaksi)->where('kode',$request->kode)->count();
                    if($cek>0){
                        $data               = Transaksi::where('no_transaksi',$request->no_transaksi)->where('kode',$request->kode)->first();
                        $data->jumlah       = $request->jumlah;
                        $data->harga        = $produk['harga'];
                        $data->sts          = 3;
                        $data->tanggal      =date('Y-m-d');
                        $data->total        = ($request->jumlah*$produk['harga']);
                        $data->save();

                        echo'@ok';
                    }else{
                        $data               = New Transaksi;
                        $data->kode         = $request->kode;
                        $data->no_transaksi = $request->no_transaksi;
                        $data->jumlah       = $request->jumlah;
                        $data->harga        = $produk['harga'];
                        $data->tanggal      =date('Y-m-d');
                        $data->sts          = 3;
                        $data->total        = ($request->jumlah*$produk['harga']);
                        $data->save();
                        echo'@ok';
                    }     
                }   
            }else{
                echo'<div style="padding:1%;color:#000;text-transform:uppercase"> Transaksi Sudah diproses</div>';
            }
        }
    }
}
