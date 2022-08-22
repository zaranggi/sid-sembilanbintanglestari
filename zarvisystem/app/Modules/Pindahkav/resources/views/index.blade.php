@extends('admin.layout')

@section('styles')  
	<link href="{{ asset("plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css") }}" rel="stylesheet" />
	<link href="{{ asset("plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Data MOU  <small>Konsumen </small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading"> 
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
                        <table id="data-table-responsive" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr class="text-center"> 
                                    <th>No</th>
                                    <th>Nama Perumahan</th>
                                    <th>Kavling</th>
                                    <th>Tipe Unit</th>
                                    <th>Konsumen</th>
                                    <th>Tanggal</th>
                                    <th>Cara Bayar</th>
                                    <th>Harga Beli</th>
                                    <th> </th> 
                                </tr>

                            </thead>
                             <tbody>
                                 @php 
                                    $no  = 1;
                                 @endphp
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center text-lime font-weight-bold">{{ $r->nama_properti }}</td>
                                <td class="text-center" >{{  $r->nama_kav }}</td>
                                <td class="text-center" >{{  $r->tipe_unit }}</td>
                                <td class="text-info" >{{  $r->nama_konsumen }}</td>
                                <td class="text-center" >{{  App\Helpers\Tanggal::tgl_indo($r->tanggal) }}</td>
                                <td class="text-center" >{{  strtoupper($r->cara_bayar_unit) }}</td>
                                <td class="text-right" >Rp {{  number_format($r->gross_total) }}</td> 
                                
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-align-right text-successed"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                                     
                                                    <a href="{{ url('pindahkav/setpindah/'.$r->id) }}" class="dropdown-item">
                                                        <i class="fa fa-edit text-successed"></i> Set Pindah
                                                    </a> 
                                        </div>
                                    </div>
                                </td> 
                            </tr>
                            @php 
                            $no++;
                         @endphp

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

	<script src="{{ asset("plugins/datatables.net/js/jquery.dataTables.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables.net-responsive/js/dataTables.responsive.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js") }}"></script>
	<script src="{{ asset("js/demo/table-manage-responsive.demo.js") }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
 

<script src="{{ asset('js/datadelete.js') }} "></script>
<script type="text/javascript">
    window.csrfToken = '<?php echo csrf_token(); ?>';
</script>

@stop

