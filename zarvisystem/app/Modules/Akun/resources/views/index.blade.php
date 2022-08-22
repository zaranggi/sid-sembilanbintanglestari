@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Manage  <small>Akun Perkiraan</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Data Akun</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <a href="{{ route('akun.create') }}" class="btn  btn-primary mb-5">
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
                        <div class="table-responsive-md" >
                        <table  class="table table-invoice non-pre">
                            <thead>
                                <th class="text-center">Kode</th>
                                <th  class="text-center">Nama Akun</th>
                                <th  class="text-center"></th>
                            </thead>
                             <tbody>
                                
                        @foreach($komponen as $r)

                            <tr>
                                <td class="text-left font-weight-bold">{{ $r->kode }}</td>
                                <td ><span class="text-inverse font-weight-bold text-info"> {{ $r->nama_akun }}</span></td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-align-right text-successed"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                            {{-- <a href="{{ route('akun.edit', $r->id) }}" class="dropdown-item">
                                                <i class="fa fa-pen-alt text-successed"></i> Edit
                                            </a> --}}
                                            <a href="{{ route('akun.destroy', $r->id) }}" data-method="delete" data-confirm="Menu ini akan di-non aktifkan?" rel="nofollow" class="dropdown-item">
                                                <i class="fa fa-trash-alt text-danger"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td> 
                            </tr>
                            @if(in_array($klasifikasi[$r->id], $klasifikasi))
                                @foreach($klasifikasi[$r->id] as $r2)
                                <tr> 
                                    <td class="text-center font-weight-bold" >{{ $r2->kode }}</td>
                                    
                                    <td ><span class="font-weight-bold text-warning"> {{ $r2->nama_akun }}</span></td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-align-right text-successed"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                               {{--  <a href="{{ route('akun.edit', $r2->id) }}" class="dropdown-item">
                                                    <i class="fa fa-pen-alt text-successed"></i> Edit
                                                </a> --}}
                                                <a href="{{ route('akun.destroy', $r2->id) }}" data-method="delete" data-confirm="Menu ini akan di-non aktifkan?" rel="nofollow" class="dropdown-item">
                                                    <i class="fa fa-trash-alt text-danger"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td> 
                                </tr> 
                                
                                @if(in_array($akun[$r2->id], $akun))
                                    @foreach($akun[$r2->id] as $r3)
                                    <tr> 
                                        <td class="text-center ">{{ $r3->kode }} </td>
                                        <td >{{ $r3->nama_akun }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-align-right text-successed"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                                    <a href="{{ route('akun.edit', $r3->id) }}" class="dropdown-item">
                                                        <i class="fa fa-pen-alt text-successed"></i> Edit
                                                    </a>
                                                    <a href="{{ route('akun.destroy', $r3->id) }}" data-method="delete" data-confirm="Menu ini akan di-non aktifkan?" rel="nofollow" class="dropdown-item">
                                                        <i class="fa fa-trash-alt text-danger"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td> 
                                    </tr> 

                                    @if(in_array($subakun[$r3->id], $subakun))
                                    @foreach($subakun[$r3->id] as $r4)
                                    <tr> 
                                        <td class="text-center font-weight-bold">{{ $r4->kode }} </td>
                                        <td >{{ $r4->nama_akun }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-align-right text-successed"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">
                                                    <a href="{{ route('akun.edit', $r4->id) }}" class="dropdown-item">
                                                        <i class="fa fa-pen-alt text-successed"></i> Edit
                                                    </a>
                                                    <a href="{{ route('akun.destroy', $r4->id) }}" data-method="delete" data-confirm="Menu ini akan di-non aktifkan?" rel="nofollow" class="dropdown-item">
                                                        <i class="fa fa-trash-alt text-danger"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td> 
                                    </tr> 
                                    
                                    @endforeach  
                                @endif
                                    
                                    @endforeach  
                                @endif
                                 
                                @endforeach 
                            @endif
 
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

