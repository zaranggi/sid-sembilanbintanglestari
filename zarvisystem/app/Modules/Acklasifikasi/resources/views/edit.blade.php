@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

@stop 
@section('content')
 

<h1 class="page-header">Manage Klasifikasi <small>Akun...</small></h1>

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
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('acklasifikasi.update', $data->id) }}">

                        @csrf
                        @method('PATCH')
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
 

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Komponen</label>
                            <div class="input-group col-lg-3"> 
                                <select name="id_komponen" data-placeholder="Pilih Komponen" class="form-control select-icons" data-fouc>                                     
                                    @foreach($data_komponen as $r)
                                        @if($r->id == $data->id_komponen)
                                        <option value="{{$r->id}}" data-icon="blank" selected> {{ $r->nama_akun }}</option>
                                        @else
                                        <option value="{{$r->id}}" data-icon="blank" > {{ $r->nama_akun }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>  
 
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Nama Klasifikasi</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                            <input type="text" name="nama" value="{{$data->nama_akun}}" class="form-control" >
                                <strong style="color:red">{{ $errors->first('nama') }}</strong>
                            </div>
                        </div> 
                       
 
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Kode Akun</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="kode" value="{{$data->kode}}" class="form-control" >
                                <strong style="color:red">{{ $errors->first('kode') }}</strong>
                            </div>
                        </div>   
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Posting Saldo</label>
                            <div class="input-group col-lg-3"> 
                                    <select name="posting" data-placeholder="Pilih " class="form-control select-icons" data-fouc>                                     
                                        @if($data->posting == "D" )
                                        <option value="D" data-icon="blank" selected> Debit </option>
                                        <option value="K" data-icon="blank" > Kredit </option>
                                        @else 
                                        <option value="D" data-icon="blank" > Debit </option>
                                        <option value="K" data-icon="blank" selected> Kredit </option>
                                        @endif
                                            
                                    </select>
                            </div>
                        </div>   
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Posting Laporan</label>
                            <div class="input-group col-lg-3"> 
                                <select name="kat" data-placeholder="Pilih " class="form-control select-icons" data-fouc>                                     
                                    @if($data->kat == "NERACA" )
                                    <option value="NERACA" data-icon="blank" selected> NERACA</option>
                                    <option value="LR" data-icon="blank" > Laba Rugi</option>   
                                    @else 
                                    <option value="NERACA" data-icon="blank" > NERACA</option>
                                    <option value="LR" data-icon="blank" selected> Laba Rugi</option>   
                                    @endif
                                                                         
                                </select>
                            </div>
                        </div>   
                       

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
<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>
<script>
    $(document).ready(function() {  
        $(".multiple-select2").select2({placeholder:"Select a Department"})
    });
</script>
@stop
