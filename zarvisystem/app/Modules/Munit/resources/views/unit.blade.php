@extends('admin.layout')

@section('styles')
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Manage  <small>Kavling</small></h1>

    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">List All Kavling</h4>

                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    @php
                        $id_properti = "";
                    @endphp
                    @foreach($data_prop as $r)
                        @php
                            $id_properti = $r->id;
                        @endphp

                    <div class="col-lg-3 m-b-10">
			            <!-- begin widget -->
			            <a href="javascript:;" class="widget widget-image">
			                <div class="widget-image-cover">
                            <img src="{{ asset('image/properti/'.$r->gambar) }}" alt="" />
			                </div>
			                <div class="widget-image-info">
			                    <h5 > {{$r->nama}} </h5>
			                    <p  >
			                        {{$r->alamat}}
			                    </p>
			                    <div class="row">

			                        <div class="col-lg-6">
                                        <div class="widget-image-rating-text">{{ number_format($r->tunit)}} Unit</div>
			                        </div>
			                    </div>
			                </div>
			            </a>
			            <!-- end widget -->
			        </div>
                    <!-- end col-4 -->
                    @endforeach

                    @if( Auth::user()->id_jabatan != 9 )
                    <a href="{{ url('munit/tambah/'.$id_properti) }}" class="btn  btn-primary mb-5">
                        <i class="fa fa-plus "></i> Add New
                    </a>
                    @endif


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
                                    <th >No</th>
                                    <th>Nama Kavling / Blok</th>
                                    <th>Tipe</th>
                                    <th>LT</th>
                                    <th>LB</th>
                                    <th>Harga</th>
                                    <th>Status </th>
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
                                <td class="text-center text-nowrap">{{ $r->nama }}</td>
                                <td  class="text-center text-nowrap">{{ $r->tipe }}</td>
                                <td  class="text-right text-nowrap">{{  round($r->luas_tanah,2) }}</td>
                                <td  class="text-right text-nowrap">{{  round($r->luas_bangunan,2) }}</td>
                                <td  class="text-right text-nowrap">{{  number_format($r->harga) }}</td>
                                <td  class="text-center text-nowrap">{{  $r->nama_status }}</td>
                                <td class="text-center">
                                @if( Auth::user()->id_jabatan != 9 )
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-align-right text-successed"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-158px, 19px, 0px);">


                                            <a href="{{ route('munit.edit', $r->id) }}" class="dropdown-item">
                                                <i class="fa fa-pen-alt text-successed"></i> Edit
                                            </a>
                                            <!--
                                            <a href="{{ route('munit.destroy', $r->id) }}" data-method="delete" data-confirm="Blok ini akan di-non aktifkan?" rel="nofollow" class="dropdown-item">
                                                <i class="fa fa-trash-alt text-danger"></i> Delete
                                            </a>
                                                -->


                                        </div>
                                    </div>
                                    @endif
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

