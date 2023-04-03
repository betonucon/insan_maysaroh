
<?php

function name(){
    return "Kedai PePE";
}
function telepon(){
    return "0254 233795";
}

function bulan($bulan)
{
   Switch ($bulan){
      case '01' : $bulan="Januari";
         Break;
      case '02' : $bulan="Februari";
         Break;
      case '03' : $bulan="Maret";
         Break;
      case '04' : $bulan="April";
         Break;
      case '05' : $bulan="Mei";
         Break;
      case '06' : $bulan="Juni";
         Break;
      case '07' : $bulan="Juli";
         Break;
      case '08' : $bulan="Agustus";
         Break;
      case '09' : $bulan="September";
         Break;
      case 10 : $bulan="Oktober";
         Break;
      case 11 : $bulan="November";
         Break;
      case 12 : $bulan="Desember";
         Break;
      }
   return $bulan;
}

function ubah_bulan($bul){
    if($bul>9){
        return $bul;
    }else{
        return '0'.$bul;
    }
}
function parsing_validator($url){
    $content=utf8_encode($url);
    $data = json_decode($content,true);
 
    return $data;
}
function alamat(){
    return "Rukan Mutiara Boulevard Palem Blok i2 No. 9Cengkareng, Jakarta Barat, DKI Jakarta";
}
function rekening(){
    return "163000000930300";
}
function phone(){
    return "62 21 5596 1456";
}
function whatsapp(){
    return "62 81 1800 9129";
}
function uang($uang){
    return number_format($uang,0);
}
function encoder($b) {
    $data=base64_encode(base64_encode($b));
    return $data;
 }
 function decoder($b) {
    $data=base64_decode(base64_decode($b));
    return $data;
 }
function hari_tagihan($tgl){
    $pinjam            = $tgl;
    $time        = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
    $data        = date("Y-m-d", $time);
    return $data;
}
function masa_diskon($id){
    $tglmulai=date('Y-m-d');
    $tgl=date('Y-m-d');
    if($tglmulai<=date('Y-m-d') && $tgl>=date('Y-m-d')){
        $tgl1 = new DateTime(date('Y-m-d'));
        $tgl2 = new DateTime($tgl);
        $jarak = $tgl2->diff($tgl1);

        $data=($jarak->d+1);
    }else{
        $data=0;
    }
    return $data;
}



