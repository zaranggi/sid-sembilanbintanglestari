@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />

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
                    <h4 class="panel-title">Pemakaian Material</h4>
                    
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
                        <table id="data-table"  class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center"> 
                                    <th class="text-nowrap">No</th> 
                                    <th class="text-nowrap">Perumahan</th>
                                    <th class="text-nowrap">Kavling</th>
                                    <th class="text-nowrap">Volume</th>
                                    <th class="text-nowrap">Total</th>
                                    <th class="text-nowrap">View</th>   
                                </tr>

                            </thead>
                             <tbody>
							 @php $no = 1; @endphp
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center">{{ $no }}</td>
								<td class="text-nowrap">{{ $r->nama_properti }}</td>
								@if($r->nama_kav == "")
									<td class="text-center text-nowrap">Pengerjaan Fasum</td>
								@else 
									<td class="text-center text-nowrap">{{ $r->nama_kav." :: Tipe".$r->tipe_unit }}</td>
								@endif

                                <td class="text-right" >{{  number_format($r->qty) }}</td>
                                <td class="text-right" >{{  number_format($r->gross) }}</td>
                                <td class="text-center">      
                                <a href="{{ url('rusematerial/detail/'.$r->docno)}}" class="text-lime bayar">
                                                <i class="fa fa-eye"></i> 
                                            </a>
                                       
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
<script src="{{ asset('js/jquery.number.js') }}"></script> 
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>

<script type="text/javascript"> 
    $('.nomor').number(true, 0, ',', ' ');
    $('.rupiah').number(true, 0,);
</script>

<script type="text/javascript">
    $(document).ready(function() {   
        $("#datepicker-default").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            }); 
        });
</script>

<script type="text/javascript">
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>
 
@stop

