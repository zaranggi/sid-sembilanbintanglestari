@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" /> 

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
    <h1 class="page-header">Rekap Data <small>Per Unit</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">List All </h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                      
                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table id="data-table"  class="table table-bordered table-hover width-full">
                            <thead>
                                <tr class="text-center"> 
                                    <th rowspan="2">No</th>
                                    <th  rowspan="2">Kavling</th>
                                    <th rowspan="2">Konsumen</th>
                                    <th rowspan="2">Marketing</th>
                                    <th rowspan="2">Nilai MOU</th>
                                    <th rowspan="2">Cara Bayar</th>
                                    <th rowspan="2">Bank</th>
                                    <th rowspan="2">Status KPR</th>
                                    <th rowspan="2">SP3K</th>
                                    <th rowspan="2">Realisasi</th>
                                    <th rowspan="2">Tertagih</th> 
                                    <th rowspan="2">Terbayar</th> 
                                    <th rowspan="2">Kekurangan</th>
                                    <th rowspan="2">BAST</th> 
                                    <th rowspan="2">SURAT</th> 
                                    <th colspan="3">Biaya Pembangunan Rumah</th>
                                    <th colspan="3">Biaya Revisi unit</th>
                                    <th rowspan="2">Biaya Material</th> 
                                </tr>
								<tr class="text-center"> 
									<th>Termin</th>
									<th>Terbayar</th>
									<th>Kurang</th>
									<th>Termin</th>
									<th>Terbayar</th>
									<th>Kurang</th>
								</tr>
								

                            </thead>
                             <tbody>
                                 @php 
                                    $no = 1;
                                 @endphp
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td  class="text-center text-nowrap">{{ $r->nama_kav." / ".$r->tipe_unit }}</td>                                 
                                <td class="text-left text-nowrap">{{ $r->nama_konsumen }}</td>                                
                                <td class="text-left text-nowrap">{{ $r->nama_marketing }}</td>                                
                                <td  class="text-right text-nowrap">{{  number_format($r->nilai_mou) }}</td>
								                  
                                <td class="text-center text-nowrap">{{ strtoupper($r->cara_bayar_unit) }}</td>
                                <td class="text-left text-nowrap">{{ $r->log_kpr_bank }}</td>
                                <td class="text-left text-nowrap">{{ $r->log_kpr }}</td>
                                <td class="text-right text-nowrap">{{ number_format($r->sp3k_nominal) }}</td>
                                <td class="text-right text-nowrap">{{ number_format($r->realisasi_rp) }}</td>
								
                                <td  class="text-right text-nowrap">{{  number_format($r->total_tagihan) }}</td>
                                <td  class="text-right text-nowrap">{{  number_format($r->terbayar) }}</td>
                                <td  class="text-right text-nowrap">{{  number_format($r->total_tagihan - $r->terbayar) }}</td>
								<td class="text-center text-nowrap">
									   <button id="{{ $r->id_konsumen }}" class="btn btn-success lihat baca2">
												<i class="fa fa-eye text-successed"></i> BAST
									   </button> 
								</td>
								<td class="text-center text-nowrap">
									   <button id="{{ $r->id_konsumen }}" class="btn btn-success lihat2 baca">
												<i class="fa fa-eye text-successed"></i> Surat
									   </button> 
								</td>
                                <td  class="text-right text-nowrap">{{  number_format($r->nilai_termin) }}</td>
                                <td  class="text-right text-nowrap">{{  number_format($r->jumlah_bayar) }}</td>								
                                <td  class="text-right text-nowrap">{{  number_format($r->kurang_bayar) }}</td>
								
                                <td  class="text-right text-nowrap">{{  number_format($r->nilai_termin_rev) }}</td>
                                <td  class="text-right text-nowrap">{{  number_format($r->jumlah_bayar_rev) }}</td>								
                                <td  class="text-right text-nowrap">{{  number_format($r->kurang_bayar_rev) }}</td>								
                                <td  class="text-right text-nowrap">{{  number_format($r->biaya_material) }}</td>
                                 
								
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
<script>
    $(document).ready(function() { 
        PageDemo.init();
		$('#data-table').on('click', '.lihat2', function () {
   
                var idjurnal = $(this).attr('id');

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
                    error: function(response){
                        loaderClose(); 
                        Swal.fire({
                            title: "Pesan informasi",
                            text:  response.msg,
                            icon: "error",
                            }); 
                    }
                });
            });
			
		$('#data-table').on('click', '.lihat', function () {
   
                var idjurnal = $(this).attr('id');
				
                // AJAX request
                $.ajax({
                    cache: false,
                    url: '{{ url("rekapunit/bast")}}',
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
                    error: function(response){
                        loaderClose(); 
                        Swal.fire({
                            title: "Pesan informasi",
                            text:  response.msg,
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
 
<script type="text/javascript">
    window.csrfToken = '<?php echo csrf_token(); ?>';
</script>

@stop

