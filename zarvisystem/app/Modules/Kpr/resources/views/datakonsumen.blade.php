@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Data  <small>Konsumen</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
             
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
                                <tr class="text-center"> 
                                    
                                    <th>MOU</th>
                                    <th>Nama</th>
                                    <th>Perumahan</th>
                                    <th>Kavling</th>
                                    <th>Nominal</th>
                                    <th>Nominal SP3K</th>
                                    <th>Marketing</th>
                                    <th>Status</th> 
                                    <th></th> 
                                </tr>

                            </thead>
                             <tbody>
                                 @php 
                                    $no = 1;
                                 @endphp
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center text-nowrap">{{ $r->kode }}</td>
                                <td  class="text-left text-nowrap">{{ $r->nama }}</td> 
                                <td  class="text-center text-nowrap">{{ $r->nama_properti }}</td> 
                                <td  class="text-center text-nowrap">{{ $r->nama_kavling }}</td> 
                                <td  class="text-right text-nowrap">{{ number_format($r->gross_rev_kpr) }}</td> 
                                <td  class="text-right text-nowrap">{{ number_format($r->sp3k_nominal) }}</td> 
                                <td  class="text-center text-nowrap">{{ $r->marketing }}</td> 
                                <td  class="text-center text-nowrap">{{ $r->log_kpr }}</td> 
                                <td class="text-center">
                                
                                        @if($r->log_kpr == "Belum Pengajuan")
                                            <a href="{{ url('kpr/create/'.$r->id) }}" class="dropdown-item text-successed">
                                                <i class="fa fa-pen-alt "></i> Buat Pengajuan
                                            </a>
                                        @else
                                            <a href="{{ route('kpr.edit', $r->id) }}" class="dropdown-item text-successed">
                                                <i class="fa fa-pen-alt "></i> Update 
                                            </a>
                                        @endif
                                            
                                       
                                </td> 
                            </tr>

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

<script src="{{ asset('js/datadelete.js') }} "></script>
<script type="text/javascript">
    window.csrfToken = '<?php echo csrf_token(); ?>';
</script>

@stop

