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


<h1 class="page-header">SPK Fasum Fasos <small>add new...</small></h1>

<div class="section-container section-with-top-border p-b-5">
    @if(Session::has('flash_message'))
    <div class="alert alert-info ">
    <span class="glyphicon glyphicon-ok">
    </span><em>  ~  {{ Session::get('flash_message') }}</em>
        </div>
    @endif
    <form id="spk" enctype="multipart/form-data" class="form-horizontal" role="form" method="POST" action="{{ url("spkproyek")}}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                <div class="form-group row m-l-15">
                    <label class="col-form-label col-md-3">Jenis SPK</label>
                    <div class="col-md-8">
                        <select name="jenis" id="jenis_spk" class="default-select2 form-control" required >
                            <option>-- Pilih RAB Fasum Fasos --</option>
                            @foreach($jenis_spk as $r)
                                <option value="{{ $r->id }}">{{ $r->nama_properti }} :: {{ $r->judul }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="form-group row m-l-15">
                    <label class="col-form-label col-md-3">Pihak Pertama</label>
                    <div class="col-md-4">
                        <select name="pihak1" class="default-select2 form-control"  required >
                            <option>-- Pilih --</option>
                            @foreach($dirman as $r)
                                <option value="{{ $r->id }}">{{ $r->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group row m-l-15">
                    <label class="col-form-label col-md-3">Pihak Kedua </label>
                    <div class="col-md-4">
                        <select name="id_subkon" class="default-select2 form-control" required >
                            <option>-- Pilih --</option>
                            @foreach($subkon as $r)
                                <option value="{{ $r->id }}">{{ $r->nama }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3">Tanggal Mulai</label>
                        <div class="col-md-4">
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal_mulai" id="tanggal1" class="form-control" placeholder="Pilih Tanggal" required/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3">Tanggal Selesai</label>
                        <div class="col-md-4">
                            <div class="input-group" id="daterange-singledate">
                                <input type="text" name="tanggal_selesai" id="tanggal2" class="form-control" placeholder="Pilih Tanggal" required/>
                                <span class="input-group-btn">
                                    <i class="fa fa-calendar-alt text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row m-l-15">
                        <label class="col-form-label col-md-3">Total Borongan </label>
                        <div class="col-md-4">
                            <input type="text" name="gross_total" id="gross_total" class="form-control rupiah text-right" readonly>
                        </div>
                    </div>

            </div>
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

        $(".default-select2").select2();
    });
</script>


<script type="text/javascript">

    $(document).ready(function(){

        var intVal = function ( i ) {
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                    i : 0;
                };

		 $('#jenis_spk').change(function(){

            var xx = $(this).val();

                $.ajax({
                    type:"GET",
                    url:"{{url('spkproyek/nilaispk')}}?jenis_spk="+ xx,
                    success:function(res){
						if(res.length > 0){
                            $('#gross_total').val(res[0].gross);
						}else{
							alert("Maaf RAB untuk Unit ini belum dibuat. Silahkan setting RAB terlebih dahulu!");
							window.location.replace('{{ url('spkproyek') }}');
						}

					}
                });
		});

    });

</script>

@stop
