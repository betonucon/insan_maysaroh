
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>TAS CENTER</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="{{url_plug()}}/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="{{url_plug()}}/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
    @stack('style')
	<style>
		.loadnya {
			height: 100%;
			width: 0;
			position: fixed;
			z-index: 1070;
			top: 0;
			left: 0;
			background-color: rgb(41 50 80 / 79%);
			overflow-x: hidden;
			transition: transform .9s;
		}
		.loadnya-content {
			position: relative;
			top: 25%;
			width: 100%;
			text-align: center;
			margin-top: 30px;
			color:#fff;
			font-size:50px;
		}
    </style>
</head>
<body>
	<!-- begin #page-loader -->
	<div id="loadnya" class="loadnya">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="loadnya-content">
			<i class="fas fa-spinner fa-pulse"></i>
        </div>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar-inverse">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="index.html" class="navbar-brand"><span class="navbar-logo"></span> <b>TAS CENTER </b>  CEMERLANG</a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header --><!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				
				<li class="dropdown navbar-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{url_plug()}}/assets/img/user/user-13.jpg" alt="" /> 
						<span class="d-none d-md-inline">{{Auth::user()->name}}</span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<!-- <a href="javascript:;" class="dropdown-item">Edit Profile</a>
						<a href="javascript:;" class="dropdown-item"><span class="badge badge-danger pull-right">2</span> Inbox</a>
						<a href="javascript:;" class="dropdown-item">Calendar</a>
						<a href="javascript:;" class="dropdown-item">Setting</a> -->
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('logout') }}"
							onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
			</ul>
			<!-- end header-nav -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		@include('layouts.side')
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		@yield('content')
		<!-- end #content -->
		
		<!-- begin theme-panel -->
		<div class="theme-panel theme-panel-lg">
			<a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
			<div class="theme-panel-content">
				<h5>App Settings</h5><ul class="theme-list clearfix">
					<li><a href="javascript:;" class="bg-red" data-theme="red" data-theme-file="{{url_plug()}}/assets/css/default/theme/red.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-pink" data-theme="pink" data-theme-file="{{url_plug()}}/assets/css/default/theme/pink.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Pink">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-orange" data-theme="orange" data-theme-file="{{url_plug()}}/assets/css/default/theme/orange.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-yellow" data-theme="yellow" data-theme-file="{{url_plug()}}/assets/css/default/theme/yellow.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Yellow">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-lime" data-theme="lime" data-theme-file="{{url_plug()}}/assets/css/default/theme/lime.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Lime">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-green" data-theme="green" data-theme-file="{{url_plug()}}/assets/css/default/theme/green.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Green">&nbsp;</a></li>
					<li class="active"><a href="javascript:;" class="bg-teal" data-theme="default" data-theme-file="" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-aqua" data-theme="aqua" data-theme-file="{{url_plug()}}/assets/css/default/theme/aqua.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Aqua">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-blue" data-theme="blue" data-theme-file="{{url_plug()}}/assets/css/default/theme/blue.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-purple" data-theme="purple" data-theme-file="{{url_plug()}}/assets/css/default/theme/purple.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-indigo" data-theme="indigo" data-theme-file="{{url_plug()}}/assets/css/default/theme/indigo.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Indigo">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-black" data-theme="black" data-theme-file="{{url_plug()}}/assets/css/default/theme/black.min.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
				</ul>
				
			</div>
		</div>
		<!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>

	<div class="modal fade" id="modal-alert" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Alert Error</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger m-b-0">
						<div id="notifikasi"></div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-foto" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Foto Produk</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger m-b-0">
						<div id="filefoto"></div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{url_plug()}}/assets/js/app.min.js"></script>
	<script src="{{url_plug()}}/assets/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{url_plug()}}/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/moment/min/moment.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="{{url_plug()}}/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/tag-it/js/tag-it.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="{{url_plug()}}/assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="{{url_plug()}}/assets/plugins/clipboard/dist/clipboard.min.js"></script>
	<script src="{{url_plug()}}/assets/js/demo/form-plugins.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
    <script src="{{url_plug()}}/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    @stack('ajax')
    <script>
        function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
		function lihat_gambar(foto){
			$('#modal-foto').modal('show');
			$('#filefoto').html("<img src='{{url('public/produk')}}/"+foto+"' width='100%'>");

		}
    </script>
</body>
</html>