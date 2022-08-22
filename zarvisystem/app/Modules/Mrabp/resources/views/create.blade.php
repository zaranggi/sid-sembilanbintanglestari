@extends('admin.layout')
@section('styles')

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

@stop
@section('content')


<h1 class="page-header">RAB  <small>Fasum Fasos ...</small></h1>

<div class="section-container section-with-top-border p-b-10">
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Form Input</h4>

                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body panel-form">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/mrabp') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id_properti" value="{{$id_properti}}">
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

                        <div class="mb-2"></div>

                        <div class="form-group row m-l-15">
                            <label class="col-form-label col-md-2">Nama Proyek</label>
                            <div class="col-md-4">
                                <input type="text" name="judul"  class="form-control" placeholder="Nama Proyek" required>
                                <strong style="color:red">{{ $errors->first('judul') }}</strong>
                            </div>
                        </div>
						<div class="form-group row m-l-15">
                            <label class="col-form-label col-md-2">Total Hari</label>
                            <div class="col-md-2">
                                <input type="text" name="hari"  class="form-control nomor text-right " placeholder="Total hari" required>
                                <strong style="color:red">{{ $errors->first('hari') }}</strong>
                            </div>
                        </div>
                        <div class="form-group row m-l-15">
                            <label class="col-form-label col-md-2">Total Pekerja</label>
                            <div class="col-md-2">
                                <input type="text" name="pekerja"  class="form-control nomor text-right " placeholder="Pekerja" required>
                                <strong style="color:red">{{ $errors->first('pekerja') }}</strong>
                            </div>
                        </div>

                        <div class="form-group row m-l-15">
                            <label class="col-form-label col-md-2">Volume</label>
                            <div class="col-md-2">
								<input type="text" name="qty" style="text-align: center;" placeholder="Volume" class="form-control nomor" required>
                            </div>
                        </div>

                        <div class="form-group row m-l-15">
                            <label class="col-form-label col-md-2">Satuan Proyek</label>
                            <div class="col-md-2">
                                <select name="satuan" placeholder="Satuan"  class="default-select2 form-control" required>
									<option value="m2" >m<sup>2</sup></option>
									<option value="m3" >m<sup>3</sup></option>
									<option value="Meter Lari" >Meter Lari</option>
									<option value="Ls" >Ls</option>
									<option value="Paket" >Paket</option>
								</select>
                            </div>
                        </div>

                        <div class="form-group row m-l-15">
                            <label class="col-form-label col-md-2">Nilai Proyek</label>
                            <div class="col-md-2">
                                <input type="text" name="gross"  class="form-control rupiah text-right font-weight-bold" placeholder="0" required>
                                <strong style="color:red">{{ $errors->first('gross') }}</strong>
                            </div>
                        </div>

                        <div class="border-top my-3"></div>
                        <div class="mb-3"></div>
                        <h4 class="panel-title m-l-15">Termin</h4>
                        <div class="mb-2"></div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="col-lg-12 col-form-label">*) Termin Pembayaran</label>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" id="gross" name="t1" style="text-align: center;" placeholder="T-1" class="form-control nomor" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" id="gross" name="t2" style="text-align: center;" placeholder="T-2" class="form-control nomor" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" id="gross" name="t3" style="text-align: center;" placeholder="T-3" class="form-control nomor" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" id="gross" name="t4" style="text-align: center;" placeholder="T-4" class="form-control nomor" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" id="gross" name="t5" style="text-align: center;" placeholder="T-5" class="form-control nomor" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" id="gross" name="retensi" value="5" style="text-align: center;" placeholder="Retensi" class="form-control nomor" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                           <span class="text-center form-control font-weight-bold text-primary-600 font-size-lg">
                                               =
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" id="total" id="termin"  placeholder="0%" style="text-align: center;background-color: #fff;opacity: 1; " class="form-control rupiah font-weight-bold text-primary-600 font-size-lg" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="border-top mb-1"></div>

                        <div class="border-top my-3"></div>
                        <div class="col-md-6 mb-1">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane ml-2"></i> Save </button>

                                <a href="{{ URL::previous() }}" class="btn btn-warning"><i class="fa fa-redo-alt ml-2"></i> Cancel </a>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')

<script src="{{ asset("js/page-form-slider-switcher.demo.min.js")}}"></script>

<script src="{{ asset('js/jquery.number.js') }}"></script>

<script type="text/javascript">
    $('.nomor').number(true, 0, '.', ',');
    $('.rupiah').number(true, 0,);
</script>

<script type="text/javascript">
        $(document).ready(function() {

            $(document).on('blur', "[id^=gross]", function(){
                calculateTotal();
            });

        });

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
        $("[id^='gross']").each(function() {
            var rp = $(this).val();

            rp = intVal(rp);

            totalAmount += rp;

        });


        $('#total').val(tandaPemisahTitik(parseFloat(totalAmount)));
    }

</script>


@stop
