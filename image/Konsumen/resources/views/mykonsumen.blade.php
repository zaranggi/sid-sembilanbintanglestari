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
                                    <th >No</th>
                                    <th>Blok</th>
                                    <th>Tipe Unit</th>
                                    <th>Harga</th>
                                    <th>Nama</th>
                                    <th>Kartu ID</th>
                                    <th>Alamat</th>
                                    <th>Tlp / HP</th> 
                                    <th></th> 
                                </tr>

                            </thead>
                             <tbody>
                                 @php 
                                    $no = 1;
                                 @endphp
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center text-nowrap text-warning font-weight-bold">{{ $r->nama_kav }}</td>
                                <td class="text-center text-nowrap text-warning font-weight-bold">{{ $r->tipe_unit }}</td>
                                <td class="text-right text-nowrap">{{ number_format($r->gross_total) }}</td>
                                <td  class="text-left text-nowrap text-info font-weight-bold">{{ $r->nama }}</td> 
                                <td  class="text-center text-nowrap">{{ $r->idcard }}</td> 
                                <td  class="text-left text-nowrap">{{ $r->alamat }}</td> 
                                <td  class="text-center text-info font-weight-bold text-nowrap">{{ $r->telp }}</td>   
                                <td class="text-center">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('konsumen.edit', $r->id) }}" class="dropdown-item"><i class="fa fa-pen-alt text-purple"></i> Edit</a>                                           
                                        </div>
                                    </div>
 
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

