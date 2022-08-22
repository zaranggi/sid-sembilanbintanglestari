@extends('admin.layout')

@section('styles')
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />
@stop
@section('content')


    <h1 class="page-header">Data Booking  <small>Konsumen </small></h1>

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
                    <a href="{{ url('bookingm/create') }}" class="btn  btn-primary mb-5">
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
                                    <th>Konsumen</th>
                                    <th>Nama Perumahan</th>
                                    <th>Tipe</th>
                                    <th>Kavling</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Tanda Jadi</th>
                                    <th></th>
                                </tr>

                            </thead>
                             <tbody>
                                 @php
                                    $no  = 1;
                                 @endphp
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-nowrap text-info" >{{  $r->nama_konsumen }}</td>
                                <td class="text-nowrap  text-center text-lime font-weight-bold">{{ $r->nama_properti }}</td>
                                <td class="text-nowrap" >{{  $r->nama_kav }}</td>
                                <td class="text-center" >{{  $r->tipe_unit }}</td>
                                <td class="text-nowrap  text-center" >{{  App\Helpers\Tanggal::tgl_indo($r->tanggal) }}</td>
                                <td class="text-nowrap  text-nowrap" >{{  strtoupper($r->keterangan_batal) }}</td>
                                <td class="text-nowrap  text-right" >Rp {{  number_format($r->nominal) }}</td>

                                <td class="text-nowrap  text-center">
									@if($r->kode_spr =="")
                                     <a href="#modal-dialog" id="{{ $r->id }}" class="batalkan" data-toggle="modal">
                                                <i class="fa fa-edit text-warning"></i>
												Buat Catatan
                                            </a>
                                    @else
                                            <span class="text-info">Sudah MOU </span>
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
                </div>
            <!-- end panel-body -->
            </div>
        </div>
    </div>


    <!-- #modal-dialog -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Catatan Booking Unit</h4>
					<button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('bookingkeu/note')}}">
                        @csrf
                        <input type="hidden" name="id_booking" id="id_booking" value="">

                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Keterangan</label>
                            <div class="col-md-8">
                                <textarea name="keterangan_batal"  class="form-control" rows="3" placeholder="Keterangan" ></textarea>
                            </div>
                        </div>


                <div class="modal-footer">
                    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn width-100 btn-primary simpan">Simpan</a>
                    </form>
                </div>
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


<script type="text/javascript">
$(document).on('click', '.batalkan', function(){
    var id = $(this).attr("id");

    $('#id_booking').val(id);

});
$(document).on('click', '.simpan', function(){

    $('.simpan').hide();

});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        PageDemo.init();
    });
</script>
@stop

