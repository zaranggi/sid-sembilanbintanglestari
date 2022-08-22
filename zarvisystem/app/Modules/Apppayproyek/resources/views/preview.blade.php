@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-calendar/css/bootstrap_calendar.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css")}}" rel="stylesheet" /> 

@stop 
@section('content')
 

<h1 class="page-header">Monitoring Progress <small>Bangunan...</small></h1>

<div class="section-container section-with-top-border p-b-10">    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                   @foreach($kode as $rk)
                    Nomor SPK : {{ $rk->KODE}}
                    @endforeach
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    
                    <div class="form-horizontal" role="form">

                       
                        @php $no = 1; $ket_termin = "" @endphp
                        @foreach($menu as $x)

                        @if($ket_termin <> $x->KET_TERMIN)

                        <div class="form-group m-b-10">
                            <label class="col-lg-12 col-form-label text-info font-weigth-bold">Termin  {{$x->TERMIN}}  Syarat Pembayaran : {{$x->KET_TERMIN}}</label>
                        </div>    
                        @php 
                        $ket_termin = $x->KET_TERMIN; 
                         $no = 1;
                         @endphp
                        @endif
                        <div class="form-group m-b-10">
                        <label class="col-lg-4 col-form-label">{{$no}}. {{$x->NAMA}}</label>
                            
                            <div class="input-group col-lg-2">  
                                <span class="form-control">
                                    @if($x->TANGGAL  =='' OR $x->TANGGAL == "0000-00-00")
                                    Belum Ada Progres
                                    @else
                                    {{ App\Helpers\Tanggal::tgl_indo($x->TANGGAL) }}  
                                        
                                    @endif
                                </span> 
                            </div>
                            
                            <div class="input-group col-lg-3">  
                                <span class="form-control" aria-placeholder="Keterangan">{{$x->KETERANGAN}} </span> 
                            </div> 

                            <div class="input-group col-lg-1">  
                                @if($x->PHOTO <> '')                                                                   
                                    <a href="{{ url('image/project/'.$x->PHOTO) }}" target="_blank" class="dropdown-item">
                                        <i class="fa fa-camera-retro fa-2x text-info"></i> 
                                    </a>
                                @else 
                                <a href="#" class="dropdown-item">
                                    <i class="fa fa-camera-retro fa-2x text-warning"></i> 
                                </a>
                                @endif
                            </div>
                            
                        </div>
                        @php $no++; @endphp
                        @endforeach
                        <div class="border-top my-3"></div>
                     
                </div>
            </div>
        </div>
    </div>
</div>
</div>

 
@stop
 
@section('scripts')

<script src="{{ asset("plugins/switchery/switchery.min.js")}}"></script>
<script src="{{ asset("js/page-form-slider-switcher.demo.min.js")}}"></script>
<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script> 

<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>
 

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
 
@stop
