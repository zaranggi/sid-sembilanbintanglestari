@extends('admin.layout')

@section('styles')
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />

<style type="text/css">

    #wrapper{background: -moz-linear-gradient(top,  darkslategray , azure);
     background:-ms-linear-gradient(top, brown, brown);
     background:-o-linear-gradient(top, brown, brown);
     }

     #loader {
           text-align: center;
           display: none;
     }

     #loaderCircle {
         text-align: center;
         z-index: 100;
         position: fixed;
         left: 45%;
         top: 50px;
         width: 200px;
         padding: 10px;
         background: #000;
         opacity: 0.8;
         color: #FFF;
         -webkit-border-radius: 10px;
         -moz-border-radius: 10px;
         border-radius: 10px;
     }

.shape{
     border-style: solid; border-width: 0 70px 40px 0; float:right; height: 0px; width: 0px;
     -ms-transform:rotate(360deg); /* IE 9 */
     -o-transform: rotate(360deg);  /* Opera 10.5 */
     -webkit-transform:rotate(360deg); /* Safari and Chrome */
     transform:rotate(360deg);
 }
 .offer{
     background:#fff; border:1px solid #ddd; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); margin: 15px 0; overflow:hidden;
 }

 .shape {
     border-color: rgba(255,255,255,0) #d9534f rgba(255,255,255,0) rgba(255,255,255,0);
 }
 .offer-radius{
     border-radius:7px;
 }
 .offer-danger {	border-color: #d9534f; }
 .offer-danger .shape{
     border-color: transparent #d9534f transparent transparent;
 }
 .offer-success {	border-color: #5cb85c; }
 .offer-success .shape{
     border-color: transparent #5cb85c transparent transparent;
 }
 .offer-default {	border-color: #999999; }
 .offer-default .shape{
     border-color: transparent #999999 transparent transparent;
 }
 .offer-primary {	border-color: #428bca; }
 .offer-primary .shape{
     border-color: transparent #428bca transparent transparent;
 }
 .offer-info {	border-color: #5bc0de; }
 .offer-info .shape{
     border-color: transparent #5bc0de transparent transparent;
 }
 .offer-warning {	border-color: #f0ad4e; }
 .offer-warning .shape{
     border-color: transparent #f0ad4e transparent transparent;
 }

 .shape-text{
     color:#fff; font-size:12px; font-weight:bold; position:relative; right:-40px; top:2px; white-space: nowrap;
     -ms-transform:rotate(30deg); /* IE 9 */
     -o-transform: rotate(360deg);  /* Opera 10.5 */
     -webkit-transform:rotate(30deg); /* Safari and Chrome */
     transform:rotate(30deg);
 }
 .offer-content{
     padding:0 20px 10px;
 }


</style>


@stop
@section('content')


<div id="loader">
    <div id="loaderCircle">
        <img alt="Loading ...." src="http://45.127.133.123/survey/asset/images/loader_big.gif" width="15px"  /><span id="loaderText"></span>
    </div>
</div>
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
                                    <th rowspan="2">Surat Konsumen</th>

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
                                    @if($r->berkas_lengkap =="Belum Lengkap")
                                    <a href="{{ url('berkaskonsumen/doc/'.$r->id_konsumen) }}" class="dropdown-item text-red font-weight-bold">
                                        <i class="fa fa-circle text-red f-s-8 mr-2"></i>Belum Lengkap
                                    </a>
                                    @else
                                    <a href="{{ url('berkaskonsumen/doc/'.$r->id_konsumen) }}" class="dropdown-item text-lime font-weight-bold">
                                        <i class="fa fa-circle text-lime f-s-8 mr-2"></i>Lengkap
                                    </a>

                                    @endif
                                </td>
                                <td  class="text-center text-nowrap">{{ App\Helpers\Tanggal::tgl_indo($r->tanggal_kprx) }}</td>
                                <td  class="text-left text-nowrap">{{ $r->sp3k_status }}</td>
                                <td  class="text-center text-nowrap">{{ number_format($r->sp3k_nominal) }}</td>
                                <td  class="text-center text-nowrap">{{ $r->realisasi }}</td>
                                <td  class="text-center text-nowrap">{{ $r->log_kpr_bank }}</td>
                                <td  class="text-left text-nowrap">{{ $r->keterangan }}</td>
								<td class="text-center text-nowrap">
                                                   <button data-id="{{ $r->id_konsumen }}" class="btn btn-success lihat">
                                                            <i class="fa fa-eye text-successed"></i> Surat Konsumen
                                                   </button>
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


     <!-- Modal -->
   <div class="modal fade " id="modalku" role="dialog">
    <div class="modal-dialog  modal-lg">

     <!-- Modal content-->
     <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title  panel-inverse">Data Surat</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
          @csrf
            <table id="data_jurnal"  class="table table-bordered table-hover width-full">

            </table>

      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script type="text/javascript">
    window.csrfToken = '<?php echo csrf_token(); ?>';
</script>
<script type="text/javascript">
    $(document).ready(function() {
        PageDemo.init();

		$('#data-table').on('click', '.lihat', function () {

                var idjurnal = $(this).data('id');

                // AJAX request
                $.ajax({
                    cache: false,
                    url: '{{ url("berkaskonsumen/suratnya") }}',
                    type: 'post',
                    data: {id: idjurnal, '_token': $('input[name=_token]').val()},
                    beforeSend: function(){
                        loaderOpen("Loading Prosses");
                    },
                    success: function(response){
                        loaderClose();
                        $("#data_jurnal tr").remove();
                        // Add response in Modal body
                        $("#data_jurnal").append(response);

                        // Display Modal
                        $('#modalku').modal('show');
                    },
                    error: function(){
                        loaderClose();
                        Swal.fire({
                            title: "Pesan informasi",
                            text:  data.msg,
                            icon: "error",
                            });
                    }
                });
            });
            function loaderOpen(text){
                    $('#loaderText').html(text);
                    $('#loader').show();
                }
            function loaderClose(){
                    $('#loaderText').html('');
                    $('#loader').hide();
                }

    });
</script>


@stop

