@extends('admin.layout')

@section('styles')

<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />


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

    <h1 class="page-header">RAB Pekerjaan <small>Fasum Fasos</small></h1>

    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Data Pekerjaan </h4>

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
					<button type="button" class="btn bg-lime m-l-15" data-toggle="modal" data-target="#modal_theme_primary">Tambah Data<i class="icon-add ml-2"></i></button>
					<a href="{{ url('mrabp') }}" class="btn btn-warning"><i class="fa fa-redo-alt ml-2"></i> Kembali </a>


					 <div class="border-top my-3"></div>

					<form id="simpanmaterial" method="POST" action="javascript:void(0)">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $id }}">

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover width-full" id="listitem">
								<thead>
									<tr class="text-center bg-lime">
										<th>Nama Pekerjaan</th>
										<th>Bobot</th>
										<th></th>
									</tr>

								</thead>
								 <tbody>
								  @php
									$bobot=0;
									@endphp
								 @foreach($data as $r)

									 <tr>
										<td class="text-left text-nowrap"><input type='hidden' name='id_pekerjaan[]' value="{{ $r->id_pekerjaan }}">{{ $r->nama }}</td>
										<td class="text-center text-nowrap" id="gg"><input type='hidden' name='bobot[]' value="{{ $r->bobot }}">{{ number_format($r->bobot) }}</td>
										<td class="text-left text-nowrap">
											<a href="javascript:void(0);" class="delete-row"><i class="fa fa-trash-alt text-danger"></i></a>
										</td>

									</tr>
									@php
										$bobot += $r->bobot;
									@endphp
								@endforeach

								</tbody>
								<tfoot>
									<tr class="text-center font-weight-bold">
										<td>Total Bobot Pekerjaan</td>
										<td><span class="font-weight-bold text-lime total"></span></td>
										<td></td>
									</tr>
								</tfoot>
							</table>

						</div>
						<div class="border-top my-1 m-b-15"></div>
						<div class="m-b-15">
							<button type="submit"  id="submit"  class="btn btn-success btn-block btn-lg">Simpan Rab Pekerjaan Proyek</button>
						</div>
					</form>
                </div>
            </div>
            <!-- end panel-body -->
            </div>
        </div>
    </div>

    <!-- #modal-dialog -->
        <div id="modal_theme_primary" class="modal fade" style="overflow:hidden;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Pekerjaan</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"> x </button>
                </div>
                <div class="modal-body">
                        <div class="form-group row m-l-15">
								<label class="col-form-label col-md-3">Material</label>
								<div class="col-md-8">
									<select class="default-select2 form-control datanya" placeholder="Cari / Pilih Material... " name="prdcd">
										@foreach($job as $r)
											<option value="{{$r->id}}|{{$r->nama}}">{{ $r->nama }}</option>
										@endforeach
									</select>
								</div>
							</div>

                            <div class="form-group row m-l-15">
								<label class="col-form-label col-md-3">Bobot Pekerjaan</label>
								<div class="col-md-3">
									<input type="text" name="bobot"  value="0" style="text-align: right;" class="form-control font-weight-semibold nomor bobot">
									<div class="form-control-feedback form-control-feedback-lg satuan">

									</div>
                                </div>
                            </div>
            </div>
			<div class="modal-footer">
					<button type="button" class="btn bg-primary add-row">Tambahkan</button>
					<button type="button" class="btn bg-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

    <!-- /basic initialization -->
@stop
@section('scripts')

<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script>
<script src="{{ asset('js/jquery.number.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
    $('.nomor').number(true, 0, '.', ',');
    $('.rupiah').number(true, 0,);
</script>

<script>
    $(document).ready(function() {

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



</script>

<script type="text/javascript">
    $(document).ready(function(){
		function calculateTotal(){
			var totalAmount = 0;
			$("[id^='gg']").each(function() {
				var x = $(this).val();
				rp = intVal(x);
				totalAmount += rp;
			});

			$('.total').text(tandaPemisahTitik(parseFloat(totalAmount)));
		}
        $(".add-row").click(function(){
            var datanya = $(".datanya").val();
            var s = datanya.split("|");
            var id_pekerjaan = s[0];
            var nama = s[1];
            var bobot = $(".bobot").val();
            var bobotv = tandaPemisahTitik(bobot);
            var markup = "<tr><td class='text-left'><input type='hidden' name='id_pekerjaan[]' value='" + id_pekerjaan + "'>" + nama + "</td><td class='text-center'><input type='hidden' name='bobot[]' id='gg' value='" + bobot + "'>" + bobotv + "</td></td><td><a href='javascript:void(0);' class='delete-row'><i class='fa fa-trash-alt text-danger'></i></a></td></tr>";
            $("#listitem").append(markup);
			calculateTotal();
            $(".bobot").val('');
            $('#modal_theme_primary').modal('hide');
        });

        // Find and remove selected table rows
        $("#listitem").on('click','.delete-row',function(){
			$(this).parent().parent().remove();
			calculateTotal();
		});
    });
</script>


<script type="text/javascript">

$(document).ready(function(){
    $("#simpanmaterial").submit(function(){

        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ url('mrabp/setterminsimpan') }}",
            method:"POST",
            data:$('#simpanmaterial').serialize(),
            beforeSend: function(){
                loaderOpen("Loading Prosses");
            },
            success:function(data){
                loaderClose();
                if(data.status == true){
                    Swal.fire({
                    title: "Pesan informasi",
                    text:  data.msg,
                    icon: "success",
                    }).then(function() {
						window.location = "{{url('mrabp/settermin/'.$id)}}";
                });
                }else{
                    Swal.fire({
                    title: "Pesan informasi",
                    text:  data.msg,
                    icon: "error",
                    }).then(function() {

                });
                }

            },
            error: function(){
                loaderClose();
                Swal.fire({
                    title: "Pesan informasi",
                    text:  data.msg,
                    icon: "error",
                    }).then(function() {
						window.location = "{{url('mrabp/settermin/'.$id)}}";
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


