@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Form Persediaan<small></small></h1>
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
					
                        
                        <div class="row">
                            <div class="col-md-3" style="height: 400px;">
                                <form id="mydata" action="{{url('/persediaan')}}" method="post" enctype="multipart/form-data">
                                    @csrf
						            <input type="hidden" name="id" value="{{$id}}">
                                    @if($id>0)
                                    <div class="form-group">
                                        <label>NOMOR PERSEDIAAN</label>
                                        <input type="text" disabled value="{{$data->no_persediaan}}" class="form-control" >
                                    </div>
                                    @endif
                                   
                                    <div class="form-group">
                                        <label>TANGGAL TRANSAKSI</label>
                                        <input type="text" name="tanggal" value="{{$data->tanggal}}" id="tglmulai" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        @if($data->sts>1)
                                            @if($data->sts==3)
                                            <div class="btn-group mr-2 sw-btn-group" role="group">
                                                <span class="btn btn-secondary sw-btn-prev " onclick="location.assign(`{{url('persediaan')}}`)"><i class="fas fa-arrow-alt-circle-right fa-rotate-180"></i> Kembali</span>
                                            </div>
                                            @else
                                            <div class="btn-group mr-2 sw-btn-group" role="group">
                                                <span class="btn btn-secondary sw-btn-prev " onclick="location.assign(`{{url('persediaan')}}`)"><i class="fas fa-arrow-alt-circle-right fa-rotate-180"></i> Kembali</span>
                                            </div>
                                            @endif
                                        @else
                                        <div class="btn-group mr-2 sw-btn-group" role="group">
                                            <span class="btn btn-secondary sw-btn-prev " onclick="location.assign(`{{url('persediaan')}}`)"><i class="fas fa-arrow-alt-circle-right fa-rotate-180"></i> Kembali</span>
                                            <span class="btn btn-secondary sw-btn-next" onclick="simpan()"><i class="fas fa-save"></i>  Save</span>
                                        </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-9" style="background: #f2f2ff; border: double #c9b2b2; height: 400px;">
                                <div class="table-responsive" style="background:#fff">
                                    <table class="table table-bordered m-b-0">
                                        <thead>
                                            <tr>
                                                <th style="font-size:11px;background:#7e4a4a;color:#fff" width="3%">#</th>
                                                <th style="font-size:11px;background:#7e4a4a;color:#fff" width="3%"></th>
                                                <th style="font-size:11px;background:#7e4a4a;color:#fff">KODE</th>
                                                <th style="font-size:11px;background:#7e4a4a;color:#fff">BARANG</th>
                                                <th style="font-size:11px;background:#7e4a4a;color:#fff">JUMLAH</th>
                                                <th style="font-size:11px;background:#7e4a4a;color:#fff">HARGA</th>
                                                <th style="font-size:11px;background:#7e4a4a;color:#fff">TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $total=0;
                                            ?>
                                            @foreach(get_transaksi($data->no_persediaan) as $nk=>$trs)
                                            <?php
                                                $total+=$trs->total;
                                            ?>
                                            <tr>
                                                <td>{{$nk+1}}</td>
                                                <td><span class="btn btn-xs btn-red" onclick="hapus_barang(`{{$data->no_persediaan}}`,{{$trs->id}})"><i class="fas fa-times-circle"></i></span></td>
                                                <td>{{$trs->kode}}</td>
                                                <td>{{$trs->produk['name']}}</td>
                                                <td>{{uang($trs->harga)}}</td>
                                                <td>{{$trs->jumlah}}</td>
                                                <td>{{uang($trs->total)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-7" style="display:flex;background: #f2f2ff; border: double #c9b2b2; padding:1%;">
                                @if($data->sts>1)
                                    <div class="btn-group">
                                        <button class="btn btn-white "><i class="fas fa-plus"></i> Tambah Barang</button>
                                        <button class="btn btn-white "><i class="fas fa-check-square"></i>  Selesai</button>
                                    </div>
                                @else
                                    <div class="btn-group">
                                        <button class="btn btn-white active" onclick="tambah_barang()"><i class="fas fa-plus"></i> Tambah Barang</button>
                                        <button class="btn btn-white active" onclick="proses(`{{$data->no_persediaan}}`)"><i class="fas fa-check-square"></i>  Selesai</button>
                                    </div>
                                @endif
                                    
                            </div>
                            <div class="col-md-2" style="display:flex;background: #f2f2ff; border: double #c9b2b2; padding:1%;">
                                <h3>{{uang($total)}}</h3>
                            </div>
                        </div>
                    
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        
    </div>

    <div class="row">
        <div class="modal fade" id="modal-tambah" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Barang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        
                        <form class="form-horizontal form-bordered" id="mydatatambah" action="{{url('/produk')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <input type="hidden" name="no_transaksi" value="{{$data->no_persediaan}}">
                                <div class="alert alert-danger m-b-0" id="alertnya">
                                    <div id="notifikasinya"></div>

                                </div>
                                <div class="form-group">
                                    <label>BARANG</label>
                                    <select name="kode" class="default-select2 form-control">
                                        <option value="">PILIH--</option>
                                        @foreach(get_produk() as $produk)
                                            <option value="{{$produk->kode}}">{{$produk->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>JUMLAH</label>
                                    <input type="text" onkeypress="return hanyaAngka(event)"  name="jumlah" class="form-control">
                                </div>
                        </form>
                        
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-primary" onclick="simpan_barang()">Proses</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
    <script>
        $('#data-table-default').DataTable({
			responsive: true
		});
        $('#tglmulai').datepicker({
		    format:"yyyy-mm-dd"
	    });
        $('#alertnya').hide();
        $('#tglsampai').datepicker({
		    format:"yyyy-mm-dd"
	    });
        function tambah_barang(){
            $('#modal-tambah').modal('show')
        }

		function hapus_barang(no_persediaan,id){
            $.ajax({
                type: 'GET',
                url: "{{url('/persediaan/hapus_barang')}}",
                data: "no_persediaan="+no_persediaan+"&id="+id,
                beforeSend: function(){
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    var bat=msg.split('@');
                        if(bat[1]=='ok'){
                            location.reload()
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#modal-alert').modal('show');
							$('#notifikasi').html(msg);
                        }
                    
                }
            });
        }
		function proses(no_persediaan){
            $.ajax({
                type: 'GET',
                url: "{{url('/persediaan/proses')}}",
                data: "no_persediaan="+no_persediaan,
                beforeSend: function(){
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    var bat=msg.split('@');
                        if(bat[1]=='ok'){
                            location.assign("{{url('persediaan')}}")
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#modal-alert').modal('show');
							$('#notifikasi').html(msg);
                        }
                    
                }
            });
        }
		function simpan(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/persediaan')}}",
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
                            @if($id>0)
                                location.reload();
                            @else
                                location.assign("{{url('persediaan/form')}}?id="+bat[2])
                            @endif
                            
                               
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#modal-alert').modal('show');
							$('#notifikasi').html(msg);
                        }
                        
                        
                    }
                });

        } 
		function simpan_terima(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/persediaan/terima')}}",
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
                           
                                location.assign("{{url('persediaan')}}")
                               
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#modal-alert').modal('show');
							$('#notifikasi').html(msg);
                        }
                        
                        
                    }
                });

        } 
		function simpan_barang(){
            var form=document.getElementById('mydatatambah');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/persediaan/tambah_barang')}}",
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
                            location.reload()
                               
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            $('#alertnya').show();
							$('#notifikasinya').html(msg);
                        }
                        
                        
                    }
                });

        } 
    </script>
@endpush
