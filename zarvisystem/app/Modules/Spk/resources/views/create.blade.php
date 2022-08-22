@extends('admin.layout')
@section('styles')

<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />


<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" />


@stop
@section('content')


<h1 class="page-header">SPK  <small>add new...</small></h1>

<div class="section-container section-with-top-border p-b-5">
    @if(Session::has('flash_message'))
    <div class="alert alert-info ">
    <span class="glyphicon glyphicon-ok">
    </span><em>  ~  {{ Session::get('flash_message') }}</em>
        </div>
    @endif
    <form id="spk" enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url('spk')}}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id_spr" id="id_spr">
        @if ( count( $errors ) > 0 )
            <div class="alert alert-danger">
                <strong>Whoops!</strong>
                There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="row">
         <!-- begin col-6 -->
         <div class="col-lg-6">
            <div class="widget">
                <div class="widget-header p-t-10">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="m-b-5 m-l-10 text-info">Cari</h4>
                        </div>
                    </div>
                </div>

                <div class="form-group row m-l-5">
                    <label class="col-md-3 col-form-label">Perumahan</label>
                    <div class="col-md-7">
                         <select id="properti" name="id_properti" class="form-control pilih" placeholder="Pilih Perumahan" required >
                            <option>-- Pilih Perumahan --</option>
                            @foreach($properti as $r)
                                <option value="{{ $r->id }}">{{ $r->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="horizontal-divider m-0 m-b-10"></div>

                <div class="form-group row m-l-15">
                    <label class="col-lg-3 col-form-label">Unit/Kavling</label>
                    <div class="col-lg-4">
                        <select id="listunit" name="id_kav" class="form-control default-select2" placeholder="Pilih Unit"  required >

                        </select>
                    </div>
                </div>

                <div class="form-group row m-l-10">
                    <label class="col-form-label col-md-3 ">Type</label>
                    <div class="col-md-2">
                        <input type="text" id="tipeunit" name="tipe_unit"  class="form-control text-right" readonly>
                    </div>
                </div>
                <div class="form-group row m-l-10">
                    <label class="col-form-label col-md-3 ">Luas Tanah m<sup>2</sup></label>
                    <div class="col-md-2">
                        <input type="text" id="lt"  class="form-control nomor text-right" readonly>
                    </div>
                </div>
                <div class="form-group row m-l-10">
                    <label class="col-form-label col-md-3 ">Luas Bangunan (m<sup>2</sup>)</label>
                    <div class="col-md-2">
                        <input type="text" id="lb"  class="form-control nomor text-right" readonly>
                    </div>
                </div>

            </div><!--end widget-->

        </div><!--end Col 6 -->


    </div><!--end Row -->

    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-8">
           <div class="widget">
               <div class="widget-header p-t-10">
                   <div class="row">
                       <div class="col-lg-6">
                           <h4 class="m-b-5 m-l-10 text-info">Form SPK</h4>

                       </div>
                   </div>
               </div>
               <div class="border-top my-1"></div>
               <!-- begin panel -->
               <div class="form-horizontal">
                <div class="form-group m-b-15">
                    <label class="col-lg-3 col-form-label">Jenis SPK</label>
                    <div class="input-group col-lg-7">
                        <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                        <select name="jenis" id="jenis_spk" class="default-select2 form-control" placeholder="Jenis SPK" required >
                            <option>-- Pilih Jenis SPK --</option>

                        </select>
                    </div>
                </div>

                <div class="form-group m-b-15">
                    <label class="col-lg-3 col-form-label">Pihak Pertama</label>
                    <div class="input-group col-lg-7">
                        <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                        <select name="pihak1" class="default-select2 form-control" placeholder="Pilih Pihak 1" required >
                            <option>-- Pilih Pihak 1 --</option>
                            @foreach($dirman as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group m-b-15">
                    <label class="col-lg-3 col-form-label">Pihak Kedua </label>
                    <div class="input-group col-lg-7">
                        <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                        <select name="id_subkon" class="default-select2 form-control" placeholder="Pilih Pihak 2" required >
                            <option>--  Pilih Pihak 2 --</option>
                            @foreach($subkon as $r)
                                <option value="{{ $r->id }}">{{ $r->nama }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Tanggal Mulai</label>
                        <div class="input-group col-lg-5">
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal_mulai" id="tanggal1" class="form-control" placeholder="Pilih Tanggal" required/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Tanggal Selesai</label>
                        <div class="input-group col-lg-5">
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal_selesai" id="tanggal2" class="form-control" placeholder="Pilih Tanggal" required/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group m-b-15">
                        <label class="col-lg-4 col-form-label">Total Borongan </label>
                        <div class="input-group col-lg-6">
                            <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="gross_total" id="gross_total" class="form-control rupiah text-right" readonly>
                        </div>
                    </div>

            </div>
			<input type="hidden" name="kode_mrab" id="kode_mrab" class="form-control text-right" >
			<input type="hidden" name="price_spk" id="price_spk" class="form-control text-right" >
			<input type="hidden" name="gross_spk" id="gross_spk" class="form-control text-right" >
			<input type="hidden" name="bobot" id="bobot" class="form-control text-right" >
            <div class="border-top my-1 m-b-15"></div>
            <div class="m-b-15">
                <button type="submit" value="1" id="save" class="btn btn-lime btn-block btn-lg">Buat SPK</button>
            </div>
        </div>

    </div><!--end Row -->

</div><!--end Section -->
</form>



@stop

@section('scripts')

<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script>
<script src="{{ asset('js/jquery.number.js') }}"></script>


<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>

<script type="text/javascript">
    $('.nomor').number(true, 0,);
    $('.persen').number(true, 2, '.', ',');
    $('.rupiah').number(true, 0,);
</script>

<script>
    $(document).ready(function() {

            $("#tanggal1").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });
            $("#tanggal2").datepicker(
            {
                todayHighlight: 1,
                autoclose:1,
                format: "yyyy-mm-dd",
            });

			$(".pilih").select2();
            $(".default-select2").select2();
    });
</script>


<script type="text/javascript">

    $(document).ready(function(){

		function listspknya(query1,query2){

            var _token = $('input[name="_token"]').val();
			$.ajax({
				type:"GET",
				url:"{{url('spk/listspknya')}}/"+query1+"/"+query2,
				success:function(res){
					$("#jenis_spk").empty();
					if(res){
						$("#jenis_spk").append('<option>Pilih SPK</option>');
						$.each(res,function(key,value){
							$("#kode_mrab").val(value['id']);
							$("#jenis_spk").append('<option value="'+value['id']+'" data-icon="location3">'+value['judul']+'</option>');

						});
					}


				}
			});

        }


        $("#spk").submit(function(){
            $('#save').hide();
        });

		$('#properti').change(function(){
			var id = $(this).val();
			$("#listunit").empty();
			if(id){
				$.ajax({
					type:"GET",
					url:"{{url('spk/listunit')}}/"+id,
					success:function(res){
						$("#listunit").empty();
						if(res){

							$("#listunit").append('<option>Pilih Unit</option>');
							$.each(res,function(key,value){

								$("#listunit").append('<option value="'+value['id']+'" data-icon="location3">'+value['nama']+'</option>');

							});
						}

					}

				});

			}else{

				$("#listunit").empty();

			}

		});


		$('#listunit').change(function(){
            var id = $(this).val();

            var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ url('spk/unitdetail') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{query:id, _token:_token},
                        success:function(data){

                            $('#tipeunit').val(data[0].tipe);
                            $('#lt').val(data[0].luas_tanah);
                            $('#lb').val(data[0].luas_bangunan);
							listspknya(data[0].id_properti,data[0].tipe);

                        }
                    });

        });



        var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                    i : 0;
        };

        $('#cari').keyup(function(){
                var query = $(this).val();
                if(query.length >=3)
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ url('spk/autocomplete') }}",
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){
                            $('#tampil').fadeIn();
                            $('#tampil').html(data);


                        }
                    });
                }
        });

        $(document).on('click', 'li', function(){

            $('#cari').val($(this).text());

            $('#tampil').fadeOut();
            var query = $(this).text();
            var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ url('spk/isikan') }}",
                        method:"POST",
                        dataType: 'json',
                        data:{query:query, _token:_token},
                        success:function(data){

                            $('#kode').val(data[0].kode);
                            $('#nama').val(data[0].nama);
                            $('#tipeunit').val(data[0].tipe);
                            $('#properti').val(data[0].id_properti);

                        }
                    });

        });


        $('#qty_tambahan').keyup(function(){
            var qty_tambahan = $(this).val();
            var price = $('#price_spk').val();
            var gross_spk = $('#gross_spk').val();

			$('#gross_tambahan').val( intVal(price)  * intVal(qty_tambahan));
            $('#gross_total').val( intVal(gross_spk)  + (intVal(price)  * intVal(qty_tambahan)));

        });

		 $('#jenis_spk').change(function(){

            var xx = $(this).val();
			var tipe_unit = $('#tipeunit').val();
			var id_properti = $('#properti').val();
			var bobot = $('#bobot').val();

                $.ajax({
                    type:"GET",
                    url:"{{url('spk/nilaispk')}}?id="+ xx,
                    success:function(res){
						if(res.length > 0){
                            $('#gross_spk').val(res[0].gross);
                            $('#gross_total').val(res[0].gross);
						}else{
							alert("Maaf RAB untuk Unit ini belum dibuat. Silahkan setting RAB terlebih dahulu!");
							window.location.replace('{{ url('spk') }}');
						}

					}
                });
		});

    });

</script>

@stop
