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
                    <h4 class="panel-title">Pembebasan Lahan</h4>
                    
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

                    
                    <a href="{{ route('bebaslahan.create') }}" class="btn  btn-primary mb-5">
                        <i class="fas fa-lg fa-fw m-r-10 fa-plus"></i> Pembebasan Lahan Baru
                    </a>

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table id="data-table"  class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center"> 
                                    <th class="text-nowrap">No</th>
                                    <th class="text-nowrap">Tanggal</th>
                                    <th class="text-nowrap">Properti</th> 
                                    <th class="text-nowrap">Nama Pemilik</th> 
                                    <th class="text-nowrap">Alamat</th>  
                                    <th class="text-nowrap">No Telp/HP</th>
                                    <th class="text-nowrap">Luas Tanah</th> 
                                    <th class="text-nowrap">Status</th> 
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
                                <td class="text-nowrap">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal) }}</td> 
                                <td class="text-nowrap">{{ $r->nama_properti }}</td> 
                                <td class="text-left text-nowrap">{{  $r->nama_pemilik }}</td>     
                                <td class="text-left" >{{  $r->alamat }}</td>      
                                <td class="text-left text-nowrap">{{  $r->hp }}</td>  
                                <td class="text-center text-nowrap">{{  number_format($r->luas_tanah) }}</td>
                                <td class="text-center text-nowrap">{{  $r->status_bebas_lahan }}</td>
                                <td class="text-center">    
                                   
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-align-right text-successed"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                            <a href="{{ url('bebaslahan/detail/'.$r->id)}}" class="dropdown-item">
                                                <i class="fa fa-eye text-successed"></i> View
                                            </a>
                                            <a href="{{ url('bebaslahan/doc/'.$r->id)}}" class="dropdown-item">
                                                <i class="fa fa-file text-successed"></i> Dokumen
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

