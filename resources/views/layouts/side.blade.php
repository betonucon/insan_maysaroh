        <div id="sidebar" class="sidebar sidebar-grid">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								<img src="{{url_plug()}}/assets/img/user/user-13.jpg" alt="" />
							</div>
							<div class="info">
								<b class="caret pull-right"></b>{{Auth::user()->name}}
								<small>Front end developer</small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
							<li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
							<li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
							<li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
						</ul>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav"><li class="nav-header">Navigation</li>
					
					<li>
						<a href="{{url('/')}}">
							<i class="fas fa-home"></i>
							<span>Home </span> 
						</a>
					</li>
					
					@if(Auth::user()->role_id==1)
					<li>
						<a href="{{url('/produk')}}">
							<i class="fas fa-bars"></i>
							<span>Produk </span> 
						</a>
					</li>
					<li>
						<a href="{{url('/stokproduk')}}">
							<i class="fas fa-archive"></i>
							<span>Stok Produk </span> 
						</a>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-cubes"></i>
							<span>Transaksi</span>
						</a>
						<ul class="sub-menu" @if($menu=='transaksi') style="display:block" @endif>
							<li><a href="{{url('persediaan')}}">Persediaan</a></li>
							<li><a href="{{url('penjualan')}}">Penjualan</a></li>
							<li><a href="{{url('retur')}}">Retur</a></li>
						</ul>
					</li>
					
					@endif
					@if(Auth::user()->role_id==2)
					<li>
						<a href="{{url('/stokproduk')}}">
							<i class="fas fa-archive"></i>
							<span>Stok Produk </span> 
						</a>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-clone"></i>
							<span>Laporan</span>
						</a>
						<ul class="sub-menu"  @if($menu=='laporan') style="display:block" @endif>
							<li><a href="{{url('laporanproduk')}}">Transaksi Produk</a></li>
							<li><a href="{{url('laporanpenjualan')}}">Transaksi Keuangan</a></li>
						</ul>
					</li>
					@endif
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
					<!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>