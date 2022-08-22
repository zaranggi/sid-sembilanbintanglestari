@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

@stop 
@section('content')
 

<h1 class="page-header">Manage Komponen <small>Akun ...</small></h1>

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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/ackomponen') }}">

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
 
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Nama Komponen</label>
                            <div class="input-group col-lg-4"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <input type="text" name="nama"  class="form-control" >
                                <strong style="color:red">{{ $errors->first('nama') }}</strong>
                            </div>
                        </div> 
                       
  
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Posting Saldo</label>
                            <div class="input-group col-lg-3"> 
                                    <select name="posting" data-placeholder="Pilih " class="form-control select-icons" data-fouc>                                     
                                        <option value="D" data-icon="blank" selected> Debit </option>
                                        <option value="K" data-icon="blank" > Kredit </option>
                                            
                                    </select>
                            </div>
                        </div>   

                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label">Posting Laporan</label>
                            <div class="input-group col-lg-3"> 
                                <select name="kat" data-placeholder="Pilih " class="form-control select-icons" data-fouc>                                     
                                    <option value="NERACA" data-icon="blank" selected> NERACA</option>
                                    <option value="LR" data-icon="blank" > Laba Rugi</option>                                        
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
