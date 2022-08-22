@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Laporan Proses  <small>KPR</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Periode : {{ App\Helpers\Tanggal::tgl_indo($tanggal1) }} s/d {{ App\Helpers\Tanggal::tgl_indo($tanggal2) }}</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">  
				<h4 class="panel-title text-center m-b-15">Status Berkas Konsumen: {{ ucwords($status)}} <br/>
					Periode : {{ App\Helpers\Tanggal::tgl_indo($tanggal1) }} s/d {{ App\Helpers\Tanggal::tgl_indo($tanggal2) }}</h4>
				<br/><br/><br/>
				<!-- begin table-responsive -->
				 <div class="col-lg-6 col-lg-offset-3">
                    <div class="panel pagination-grey clearfix m-b-0 table-responsive">
                        <div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr class="font-weight-bold text-center bg-indigo text-white">  
										<th >Total Unit </th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; ?>
									@foreach($data2 as $r)
										<tr> 
											<td class="text-center text-nowrap font-weight-bold text-warning">{{  number_format($r->total) }} Unit</td>
										</tr>
										<?php $no++; ?>
									@endforeach 
									 
								</tbody>
							</table> 
						</div>
                    </div>
                    </div>
                    <!-- end table-responsive -->
					<br/>
					<br/>
					<hr/> 
					
                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0 table-responsive">
                        <div class="table-responsive">
							<table id="data-table"  class="table table-bordered table-hover width-full">
								<thead>
									<tr class="text-center">
										<th  data-sorting="disabled" >No.</th>
										<th >Nama Konsumen</th>
										<th >Nama Perumahan</th>
										<th >Kavling</th>
										<th >Tipe </th>
										<th >Bank</th>
										<th >Tanggal</th>
										<th >Marketing</th>
									</tr>
									 
								</thead>
								<tbody>
									<?php $no=1; ?>
									@foreach($data as $r)
										<tr>
											<td class="text-center"  data-sorting="disabled">{{ $no }}</td>
											<td class="text-nowrap">{{ $r->nama_konsumen }}</td>
											<td class="text-nowrap">{{ $r->nama_properti }}</td>
											<td class="text-nowrap text-center">{{ $r->nama_kav }}</td>
											<td class="text-nowrap text-center">{{ $r->tipe_unit }}</td>
											<td class="text-nowrap">{{ $r->log_kpr_bank }}</td>
											<td class="text-nowrap text-center">{{ App\Helpers\Tanggal::tgl_indo($r->tanggalnya) }}</td> 
											<td class="text-nowrap">{{ $r->nama_marketing}}</td>
											
										</tr>
										<?php $no++; ?>
									@endforeach 
									 
								</tbody>
							</table> 
						</div>
                    </div>
                    <!-- end table-responsive -->
                </div>
                <!-- end panel-body -->
            </div>
        </div>
    </div>
    @stop 
    @section('scripts')
    <script src="{{ asset("plugins/DataTables/media/js/jquery.dataTables.js") }}"></script>
    <script src="{{ asset("plugins/DataTables/media/js/dataTables.bootstrap.min.js") }}"></script>
    <script src="{{ asset("plugins/DataTables/extensions/Select/js/dataTables.select.min.js") }}"></script> 
    <script src="{{ asset("js/page-table-manage-select.demo.min.js") }}"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
    <script>
        $(document).ready(function() { 
            PageDemo.init();
        });
    </script>
     
    @stop
    