@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

@stop 
@section('content')
 

<h1 class="page-header">Manage Job <small>SPK...</small></h1>

<div class="section-container section-with-top-border p-b-10">    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    @foreach($data_spk as $rspk)
                    <h5 class="panel-title">SPK - {{$rspk->nama_spk}}</h5>

                        @endforeach
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/spk/setjob/simpan') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id_spk" value="{{ $idspk }}">
                        
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
                        @php $no = 0; @endphp
                        @foreach($data as $x)
                        <div class="form-group m-b-10">
                        <label class="col-lg-2 col-form-label">Termin Ke {{$x->termin}}</label>
                            <div class="input-group col-lg-2">  
                                <input type="text" value="{{$x->nilai}}" class="form-control rupiah text-right" readonly> 
                            </div>
                            <div class="input-group col-lg-3">  
                                <input type="text" value="{{$x->ket_termin}}" class="form-control" readonly> 
                            </div>
                            <div class="input-group col-lg-5">  
                            <select name="termin_{{$x->id}}[]" class="form-control multiple-select2" multiple="multiple" data-fouc required>
                                    @foreach($setjob as $r)

                                        <option value="#{{ $r->id }}#"> {{ $r->nama }} </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @php $no++; @endphp
                        @endforeach

                        

                        <input type="hidden" name="t_termin" value="{{ $no }}">
                        <div class="border-top my-3"></div>
                        <div class="col-md-6 "> 
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

<script src="{{ asset("plugins/switchery/switchery.min.js")}}"></script>
<script src="{{ asset("js/page-form-slider-switcher.demo.min.js")}}"></script>
<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script> 
<script src="{{ asset('js/jquery.number.js') }}"></script> 
 
<script type="text/javascript"> 
    $('.nomor').number(true, 0,);
    $('.persen').number(true, 2, '.', ',');
    $('.rupiah').number(true, 0,);
</script>

<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>
<script>
    $(document).ready(function() {  
        $(".multiple-select2").select2({placeholder:"Pilih Pekerjaan"})
    });
</script>
@stop