function cek_aktif($id){
    if($id==1){
        return'Aktif';
    }else{
        return'Non Aktif';
    }
}
function total_transaksi($mulai,$sampai,$act){
    if($act==0){
        $data=App\Transaksi::whereBetween('tanggal',[$mulai,$sampai])->where('sts','>',0)->count();
    }
    if($act==1){
        $data=App\Transaksi::whereBetween('tanggal',[$mulai,$sampai])->where('sts',1)->count();
    }
    if($act==2){
        $data=App\Transaksi::whereBetween('tanggal',[$mulai,$sampai])->where('sts',2)->count();
    }
    
    
    return $data;
}
function total_kode($kode,$act){
    if($act==0){
        $data=App\Transaksi::where('kode',$kode)->where('sts','>',0)->sum('jumlah');
    }
    if($act==1){
        $data=App\Transaksi::where('kode',$kode)->where('sts',1)->sum('jumlah');
    }
    if($act==2){
        $data=App\Transaksi::where('kode',$kode)->where('sts',2)->sum('jumlah');
    }
    if($act==3){
        $data=App\Transaksi::where('kode',$kode)->where('sts',3)->sum('jumlah');
    }
    
    
    return $data;
}
function total($tahun,$act){
    if($act==0){
        $data=App\Transaksi::whereYear('tanggal',$tahun)->where('sts','>',0)->count();
    }
    if($act==1){
        $data=App\Transaksi::whereYear('tanggal',$tahun)->where('sts',1)->count();
    }
    if($act==2){
        $data=App\Transaksi::whereYear('tanggal',$tahun)->where('sts',2)->count();
    }
    
    
    return $data;
}
function stok($kode){
    
   
    $masuk=App\Transaksi::where('kode',$kode)->where('sts',1)->sum('jumlah');
    $keluar=App\Transaksi::where('kode',$kode)->where('sts',2)->sum('jumlah');
    
    return ($masuk-$keluar);
    
}
function update($kode){
    
    $cek=App\Transaksi::where('kode',$kode)->where('sts','>',0)->count();
    if($cek>0){
        $cek=App\Transaksi::where('kode',$kode)->where('sts','>',0)->orderBy('id','Desc')->firstOrfail();
        
        return $data['tanggal'];
    }else{
        return '-';
    }
}
function total_uang($tahun,$act){
    if($act==0){
        $data=App\Transaksi::whereYear('kode',$tahun)->where('sts','>',0)->sum('total');
    }
    if($act==1){
        $data=App\Transaksi::whereYear('tanggal',$tahun)->where('sts',1)->sum('total');
    }
    if($act==2){
        $data=App\Transaksi::whereYear('tanggal',$tahun)->where('sts',2)->sum('total');
    }
    
    
    return uang($data);
}
function total_transaksi_uang($mulai,$sampai,$act){
    if($act==0){
        $data=App\Transaksi::whereBetween('tanggal',[$mulai,$sampai])->where('sts','>',0)->sum('total');
    }
    if($act==1){
        $data=App\Transaksi::whereBetween('tanggal',[$mulai,$sampai])->where('sts',1)->sum('total');
    }
    if($act==2){
        $data=App\Transaksi::whereBetween('tanggal',[$mulai,$sampai])->where('sts',2)->sum('total');
    }
    
    
    return $data;
}
function cek_sts($id){
    if($id==1){
        return'<span class="label label-info">Proses</span>';
    }
    if($id==2){
        return'<span class="label label-success">Selesai</span>';
    }
    if($id==3){
        return'<span class="label label-success">Selesai</span>';
    }
}
function cek_tagihan($nilai1,$nilai2,$sts){
    if($sts==3){
        if($nilai1==$nilai2){
            return'<span class="label label-info">LUNAS</span>';
        }
        else{
            return'<span class="label label-red">HUTANG</span>';
        }
    }else{
        return'-';
    }
}
function cek_metode($id){
    if($id==1){
        return'CASH';
    }
    if($id==2){
        return'TEMPO';
    }
    if($id==3){
        return'-';
    }
}

function diskon($harga,$diskon){
    $data=($harga*$diskon)/100;
    $diskon=($harga-$data);
    return $diskon;

}

function diskon_harga($id,$harga,$diskon){
    if( masa_diskon($id)>0){
        $data=($harga*$diskon)/100;
        $diskon=($harga-$data);
    }else{
        $diskon=$harga;
    }
    
    return $diskon;

}
function email(){
    return "Rukan Mutiara Boulevard Palem Blok i2 No. 9Cengkareng, Jakarta Barat, DKI Jakarta";
}
function url_plug(){
    $data=url('public');
    return $data;
}

function gambar(){
    $data=url('public/dist/produk/');
    return $data;
}

function link_artikel($nama){
    $patr='/\s+/';
    $link=preg_replace($patr,'_',$nama);
    return $link;
}

function get_kategori(){
    $data=App\Kategori::orderBy('name','Asc')->get();
    return $data;
}
function get_supplier(){
    $data=App\Supplier::orderBy('name','Asc')->get();
    return $data;
}
function get_konsumen(){
    $data=App\Konsumen::orderBy('name','Asc')->get();
    return $data;
}
function get_produk(){
    $data=App\Produk::orderBy('name','Asc')->get();
    return $data;
}
function get_transaksi($kode){
    $data=App\Transaksi::where('no_transaksi',$kode)->orderBy('id','Asc')->get();
    return $data;
}



?>