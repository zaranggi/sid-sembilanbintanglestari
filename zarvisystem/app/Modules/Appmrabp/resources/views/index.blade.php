@extends('admin.layout')

@section('styles')  
	<link href="{{ asset("plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css") }}" rel="stylesheet" />
	<link href="{{ asset("plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Approval  <small> Rab </small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                <h4 class="panel-title">
                    RAB Proyek
                </h4>
                    
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
                                    <th>Nama Proyek</th> 
                                    <th>Total Hari</th>
                                    <th>Total RAB</th>
                                    <th>Diajukan Oleh</th>
                                    <th>Status</th>
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
                                <td>{{ $r->nama_properti }}</td> 
                                <td>{{ $r->judul }}</td> 
                                <td class="text-center" >{{  number_format($r->hari) }}</td>
                                <td class="text-center" >Rp {{  number_format($r->gross) }}</td>
                                <td class="text-center" >{{  $r->created_by }} </td>
                                <td class="text-center" >
									@php 
										switch($r->status){
											default:
												echo 'Belum diajukan <span class="label label-theme">NEW</span>';
											break;
											
											case "1":
												echo 'Review Direksi <i class="fa fa-circle text-warning f-s-10 mr-2"></i>';
											break;
											
											case "2":
												echo 'Disetujui <i class="fa fa-circle text-success f-s-10 mr-2"></i>';
											break;
										
											case "3":
												echo 'Ditolak <i class="fa fa-circle text-danger f-s-10 mr-2"></i>';
											break;
										}										
									@endphp
								</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-align-right text-successed"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                            <a href="{{ url('appmrabp/view/'.$r->id) }}" target="_blank" class="dropdown-item">
                                                <i class="fa fa-eye text-info"></i> View RAB
                                            </a>
                                            @if($r->status == 1)
                                            <a href="{{ url('appmrabp/approve/'.$r->id) }}" data-confirm="Apakah yakin akan Approve RAB?" rel="nofollow" class="dropdown-item">
                                                <i class="fa fa-save text-info"></i> Approve
                                            </a>
                                            
                                            <a href="{{ url('appmrabp/reject/'.$r->id) }}" data-confirm="Apakah yakin akan Reject RAB?" rel="nofollow" class="dropdown-item">
                                                <i class="fa fa-save text-info"></i> Tolak
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

	<script src="{{ asset("plugins/datatables.net/js/jquery.dataTables.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables.net-responsive/js/dataTables.responsive.min.js") }}"></script>
	<script src="{{ asset("plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js") }}"></script>
	<script src="{{ asset("js/demo/table-manage-responsive.demo.js") }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
  
@stop

