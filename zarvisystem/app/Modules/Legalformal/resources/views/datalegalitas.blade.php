@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
@stop
@section('content')


<h1 class="page-header"> Dokumen <small>Legalitas</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
             
                <!-- begin panel-body -->
                <div class="panel-body">  
                    <a href="{{ url('legalformal/addnew/'.$id_properti) }}" class="btn  btn-primary mb-5">
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
                        <div class="table-responsive">
                        <table id="data-table"  class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center"> 
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Jenis Legalitas</th>
                                    <th>Nama Dokumen</th>
                                    <th>Kavling</th>
                                    <th>Tanggal Terbit</th>
                                    <th>Tanggal Expired</th>
                                    <th>File Dokumen</th> 
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
                                <td class="text-center text-nowrap text-warning font-weight-bold">{{ $r->kategori }}</td>
                                <td class="text-left text-nowrap text-info font-weight-bold">{{ $r->jenis_legalformal }}</td>
                                <td class="text-left text-nowrap text-info font-weight-bold">{{ $r->nama }}</td>
                                <td class="text-center text-nowrap text-warning ">{{ $r->nama_kav }}</td>
                                <td class="text-center text-nowrap ">{{ App\Helpers\Tanggal::tgl_indo($r->tgl_terbit) }}</td>
                                <td class="text-center text-nowrap ">{{ App\Helpers\Tanggal::tgl_indo($r->tgl_exp) }}</td>
                                <td class="text-center text-nowrap text-warning ">
                                    <a href="{{ url('image/legalformal/'.trim($r->namafile)) }}" 
                                        onclick="window.open(this.href, '_blank', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); 
                                        return false;"><i class="fa fa-camera fa-2x" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-primary" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ url('legalformal/editlegal/'.$r->id) }}" class="dropdown-item"><i class="fa fa-pen-alt text-purple"></i> Edit</a>                                           
                                            <a href="{{ route('legalformal.destroy', $r->id) }}" data-method="delete" data-confirm="Legalitas ini akan dihapus?" class="dropdown-item">
                                                <i class="fa fa-trash-alt text-danger"></i> Delete
                                            </a>
                                        </div>
                                    </div>
 
                                </td> 
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

