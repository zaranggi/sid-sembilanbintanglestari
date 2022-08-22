@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">History  <small>Cuti Karyawan</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">List All </h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">  

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <table id="data-table"  class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center"> 
                                    <th >No</th>
                                    <th>Tanggal Start</th>
                                    <th>Tanggal End</th>
                                    <th>Total Cuti</th>
                                    <th>Keterangan</th>
                                    <th>Status</th> 
                                </tr>

                            </thead>
                             <tbody>
							 @php $no = 1; @endphp
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_start) }}</td>
                                <td class="text-center">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_end) }}</td>
                                <td class="text-center">{{  $r->total_cuti }}</td>
                                <td class="text-nowrap">{{  $r->keterangan }}</td>
                                <td class="text-center">
								@if($r->status == 2)
									Disetujui
								@elseif($r->status == 1)
									Pengajuan 
								@else 
									Ditolak
								@endif
								</td>
                                
                            </tr>
							@php $no++; @endphp
                        @endforeach 

                            </tbody>

                        </table>

                    </div>
                </div>
            <!-- end panel-body -->
            </div>
        </div>
    </div>

    <!-- /basic initialization --> 
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

