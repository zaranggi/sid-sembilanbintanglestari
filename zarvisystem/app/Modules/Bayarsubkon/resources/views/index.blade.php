@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Pengajuan Pembayaran<small> Termin </small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Data SPK </h4>
                    
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
                                    <th>No SPK</th> 
                                    <th>Perumahan</th> 
                                    <th>Kavling</th> 
                                    <th>Tipe</th> 
                                    <th>Subkon</th> 
                                    <th>Kontrak </th> 
                                    <th>Terbayar</th> 
                                    <th>Sisa</th>                  
                                    <th></th>
                                </tr>

                            </thead>
                             <tbody>
                                
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center ">{{ $r->kode }}</td>
                                <td class="text-nowrap">{{ $r->nama_properti }}</td> 
                                <td class="text-center text-nowrap">{{ $r->nama_kav }} </td> 
                                <td class="text-center text-nowrap">{{ $r->tipe_unit }} </td>  
                                <td class="text-center text-nowrap">{{ $r->nama_subkon }}</td> 
                                <td class="text-center text-nowrap">{{ number_format($r->gross_total) }}</td> 
                                <td class="text-center text-nowrap">{{ number_format($r->gross_total - $r->krgbayar) }}</td> 
                                <td class="text-center text-nowrap">{{ number_format($r->krgbayar) }}</td> 
                                <td class="text-center text-nowrap">
                                    
                                   
                                            <a href="{{ route('bayarsubkon.edit', $r->id) }}" class="dropdown-item">
                                                <i class="fa fa-envelope-open text-lime"></i> Detail
                                            </a>
                                               
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


