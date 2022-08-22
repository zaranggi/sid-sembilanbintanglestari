@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" /> 

<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" /> 
@stop
@section('content')


     
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Approval Pembayaran Gaji Karyawan</h4>
                    
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
                                <tr class="text-center"> 
                                    <th class="text-nowrap">No</th>
                                    <th class="text-nowrap">Periode</th>
                                    <th class="text-nowrap">Keterangan</th> 
                                    <th class="text-nowrap">Total Karyawan</th> 
                                    <th class="text-nowrap">Total Gaji</th>  
                                    <th class="text-nowrap">Status</th> 
                                    <th class="text-nowrap">Tgl App Direksi</th> 
                                    <th class="text-nowrap"></th>
                                </tr>

                            </thead>
                             <tbody>
                                @php 
                                    $no = 1;

                                @endphp 
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center text-nowrap">{{  $no }}</td>
                                <td class="text-nowrap">{{ App\Helpers\Tanggal::tgl_indo($r->periode) }}</td> 
                                <td class="text-nowrap">{{ $r->keterangan }}</td> 
                                <td class="text-center text-nowrap">{{  $r->tkaryawan }}</td>     
                                <td class="text-right" >Rp {{  number_format($r->total) }}</td>      
                                <td class="text-center text-nowrap">{{  $r->status }}</td>   
                                <td class="text-center" >{{  App\Helpers\Tanggal::tgl_indo($r->tgl_app) }}</td>                       
                                <td class="text-center">    
                                   
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-align-right text-successed"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                            
                                            <a href="{{ url('appgaji/detail/'.$r->periode)}}" class="dropdown-item">
                                                <i class="fa fa-eye text-successed"></i> View
                                            </a>

                                            @if($r->app == "1")
                                    
                                            <a href="{{ url('appgaji/approve/'. $r->periode) }}" data-confirm="Apakah yakin akan Approve SPK?" rel="nofollow" class="dropdown-item text-lime">
                                                <i class="fa fa-save "></i> Approve
                                            </a>                                            
                                            <a href="{{ url('appgaji/reject/'. $r->periode) }}" data-confirm="Apakah yakin akan Reject SPK?" rel="nofollow" class="dropdown-item text-warning">
                                                <i class="fa fa-save "></i> Tolak
                                            </a>
                                            @endif  
                                           
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
<script src="{{ asset("plugins/DataTables/media/js/jquery.dataTables.js") }}"></script>
<script src="{{ asset("plugins/DataTables/media/js/dataTables.bootstrap.min.js") }}"></script>
<script src="{{ asset("plugins/DataTables/extensions/Select/js/dataTables.select.min.js") }}"></script> 
<script src="{{ asset("js/page-table-manage-select.demo.min.js") }}"></script>
<script src="{{ asset('js/jquery.number.js') }}"></script> 
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>
<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script> 

<script type="text/javascript"> 
    $('.nomor').number(true, 0, ',', ' ');
    $('.rupiah').number(true, 0,);
</script>
 
<script type="text/javascript">
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>
 

@stop

