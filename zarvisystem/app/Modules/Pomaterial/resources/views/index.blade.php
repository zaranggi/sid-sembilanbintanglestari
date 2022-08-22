@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">PO  <small>Material </small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Purchase Order</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <a href="{{ route('pomaterial.create') }}" class="btn  btn-primary mb-5">
                        <i class="icon-plus3 "></i> Add New
                    </a>

                    @if(Session::has('flash_message'))
                        <div class="alert alert-info ">
                      <span class="glyphicon glyphicon-ok">
                      </span><em>  ~  {{ Session::get('flash_message') }}</em>
                        </div>
                    @endif

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <table id="data-table"  class="table table-bordered table-hover width-full"">
                            <thead>
                                <tr class="text-center"> 
                                    <th>No</th>
                                    <th>No. PO</th>
                                    <th>Perumahan</th>
                                    <th>Tanggal</th> 
                                    <th>Rekanan</th> 
                                    <th>Total Item</th> 
                                    <th>Total Qty</th> 
                                    <th>Keterangan</th> 
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
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center">PO-0{{ $r->docno }}</td> 
                                <td class="text-left">{{ $r->nama_properti }}</td> 
                                <td class="text-center">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal) }}</td> 
                                <td>{{ $r->dari }}</td> 
                                <td  class="text-center">{{ number_format($r->total) }}</td> 
                                <td  class="text-center">{{ number_format($r->qty) }}</td> 
                                <td class="text-nowrap">{{ $r->keterangan }}</td> 
                                 
								<td class="text-center text-nowrap">
                                    @if( $r->status == 0)
                                    Baru    
                                    @elseif( $r->status == 1)
                                        Menunggu Approval
                                    @elseif( $r->status == 2)
                                        Disetujui Manager
                                    @elseif( $r->status == 3)
                                        Ditolak Manager
                                    @elseif( $r->status == 4)
                                        Disetujui Direktur
                                    @else 
                                        Ditolak Direktur
									@endif
                                
                                </td> 
                               <td class="text-center text-nowrap"> 
									<div class="dropdown">
										<a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
											<i class="fa fa-align-right text-successed"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
											<a href="{{ url('pomaterial/detail/'.$r->docno) }}" class="dropdown-item text-lime">
												<i class="fa fa-search "></i> Preview
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

