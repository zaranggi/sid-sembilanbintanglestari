@extends('admin.layout')

@section('styles') 
@stop
@section('content')

<!-- begin row -->
	<div class="row row-space-10">
		<!-- begin col-3 -->
		<div class="col-md-4">
			<!-- begin widget-card -->
			<a href="{{url('materialkeluar/unit')}}" class="widget-card widget-card-rounded">
			  <div class="widget-card-cover" style="background-image: url('{{ asset('img/gallery/6.jpg')}}')"></div>
			  <div class="widget-card-content">
				<b class="text-white">Material Unit</b>
			  </div>
			  <div class="widget-card-content bottom">
				<i class="fab fa-pushed fa-5x text-indigo"></i>
				<h4 class="text-white m-t-10"><b>Pembangunan Rumah</b></h4>
			  </div>
			</a>
			<!-- end widget-card -->
		</div>
		<div class="col-md-4">
			<!-- begin widget-card -->
			<a href="{{url('materialkeluar/fasum')}}" class="widget-card widget-card-rounded">
			  <div class="widget-card-cover" style="background-image: url('{{ asset('img/gallery/4.jpg')}}')"></div>
			  <div class="widget-card-content">
				<b class="text-white">Material Fasum</b>
			  </div>
			  <div class="widget-card-content bottom">
				<i class="fab fa-pushed fa-5x text-indigo"></i>
				<h4 class="text-white m-t-10"><b>Fasilitas Umum</b></h4>
			  </div>
			</a>
			<!-- end widget-card -->
		</div>
		<div class="col-md-4">
			<!-- begin widget-card -->
			<a href="{{url('materialkeluar/revisi')}}" class="widget-card widget-card-rounded">
			  <div class="widget-card-cover" style="background-image: url('{{ asset('img/gallery/7.jpg')}}')"></div>
			  <div class="widget-card-content">
				<b class="text-white">Material Proyek Lainnya</b>
			  </div>
			  <div class="widget-card-content bottom">
				<i class="fab fa-pushed fa-5x text-indigo"></i>
				<h4 class="text-white m-t-10"><b>Proyek Lainnya</b></h4>
			  </div>
			</a>
			<!-- end widget-card -->
		</div>
	</div>
@stop  
 
