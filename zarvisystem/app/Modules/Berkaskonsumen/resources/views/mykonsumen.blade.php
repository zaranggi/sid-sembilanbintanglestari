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
                                <tr class="text-center text-nowrap" > 
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Nama</th>
                                    <th rowspan="2">Tanda Jadi</th>
                                    <th rowspan="2">Perumahan</th>
                                    <th rowspan="2">Kavling</th>
                                    <th rowspan="2">Sistem</th>
                                    <th  colspan="2">Berkas</th>
                                    <th  colspan="2">SP3K</th>
                                    <th rowspan="2">Realisasi</th>
                                    <th rowspan="2">Bank</th> 
                                    <th rowspan="2">Keterangan</th> 
                                    
                                </tr>

                                <tr class="text-center">
                                    <th>Status </th>
                                    <th>Tanggal </th>
                                    <th>Status </th>
                                    <th>Nominal </th>
                                </tr>

                            </thead>
                             <tbody>
                                 @php 
                                    $no = 1;
                                 @endphp
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-nowrap">{{ $r->nama }}</td>
                                <td  class="text-center text-nowrap">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_jt_booking) }}</td> 
                                <td  class="text-center text-nowrap">{{ $r->nama_properti }}</td> 
                                <td  class="text-center text-nowrap">{{ $r->nama_kavling }}</td> 
                                <td  class="text-center text-nowrap">{{ strtoupper($r->cara_bayar_unit) }}</td> 
                                <td  class="text-center text-nowrap">
                                    @if($r->berkas_lengkap == "Belum Lengkap")
                                    <a href="{{ route('konsumen.edit', $r->id_konsumen) }}" class="dropdown-item text-red font-weight-bold">
                                        <i class="fa fa-circle text-red f-s-8 mr-2"></i>Belum Lengkap
                                    </a>
                                    @else 
                                    <a href="{{ route('konsumen.edit', $r->id_konsumen) }}" class="dropdown-item text-lime font-weight-bold">
                                        <i class="fa fa-circle text-lime f-s-8 mr-2"></i>Lengkap
                                    </a>
                                        
                                    @endif
                                </td> 
                                <td  class="text-center text-nowrap">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_kprx) }}</td> 
                                <td  class="text-left text-nowrap">{{ $r->sp3k_status }}</td> 
                                <td  class="text-center text-nowrap">{{ $r->sp3k_nominal }}</td> 
                                <td  class="text-center text-nowrap">{{ $r->realisasi }}</td> 
                                <td  class="text-center text-nowrap">{{ $r->log_kpr_bank }}</td> 
                                <td  class="text-left text-nowrap">{{ $r->keterangan }}</td> 
                                
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

<script src="{{ asset('js/datadelete.js') }} "></script>
<script type="text/javascript">
    window.csrfToken = '<?php echo csrf_token(); ?>';
</script>

@stop

