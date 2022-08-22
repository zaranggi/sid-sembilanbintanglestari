@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

@stop 
@section('content')
 

<h1 class="page-header">Manage Akun <small>Perkiraan ...</small></h1>
     
	 <!-- begin row -->
			<div class="row">
				<!-- begin col-6 -->
				<div class="col-xl-6">
					<!-- begin panel -->
					<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
						<!-- begin panel-heading -->
						<div class="panel-heading">
							<h4 class="panel-title">Input Data</h4>
							 
						</div>
						<!-- end panel-heading -->
						<!-- begin panel-body -->
						<div class="panel-body">
							  
						
                        <form method="post" class="form-horizontal" role="form" action="{{ route('akun.update', $data->id) }}"> 
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
						
                        <div class="form-group row m-b-15">
                            <label class="col-form-label col-md-3">Komponen</label>
                            <div class="col-md-4"> 
                                <select name="id_komponen" class="form-control select-icons" data-fouc required>   
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
                   
						  
							<div class="form-group row m-b-15">
								<label class="col-form-label col-md-3">Klasifikasi</label>
								<div class="col-md-4"> 
									<select name="id_klasifikasi" class="form-control select-icons" data-fouc required>                                     
                                        
                                        @foreach($data_klasifikasi as $r)
                                            @if($r->id == $data->id_klasifikasi)
                                                <option value="{{$r->kode}}" data-icon="blank" selected> {{ $r->nama_akun }}</option>
                                            @else 
                                                <option value="{{$r->kode}}" data-icon="blank" > {{ $r->nama_akun }}</option> 
                                            @endif
                                        @endforeach
                                       
									</select>
								</div>
							</div>   
							<div class="form-group row row m-b-15">
								<label class="col-form-label col-md-3">Kode Akun</label>
								<div class="col-md-2"> 
									<span class="id_klasifikasi2 form-control"> {{ substr($data->kode,0,3)}} </span>
									<input type="hidden" name="id_klasifikasi2"  value="{{ substr($data->kode,0,3)}}" class="form-control">  
								</div>	
								<div class="col-md-4"> 
                                <input type="text" name="kode" value="{{substr($data->kode,3,4)}}" class="form-control" > 
								</div> 
							</div> 
							
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Nama Akun</label>
                            <div class="col-md-4"> 
                                 
                                <input type="text" name="nama" value="{{ $data->nama_akun }}"  class="form-control" >
								<small class="f-s-12 text-danger">
								{{ $errors->first('nama') }}
								</small> 
                            </div>
                        </div>  
						
						  <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Posting Saldo</label>
                            <div class="col-md-4"> 
                                    <select name="posting" data-placeholder="Pilih " class="form-control select-icons" data-fouc>                                     
                                        @php 
                                            if($data->posting == "D"){
                                                $d_s = "selected";
                                                $k_s = "";
                                            }else{
                                                $d_s = "";
                                                $k_s = "selected";
                                            }
                                        @endphp

                                        <option value="D" data-icon="blank" {{$d_s}}> Debit </option>
                                        <option value="K" data-icon="blank"  {{$k_s}}> Kredit </option>                                            
                                    </select>
                            </div>
                        </div>  
                        <div class="form-group row m-b-10">
                            <label class="col-form-label col-md-3 ">Posting Laporan</label>
                            <div class="col-md-4"> 
                                <select name="kat" data-placeholder="Pilih " class="form-control select-icons" data-fouc>
                                    @php 
                                    if($data->kat == "NERACA"){
                                        $n_s = "selected";
                                        $l_s = "";
                                    }else{
                                        $n_s = "";
                                        $l_s = "selected";
                                    }
                                @endphp                                     
                                    <option value="NERACA" data-icon="blank" {{$n_s}}> Neraca</option>
                                    <option value="LR" data-icon="blank" {{$l_s}}> Laba Rugi</option>
                                        
                                </select>
                            </div>
                        </div>   
						
						<div class="border-top my-3"></div>
                        <div class="col-md-6 "> 
                            <div class="text-right"> 
                                <button type="submit" id="simpan" class="btn btn-primary"><i class="fa fa-paper-plane ml-2"></i> Save </button>
    
                                <a href="{{ URL::previous() }}" class="btn btn-warning"><i class="fa fa-redo-alt ml-2"></i> Cancel </a>
    
                            </div> 
                        </div>
							</form>
						</div>
						<!-- end panel-body -->
					</div>
				</div>
			</div>	 

@stop
 
@section('scripts')

<script src="{{ asset("plugins/switchery/switchery.min.js")}}"></script>
<script src="{{ asset("js/page-form-slider-switcher.demo.min.js")}}"></script>
<script src="{{ asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script src="{{ asset("plugins/select2/dist/js/select2.min.js")}}"></script>
    

<script type="text/javascript">

    $("select[name='id_komponen']").change(function(){

        var id_komponen = $(this).val();

        var token = $("input[name='_token']").val();

        $.ajax({

            url: "{{ url('akun/listklasifikasi') }}",

            method: 'POST', 
            data: {id_komponen:id_komponen, _token:token},
            success: function(res) {

                $("select[name='id_klasifikasi']").empty(); 
                    if(res){
                        
                        $("select[name='id_klasifikasi']").append('<option value="">Pilih Klasifikasi</option>');
                        $("select[name='id_klasifikasi']").append('<option value="00">Tidak Ada Klasifikasi</option>');
                        $.each(res,function(key,value){

                            $("select[name='id_klasifikasi']").append('<option value="'+value['kode']+'" data-icon="location3">'+value['nama_akun']+'</option>');

                        });
                    } 
                 
            }
        });
    });

    $("select[name='id_klasifikasi']").change(function(){

        
        var id_klasifikasi = $(this).val(); 
        if(id_klasifikasi != ""){
            $("input[name='id_klasifikasi2']").val(id_klasifikasi);   
            $(".id_klasifikasi2").html(id_klasifikasi);
        }
        
 
    });
    
$(document).on('click', '#simpan', function(){   
    $('#simpan').hide();    
         
}); 

</script>
@stop
