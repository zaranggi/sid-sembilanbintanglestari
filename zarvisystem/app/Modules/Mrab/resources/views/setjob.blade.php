@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

@stop 
@section('content')
 

<h1 class="page-header">RAB Pembangunan Rumah <small>Set Pekerjaan</small></h1>

<div class="section-container section-with-top-border p-b-10">    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                     
                    <h5 class="panel-title"></h5>

                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/mrab/settermin/simpan') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="kode" value="{{ $kode }}">
                        
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
                        @php $no = 1; @endphp
                        @foreach($data as $x)
                        <div class="form-group m-b-10">
                        <label class="col-lg-4 col-form-label">{{ $no.". ".$x->nama_spk}}</label>                           
                            <div class="input-group col-lg-6">  
								<select name="job_{{$x->id}}[]" class="form-control multiple-select2" multiple="multiple" data-fouc >
                                    @foreach($setjob as $r)
											
												@if(in_array($r->id, $list_select[$x->id]))
												<option value="#{{ $r->id }}#" selected> {{ $r->nama }} </option>
												@else
												<option value="#{{ $r->id }}#"> {{ $r->nama }} </option>
												@endif
									 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @php $no++; @endphp
                        @endforeach

                        <div class="border-top my-3"></div>
                        <div class="col-md-6 "> 
                            <div class="text-right"> 
                                <button type="submit" id="submit" class="btn btn-primary"><i class="fa fa-paper-plane ml-2"></i> Save </button>
    
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

<script src="{{ asset('plugins/switchery/switchery.min.js')}}"></script>
<script src="{{ asset('js/page-form-slider-switcher.demo.min.js')}}"></script>
<script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{ asset('plugins/select2/dist/js/select2.min.js')}}"></script>  

<script>
    $(document).ready(function() { 
        PageDemo.init();
        $("#submit").click(function(){
			$("#submit").hide();
		});
    });
</script>
<script>
    $(document).ready(function() {  
        $(".multiple-select2").select2({placeholder:"Pilih Pekerjaan"})
    });
</script>
@stop
