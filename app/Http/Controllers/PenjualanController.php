<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Penjualan;
use App\VPenjualan;
use App\Produk;
use App\Transaksi;
use PDF;

class PenjualanController extends Controller
{
    public function index(request $request){
        $menu='transaksi';
        $data=VPenjualan::orderBy('no_penjualan','Asc')->get();
        return view('penjualan.index',compact('menu','data'));
    }
    public function index_laporanproduk(request $request){
        $menu='laporan';
        if($request->mulai==""){
            $mulai=date('Y').'-01-30';
            $sampai=date('Y').'-12-31';
        }else{
            $mulai=$request->mulai;
            $sampai=$request->sampai;
        }
        $data=Transaksi::whereBetween('tanggal',[$mulai,$sampai])->where('sts','>',0)->orderBy('tanggal','Asc')->get();
        return view('penjualan.index_laporanproduk',compact('menu','data','mulai','sampai'));
    }
    public function index_laporanpenjualan(request $request){
        $menu='laporan';
        if($request->mulai==""){
            $mulai=date('Y').'-01-30';
            $sampai=date('Y').'-12-31';
        }else{
            $mulai=$request->mulai;
            $sampai=$request->sampai;
        }
        $data=Transaksi::whereBetween('tanggal',[$mulai,$sampai])->where('sts','>',0)->orderBy('tanggal','Asc')->get();
        return view('penjualan.index_laporanpenjualan',compact('menu','data','mulai','sampai'));
    }
    public function cetak_laporanproduk(request $request){
        
        $mulai=$request->mulai;
        $sampai=$request->sampai;
        $data=Transaksi::whereBetween('tanggal',[$mulai,$sampai])->where('sts','>',0)->orderBy('tanggal','Asc')->get();
        $pdf = PDF::loadView('penjualan.cetak_laporanproduk', compact('mulai','sampai','data'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }

    public function form(request $request){
        error_reporting(0);
        $menu='transaksi';
        if($request->id==0){
            $id=0;
        }else{
            $id=$request->id;
        }
        $data=Penjualan::where('id',$id)->first();
        return view('penjualan.form',compact('menu','data','id'));
    }

    public function hapus(request $request){
        error_reporting(0);
        $count=count($request->id);
        if($count>0){
            for($x=0;$x<$count;$x++){
                $data=Penjualan::where('id',$request->id[$x])->first();
                $hapus=Penjualan::where('id',$request->id[$x])->where('sts',1)->delete();
                if($hapus){
                    $hapus2=Transaksi::where('no_transaksi',$data['no_penjualan'])->where('sts',0)->delete();
                }
            }
            echo'@ok';
        }else{
            echo'<div style="padding:1%;color:#000;text-transform:uppercase">Pilih data yang akan dihapus</div>';
        }
    }
    public function pelunasan(request $request){
        if($request->dibayar>$request->total){
            echo'<div style="padding:1%;color:#000;text-transform:uppercase">Pembaran melibihi tagihan</div>';
        }else{
            $save=Penjualan::where('no_penjualan',$request->no_transaksi)->update([
                'dibayar'=>($request->dibayar+$request->total_dibayar)
            ]);
            echo'@ok';
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
                    $cek=Penjualan::count();
                    if($cek>0){
                        $tiket=Penjualan::orderBy('no_penjualan','Desc')->firstOrfail();
                        $urutan = (int) substr($tiket['no_penjualan'], 2, 8);
                        $urutan++;
                        $nomor='TR'.sprintf("%08s", $urutan);
                    }else{
                        $nomor='TR'.sprintf("%08s", 1);
                    }
                   
                    $data           = New Penjualan;
                    $data->no_penjualan     = $nomor;
                    $data->tanggal     = $request->tanggal;
                    $data->sts= 1;
                    $data->total= 0;
                    $data->dibayar= 0;
                    $data->sts_bayar= 0;
                    $data->save();
                    
                    echo'@ok@'.$data->id;
            }else{
                
                    $data           = Penjualan::find($request->id);
                    $data->tanggal     = $request->tanggal;
                    $data->save();

                    echo'@ok@'.$request->id;
                
            }
        }
    }

    public function hapus_barang(request $request){
        $cekaktif=Penjualan::where('no_penjualan',$request->no_penjualan)->where('sts',1)->count();
        if($cekaktif>0){
            $hapus=Transaksi::where('id',$request->id)->delete();
            echo'@ok';
        }else{
            echo'<div style="padding:1%;color:#000;text-transform:uppercase"> Transaksi Sudah diproses</div>';
        }
    }
    public function proses(request $request){
        $cekaktif=Penjualan::where('no_penjualan',$request->no_penjualan)->where('sts',1)->count();
        if($cekaktif>0){
            $hapus=Penjualan::where('no_penjualan',$request->no_penjualan)->where('sts',1)->update([
                'sts'=>2
            ]);
            echo'@ok';
        }else{
            echo'<div style="padding:1%;color:#000;text-transform:uppercase"> Transaksi Sudah diproses</div>';
        }
    }
    public function terima(request $request){
        
            $rules = [
                'total'=> 'required',
                'sts_bayar'=> 'required',
            ];
    
            $messages = [
                'total.required'=> 'Tentukan Total',
                'sts_bayar.required'=> 'Tentukan Metode Pembayaran',
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

            $cekaktif=Penjualan::where('no_penjualan',$request->no_transaksi)->where('sts',1)->count();
            $per=Penjualan::where('no_penjualan',$request->no_transaksi)->where('sts',1)->first();
            if($cekaktif>0){
                $data=Penjualan::where('no_penjualan',$request->no_transaksi)->where('sts',1)->update([
                    'sts'=>2,
                    'total'=>$request->total,
                    'dibayar'=>$request->total,
                    'sts_bayar'=>$request->sts_bayar,
                ]);
                echo'@ok';
            }else{
                echo'<div style="padding:1%;color:#000;text-transform:uppercase"> Transaksi Sudah diproses</div>';
            }



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
            $cekaktif=Penjualan::where('no_penjualan',$request->no_transaksi)->where('sts',1)->count();
            if($cekaktif>0){
                if($request->jumlah>stok($request->kode)){
                    echo'<div style="padding:1%;color:#000;text-transform:uppercase"> Stok Tidak mencukupi</div>';
                }else{
                    $cek=Transaksi::where('no_transaksi',$request->no_transaksi)->where('kode',$request->kode)->count();
                    if($cek>0){
                        $data               = Transaksi::where('no_transaksi',$request->no_transaksi)->where('kode',$request->kode)->first();
                        $data->jumlah       = $request->jumlah;
                        $data->harga        = $produk['harga'];
                        $data->tanggal      =date('Y-m-d');
                        $data->sts          = 2;
                        $data->total        = ($request->jumlah*$produk['harga']);
                        $data->save();

                        echo'@ok';
                    }else{
                        $data               = New Transaksi;
                        $data->kode         = $request->kode;
                        $data->no_transaksi = $request->no_transaksi;
                        $data->jumlah       = $request->jumlah;
                        $data->tanggal      =date('Y-m-d');
                        $data->harga        = $produk['harga'];
                        $data->sts          = 2;
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
