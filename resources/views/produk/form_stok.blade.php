@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Detail Produk<small> {{$prod['name']}}</small></h1>
    <div class="row">
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">&nbsp;</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="row" style="margin-bottom:2%">
                        <div class="col-md-8"  style="padding-top: 6%;">
                            <button class="btn btn-white active" onclick="cetak()">Cetak</button>
                        </div>
                        <div class="col-md-4">
                            <div class="row" >
                                <div class="col-md-12" style="background:aqua;padding:2%;font-weight:bold;text-transform:uppercase;font-family: monospace;">
                                    <h2><u>REKAPAN TRANSAKSI</u></h2>
                                    Total Transaksi : {{total_kode($prod['kode'],0)}}<br>
                                    Total Masuk : {{total_kode($prod['kode'],1)}}<br>
                                    Total Keluar : {{total_kode($prod['kode'],2)}}<br>
                                    Total Reture : {{total_kode($prod['kode'],3)}}<br>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                    <form class="form-horizontal form-bordered" id="mydata" action="{{url('/produk')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="idkey">
                        <table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="1%" data-orderable="false"></th>
                                    <th class="text-nowrap" width="12%">TANGGAL</th>
                                    <th class="text-nowrap" width="8%">KODE</th>
                                    <th class="text-nowrap">PRODUK</th>
                                    <th class="text-nowrap" width="9%">JUMLAH</th>
                                    <th class="text-nowrap" width="9%">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $no=>$o)
                                    <tr class="gradeX">
                                        <td class="f-s-600 text-inverse">{{$no+1}}</td>
                                        <td class="with-img"><input type="checkbox" onclick="ceklis(this.value)" name="id[]" value="{{$o->id}}"></td>
                                        <td>{{$o->tanggal}}</td>
                                        <td>{{$o->kode}}</td>
                                        <td>{{$o->produk['name']}}</td>
                                        <td>
                                            @if($o->sts==1)
                                              <font color="red">+{{$o->jumlah}}</font>
                                            @else
                                                {{$o->jumlah}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($o->sts==1)
                                              <font color="red">MASUK</font>
                                            @elseif($o->sts==2)
                                                <font color="blue">JUAL</font>
                                            @else
                                                <font color="green">RETURE</font>
                                            @endif
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>



                    </form>
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        
    </div>
    
</div>
@endsection

@push('ajax')
    <script>
        $('#data-table-default').DataTable({
			responsive: false
		});
        $('#tglmulai').datepicker({
		    format:"yyyy-mm-dd"
	    });
        $('#tglsampai').datepicker({
		    format:"yyyy-mm-dd"
	    });
        function cari(){
            var mulai=$('#tglmulai').val();
            var sampai=$('#tglsampai').val();
            location.assign("{{url('laporanproduk')}}?mulai="+mulai+"&sampai="+sampai)
        }
        function cetak(){
            location.assign("{{url('laporanproduk/cetak')}}?mulai={{$mulai}}&sampai={{$sampai}}")
        }
        function ceklis(id){
            $('#idkey').val(id);
        }
        function ubah(){
            var id=$('#idkey').val();
            if(id==''){
                alert('Ceklis data yang akan diubah');
            }else{
                location.assign("{{url('penjualan/form')}}?id="+id)
            }
            
        }

        function hapus(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/penjualan/hapus')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
						document.getElementById("loadnya").style.width = "100%";
					},
                    success: function(msg){
                        var bat=msg.split('@');
                        if(bat[1]=='ok'){
                            location.reload();
                               
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#modal-alert').modal('show');
							$('#notifikasi').html(msg);
                        }
                        
                        
                    }
                });

        } 
    </script>
@endpush
