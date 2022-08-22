@extends('admin.layout') 
@section('styles') 

<link href="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" />
<link href="{{ asset('plugins/jquery-tag-it/css/jquery.tagit.css')}}" rel="stylesheet" />
<link href="{{ asset('plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" />

<link href="{{ asset('plugins/bootstrap-calendar/css/bootstrap_calendar.css')}}" rel="stylesheet" />
<link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" rel="stylesheet" /> 

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


<h1 class="page-header">Form <small>PO Material </small></h1>
	
<div class="row">
    <!-- begin col-6 -->
    <div class="col-lg-12">
        <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="table-basic-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">PO Material </h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
			<div class="panel-body">
				<!-- begin panel --> 

                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover width-full" id="listitem">
                                <thead>
                                    <tr class="bg-lime">
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Rekanan</th>
                                        <th class="text-center">PLU</th>
                                        <th class="text-center">Nama Material</th>
                                        <th class="text-center">Satuan</th>
                                        <th class="text-center">Volume</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Cara Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>  
								@php $no = 1; $t = 0; @endphp
									@foreach($data as $r)
										<tr>
											<td class="text-center">{{$no}}</td>
											<td class="text-center">{{$r->nama_rekanan}}</td>
											<td class="text-center">{{$r->prdcd}}</td>
											<td>{{$r->desc2}}</td>
											<td class="text-center">{{$r->satuan}}</td>
											<td class="text-right">{{ number_format($r->qty)}}</td>
											<td class="text-right" >{{number_format($r->harga)}}</td>
											<td class="text-right">{{number_format($r->total)}}</td>
											<td class="text-center">{{$r->pembayaran}}</td>
										</tr>
										@php $t += $r->total; $no++; @endphp
									@endforeach
                                     
                                </tbody>  
								<tfoot>
									<tr class="bg-warning font-weight-bold">
										<td colspan="7" class="text-center">Grand Total</td>
										<td class="text-right">{{number_format($t)}}</td>
								</tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="border-top my-1 m-b-15"></div> 
                    
			</div>
	</div>
</div>  


@stop
 
@section('scripts')

<script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js')}}"></script>
   
<script src="{{ asset('js/jquery.number.js') }}"></script> 

<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript"> 
    $('.nomor').number(true, 0, ',', ' ');
    $('.rupiah').number(true, 0,);
</script>

<script type="text/javascript"> 
    $(document).ready(function() {   
        $("#tanggal").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });
		$(".default-select2").select2();
    });
</script>
 
<script type="text/javascript"> 
    function tandaPemisahTitik(b){
        var _minus = false;
        if (b<0) _minus = true;
        b = b.toString();
        b=b.replace(",","");
        b=b.replace("-","");
        c = "";
        panjang = b.length;
        j = 0;
        for (i = panjang; i > 0; i--){
            j = j + 1;
            if (((j % 3) == 1) && (j != 1)){
                c = b.substr(i-1,1) + "," + c;
            } else {
                c = b.substr(i-1,1) + c;
            }
        }
        if (_minus) c = "-" + c ;
        return c;
    }

    var intVal = function ( i ) {
        return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
            typeof i === 'number' ?
                i : 0;
    };
 
    function calculateTotal(){
        var totalAmount = 0;
        $("[id^='currency']").each(function() {
            var id = $(this).attr('id');

            id = id.replace("currency",'');

            var rp = $('#currency'+id).val();
            rp = intVal(rp);

            totalAmount += rp;

        });

        $('#total').val(tandaPemisahTitik(parseFloat(totalAmount)));
    }

</script>

 

@stop
