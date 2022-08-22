@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Progres <small>Pekerjaan Proyek</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Data </h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                  
                    @if(Session::has('flash_message'))
                        <div class="alert alert-info ">
                      <span class="glyphicon glyphicon-ok">
                      </span><em>  ~  {{ Session::get('flash_message') }}</em>
                        </div>
                    @endif

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table id="data-table"  class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center text-nowrap"> 
                                    <th>No</th>  
                                    <th>Perumahan</th> 
                                    <th>Nama Proyek</th> 
                                    <th>Tanggal Mulai</th> 
                                    <th>Tanggal BAST</th> 
                                    <th>Progress (%)</th> 
                                    <th></th>  
                                </tr>

                            </thead>
                             <tbody>
                                @php $no=1; @endphp
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center ">{{ $no }}</td>
                                <td class="text-nowrap">{{ $r->nama_properti }}</td> 
                                <td class="text-left text-nowrap">{{ $r->judul }} </td>
                                <td class="text-left text-nowrap">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_mulai) }} </td>
                                <td class="text-left text-nowrap">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_bast) }} </td>
								<td class="text-center text-nowrap font-weight-bold text-lime">{{ round($r->ach,2) }}</td> 
                                <td class="text-center text-nowrap">
                                  
                                          
                                            <a href="{{ route('lapprogproyek.edit', $r->id) }}" class="dropdown-item  text-lime">
                                                <i class="fa fa-pen-alt"></i> Update
                                            </a>
                                           
                                       
                                  
                                </td> 
                            </tr>
                            @php $no++; @endphp
                            
                        @endforeach 

                            </tbody>

                        </table>

                    </div>
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


