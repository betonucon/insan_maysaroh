@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Home</li>
    </ol>
    <h1 class="page-header">Home <small></small></h1>
    <div class="row">
        <!-- begin col-3 -->
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                <div class="stats-info">
                    <h4>TOTAL TRANSAKSI</h4>
                    <p>Proses : {{total($tahun,0)}}</p>	
                    <p style="font-size:13px"><i>Rp.{{total_uang($tahun,0)}}</i></p>	
                </div>
                <div class="stats-link">
                    &nbsp;
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-info">
                <div class="stats-icon"><i class="fa fa-link"></i></div>
                <div class="stats-info">
                    <h4>PEMBELIAN</h4>
                    <p>Proses : {{total($tahun,1)}}</p>	
                    <p style="font-size:13px"><i>Rp.{{total_uang($tahun,1)}}</i></p>		
                </div>
                <div class="stats-link">
                    &nbsp;
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-orange">
                <div class="stats-icon"><i class="fa fa-users"></i></div>
                <div class="stats-info">
                    <h4>PENJUALAN</h4>
                    <p>Proses : {{total($tahun,2)}}</p>	
                    <p style="font-size:13px"><i>Rp.{{total_uang($tahun,2)}}</i></p>		
                </div>
                <div class="stats-link">
                    &nbsp;
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-clock"></i></div>
                <div class="stats-info">
                    <h4>CAPAIAN MODAL</h4>
                    <p style="font-size:13px"><i>Rp.{{total_uang($tahun,2)}}</i></p>	
                </div>
                <div class="stats-link">
                    &nbsp;
                </div>
            </div>
        </div>
        <!-- end col-3 -->
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- begin widget-card -->
            <a href="#" class="widget-card widget-card-rounded m-b-20" data-id="widget">
                <div class="widget-card-cover" style="background-image: url({{url_plug()}}/assets/img/gallery/gallery-portrait-11-thumb.jpg)"></div>
                <div class="widget-card-content">
                    <b class="text-white">APLIKASI PENJUALAN</b>
                </div>
                <div class="widget-card-content bottom">
                    <i class="fab fa-pushed fa-5x text-indigo"></i>
                    <h4 class="text-white m-t-10"><b>PT TAS CENTER CEMERLANG</b></h4>
                    <h5 class="f-s-12 text-white-transparent-7 m-b-2"><b>KOTA CILEGON</b></h5>
                </div>
            </a>
            <!-- end widget-card -->
        </div>
        
    </div>
</div>
@endsection

@push('ajax')
    <script>
        $('#data-table-default').DataTable({
			responsive: true
		});
    </script>
@endpush
