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
                    <h4 class="panel-title">Approval Pembayaran Pembebasan Lahan</h4>
                    
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
                        <table id="data-table"  class="table table-bordered table-hover width-full"">
                            <thead>
                                <tr class="text-center"> 
                                    <th class="text-nowrap">Perumahan</th>
                                    <th class="text-nowrap">Nama Pemilik</th>
                                    <th class="text-nowrap">Alamat</th>
                                    <th class="text-nowrap" >Luas Tanah</th>
                                    <th class="text-nowrap">Total Harga</th>  
                                    <th class="text-nowrap">Pengajuan</th> 
                                    <th class="text-nowrap">Detail</th> 
                                </tr>

                            </thead>
                             <tbody>
                        @foreach($data as $r)

                            <tr>
                                <td class="text-nowrap">{{ $r->nama_properti }}</td>
                                <td  class="text-nowrap">{{  $r->nama_pemilik }}</td>
                                <td  class=" text-nowrap">{{  $r->alamat }}</td> 
                                <td class="text-center" >{{  number_format($r->luas_tanah) }} m<sup>2</sup></td>
                                <td class="text-right" >Rp {{  number_format($r->gross) }}</td>
                                <td class="text-center" >{{$r->total_pengajuan}}</td>
                                <td class="text-center">      
                                <a href="{{ url('apppaybebaslahan/detail/'.$r->id)}}" class="text-lime bayar">
                                                <i class="fa fa-eye"></i> 
                                            </a>
                                       
                                </td> 
                            </tr>

                        @endforeach 

                            </tbody>

                        </table>

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
                    
                    <h4 class="modal-title">Pembayaran Uang Muka</h4>
					<button type="button" class="close text-danger" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ url("um/simpanbayar")}}">
                        @csrf  
                        <input type="hidden" name="id_tagihan" id="id_tagihan" value="">
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3">Terima Dari </label>
                            <div class="col-md-6"> 
                                <input type="text" name="nama"  class="form-control" required>                            
                            </div>
                        </div>  
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Tanggal Bayar</label>
                            <div class="col-md-6"> 
                                <div class="input-group" id="daterange-singledate">
                                    <input type="text" name="tanggal" id="datepicker-default" class="form-control" placeholder="Pilih Tanggal" required/>
                                    <span class="input-group-btn">
                                        <i class="fa fa-calendar-alt text-info"></i>
                                    </span>
                                </div>                            
                            </div>
                        </div>   
     
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3">Total Bayar</label>
                            <div class="col-md-5"> 
                                <input type="text" name="gross"  class="form-control rupiah text-right" required>                            
                            </div>
                        </div>  
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Keterangan</label>
                            <div class="col-md-8"> 
                                <textarea name="keterangan"  class="form-control" rows="3" placeholder="Keterangan" ></textarea> 
                            </div>
                        </div> 
                        
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Lampiran</label>
                            <div class="col-md-9"> 
                                <input type="file" name="photo"  class="form-control" placeholder="Photo Bukti Bayar">                            
                            </div>
                        </div> 
    
                      
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn width-100 btn-primary">Simpan</a>
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

<script type="text/javascript">
$(document).on('click', '.bayar', function(){  
    var id_tagihan = $(this).attr("id");   
    //$('#id_tagihan').empty();
    $('#id_tagihan').val(id_tagihan);    
         
});  
</script>

@stop

