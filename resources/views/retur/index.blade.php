@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Reture<small> (Reture Barang)</small></h1>
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
                    <div class="btn-group" style="margin-bottom:2%">
                        <button class="btn btn-grey active" onclick="tambah(0)"><i class="fas fa-plus"></i> Baru</button>
                        <button class="btn btn-aqua active" onclick="ubah()"><i class="fas fa-pencil-alt"></i> Ubah</button>
                        <button class="btn btn-red active" onclick="hapus()">Hapus</button>
                    </div>
                    <form class="form-horizontal form-bordered" id="mydata" action="{{url('/produk')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="idkey">
                        <table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="1%" data-orderable="false"></th>
                                    <th width="12%" data-orderable="false">NO RETUR</th>
                                    <th class="text-nowrap">TRANSAKSI</th>
                                    <th class="text-nowrap">TOT PRODUK</th>
                                    <th class="text-nowrap">TOT HARGA</th>
                                    <th class="text-nowrap">TANGGAL</th>
                                    <th class="text-nowrap">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $no=>$o)
                                    <tr class="gradeX">
                                        <td class="f-s-600 text-inverse">{{$no+1}}</td>
                                        <td class="with-img"><input type="checkbox" onclick="ceklis(this.value)" name="id[]" value="{{$o->id}}"></td>
                                        <td>{{$o->no_retur}} </td>
                                        <td>Reture pada tanggal {{$o->tanggal}}</td>
                                        <td>{{$o->total_item}}</td>
                                        <td>{{uang($o->total_harga)}}</td>
                                        <td>{{$o->tanggal}}</td>
                                        <td>{!!cek_sts($o->sts)!!}</td>
                                        
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

        function tambah(id){
            location.assign("{{url('retur/form')}}?id="+id)
        }
        function ceklis(id){
            $('#idkey').val(id);
        }
        function ubah(){
            var id=$('#idkey').val();
            if(id==''){
                alert('Ceklis data yang akan diubah');
            }else{
                location.assign("{{url('retur/form')}}?id="+id)
            }
            
        }

        function hapus(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/retur/hapus')}}",
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
