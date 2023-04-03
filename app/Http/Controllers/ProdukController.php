<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Produk;
use App\Transaksi;

class ProdukController extends Controller
{
    public function index(request $request){
        $menu='master';
        $data=Produk::orderBy('kode','Asc')->get();
        return view('produk.index',compact('menu','data'));
    }
    public function katalog(request $request){
        $menu='master';
        $data=Produk::orderBy('kode','Asc')->get();
        return view('produk.katalog',compact('menu','data'));
    }
    public function index_stok(request $request){
        $menu='stok';
        $data=Produk::orderBy('kode','Asc')->get();
        return view('produk.index_stok',compact('menu','data'));
    }

    public function form(request $request){
        error_reporting(0);
        $menu='master';
        if($request->id==0){
            $id=0;
        }else{
            $id=$request->id;
        }
        $data=Produk::where('id',$id)->first();
        return view('produk.form',compact('menu','data','id'));
    }
    public function form_stok(request $request){
        error_reporting(0);
        $menu='stok';
        if($request->id==0){
            $id=0;
        }else{
            $id=$request->id;
        }
        $prod=Produk::where('id',$id)->first();
        $data=Transaksi::where('kode',$prod['kode'])->where('sts','>',0)->orderBy('tanggal','Asc')->get();
        return view('produk.form_stok',compact('menu','data','id','prod'));
    }

    public function hapus(request $request){
        error_reporting(0);
        $count=count($request->id);
        if($count>0){
            for($x=0;$x<$count;$x++){
                $hapus=Produk::where('id',$request->id[$x])->delete();
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
                'name'=> 'required',
                'harga'=> 'required',
                'harga_jual'=> 'required',
                'file'=> 'required',
                'kode_kategori'=> 'required',
            ];

            $messages = [
                'name.required'=> 'Tentukan Nama',
                'harga.required'=> 'Tentukan Harga Beli',
                'harga_jual.required'=> 'Tentukan Harga Jual',
                'file.required'=> 'Tentukan Foto',
                'kode_kategori.required'=> 'Tentukan Kategori',
            ];
        }else{
            $rules = [
                'name'=> 'required',
                'harga'=> 'required',
                'harga_jual'=> 'required',
            ];

            $messages = [
                'name.required'=> 'Tentukan Nama',
                'harga.required'=> 'Tentukan Harga Beli',
                'harga_jual.required'=> 'Tentukan Harga Jual',
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
                    $cek=Produk::where('kode_kategori',$request->kode_kategori)->count();
                    if($cek>0){
                        $tiket=Produk::where('kode_kategori',$request->kode_kategori)->orderBy('kode','Desc')->firstOrfail();
                        $urutan = (int) substr($tiket['kode'], 4, 5);
                        $urutan++;
                        $nomor=$request->kode_kategori.sprintf("%05s", $urutan);
                    }else{
                        $nomor=$request->kode_kategori.sprintf("%05s", 1);
                    }
                    $image = $request->file('file');
                    $imageFileName =$nomor.'.'. $image->getClientOriginalExtension();
                    $filePath =$imageFileName;
                    $file = \Storage::disk('public_uploads');
                    if($file->put($filePath, file_get_contents($image))){
                        $data           = New Produk;
                        $data->kode     = $nomor;
                        $data->name     = $request->name;
                        $data->file     = $filePath;
                        $data->harga     = $request->harga;
                        $data->satuan     = $request->satuan;
                        $data->harga_jual= $request->harga_jual;
                        $data->kode_kategori= $request->kode_kategori;
                        $data->sts= 1;
                        $data->save();
                    }
                    echo'@ok';
            }else{
                if($request->file==""){
                    $data           = Produk::find($request->id);
                    $data->name     = $request->name;
                    $data->harga     = $request->harga;
                    $data->harga_jual= $request->harga_jual;
                    $data->mulai     = $request->mulai;
                    $data->sampai= $request->sampai;
                    $data->satuan     = $request->satuan;
                    $data->diskon= $request->diskon;
                    $data->save();

                    echo'@ok';
                }else{
                    $image = $request->file('file');
                    $imageFileName =$nomor.'.'. $image->getClientOriginalExtension();
                    $filePath =$imageFileName;
                    $file = \Storage::disk('public_uploads');
                    if($file->put($filePath, file_get_contents($image))){
                        $data           = Produk::find($request->id);
                        $data->name     = $request->name;
                        $data->harga     = $request->harga;
                        $data->file     = $filePath;
                        $data->harga_jual= $request->harga_jual;
                        $data->mulai     = $request->mulai;
                        $data->satuan     = $request->satuan;
                        $data->sampai= $request->sampai;
                        $data->diskon= $request->diskon;
                        $data->save();

                        echo'@ok';
                    }
                }
            }
        }
    }
}
