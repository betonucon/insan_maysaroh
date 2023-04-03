@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Form Konsumen<small></small></h1>
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
					<form id="mydata" action="{{url('/konsumen')}}" method="post" enctype="multipart/form-data">
                        @csrf
						<input type="hidden" name="id" value="{{$id}}">
                        <fieldset>
								<!-- begin row -->
								<div class="row">
									<!-- begin col-8 -->
									<div class="col-xl-8 offset-xl-2">
										<legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Informasi konsumen</legend>
										
										<!-- begin form-group -->
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Nama konsumen </label>
											<div class="col-lg-9 col-xl-8">
												<input type="text" name="name" placeholder="Ketik disini...."  value="{{$data->name}}"  class="form-control" />
											</div>
										</div>
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Nomor Handphone </label>
											<div class="col-lg-9 col-xl-5">
												<input type="text" name="no_hp" onkeypress="return hanyaAngka(event)"  placeholder="Ketik disini...."  value="{{$data->no_hp}}"  class="form-control" />
											</div>
										</div>
										<div class="form-group row m-b-10">
											<label class="col-lg-3 text-lg-right col-form-label">Alamat </label>
											<div class="col-lg-9 col-xl-8">
												<textarea name="alamat"   placeholder="Ketik disini...." rows="4"  class="form-control" >{{$data->alamat}}</textarea>
											</div>
										</div>
										
										
									</div>
                                    <div class="col-md-12" style="text-align: center; padding: 1%; background: #f2f2fb;">
                                        <div class="btn-group mr-2 sw-btn-group" role="group">
                                            <span class="btn btn-secondary sw-btn-prev " onclick="history.back()"><i class="fas fa-arrow-alt-circle-right fa-rotate-180"></i> Kembali</span>
                                            <span class="btn btn-secondary sw-btn-next" onclick="simpan()"><i class="fas fa-save"></i>  Save</span>
                                        </div>
                                    </div>
									<!-- end col-8 -->
								</div>
								<!-- end row -->
							</fieldset>
                       

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
			responsive: true
		});
        $('#tglmulai').datepicker({
		    format:"yyyy-mm-dd"
	    });
        $('#tglsampai').datepicker({
		    format:"yyyy-mm-dd"
	    });
        function tambah(id){
            location.assign("{{url('konsumen/form')}}?id="+id)
        }

		function simpan(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/konsumen')}}",
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
                            location.assign("{{url('konsumen')}}");
                               
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
