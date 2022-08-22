@extends('admin.layout') 
@section('styles') 

<link href="{{ asset("plugins/switchery/switchery.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" />

@stop 
@section('content')
 

<h1 class="page-header">RAB  <small>Pembangunan Rumah ...</small></h1>

<div class="section-container section-with-top-border p-b-10">    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Edit</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/mrab/ubah/simpan') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id_properti" value="{{ $id_properti }}">
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
						
                        <div class="form-group m-b-10">
                            <label class="col-lg-2 col-form-label font-weight-bold">Tipe Unit</label>
                            <div class="input-group col-lg-3"> 
                                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                                <select name="tipe_unit" class="default-select2 form-control" required>  
                                    <option value="{{ $tipe_unit }}" >{{ $tipe_unit }}</option>
                                   <option value="21">21</option>
                                    <option value="27" >27</option>
                                    <option value="30" >30</option>
                                    <option value="36" >36</option>
                                    <option value="45" >45</option>
                                    <option value="50" >50</option>
                                    <option value="54" >54</option>
                                    <option value="54" >56</option>
                                    <option value="60" >60</option>
                                    <option value="64" >64</option>
                                    <option value="68" >68</option>
                                    <option value="70" >70</option>
                                    <option value="120" >120</option>
                                    <option value="Ruko" >Ruko</option> 
                                    
                                </select> 
                                <strong style="color:red">{{ $errors->first('tipe') }}</strong>
                            </div>
                        </div>  
 
                        
                        <div class="mb-2"></div>

                      
                        @php $no=1; 
						$grossnya = 0;
						@endphp
                        @foreach($data as $r)

                                <div class="row">
                                <div class="col-lg-4">  
                                <input type="hidden" name="id_mrab_{{$r->id}}"  value="{{$r->id}}" >
                                <input type="hidden" name="jenis_spk_{{$r->id}}"  value="{{$r->jenis_spk}}" >
                                <label class="col-lg-12 col-form-label">{{ $no.". ".$r->nama_spk}}</label>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" name="qty_{{$r->id}}" value="{{$r->qty}}" style="text-align: center;" placeholder="Volume" class="form-control rupiah" required>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                
                                                <select name="satuan_{{$r->id}}" placeholder="Satuan"  class="default-select2 form-control" required>  
                                                    <option value="{{$r->satuan}}" selected>{{$r->satuan}}</option>
                                                    <option value="m2" >m<sup>2</sup></option> 
                                                    <option value="m3" >m<sup>3</sup></option> 
                                                    <option value="Meter Lari" >Meter Lari</option> 
                                                    <option value="Ls" >Ls</option>                                                     
                                                </select> 
                                                
                                            </div>
                                        </div>
                                    </div> 
                                </div>  

                                <div class="col-lg-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" value="{{$r->price}}" name="price_{{$r->id}}" style="text-align: center;" placeholder="Harga Satuan" class="form-control rupiah" required>
                                                
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

                                <div class="col-lg-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                            <input type="text" id="gross gross_{{$r->id}}" value="{{$r->gross}}" name="gross_{{$r->id}}"  placeholder="Jumlah (Rp)" style="text-align: right;background-color: #fff;opacity: 1; " class="form-control rupiah font-weight-bold text-primary-600 font-size-lg" >                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                        </div>
                        
                        @php 
						
							$no++; 
						$grossnya += $r->gross;
							
						@endphp
                        @endforeach
  
                        
                        
                        <div class="border-top my-3"></div>

                        <div class="row">
                            <div class="col-lg-10 form-control font-weight-bold text-primary-600 text-center font-size-lg ">
                                Total  
                            </div>
    
                            <div class="col-lg-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group-feedback form-group-feedback-left">                                             
                                            <input type="text" name="total" value="{{ number_format($grossnya)}}" id="total"  class="form-control text-center font-weight-bold text-primary-600 font-size-lg" readonly>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3"></div>
                        <h4 class="panel-title">SPK Pekerjaan</h4>
                        <div class="mb-2"></div>

                      
                        @php $no=1; @endphp
                        @foreach($data as $r)

                            <div class="row">
                                <div class="col-lg-4">  
                                    <label class="col-lg-12 col-form-label">{{ $no.". ".$r->nama_spk}}</label>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" value="{{ $r->t1 }}" name="t1_{{$r->id}}" style="text-align: center;" placeholder="Termin 1" class="form-control nomor" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" value="{{ $r->t2 }}" name="t2_{{$r->id}}" style="text-align: center;" placeholder="Termin 2" class="form-control nomor" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" value="{{ $r->t3 }}" name="t3_{{$r->id}}" style="text-align: center;" placeholder="Termin 3" class="form-control nomor" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" value="{{ $r->t4 }}"  name="t4_{{$r->id}}" style="text-align: center;" placeholder="Termin 4" class="form-control nomor" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" value="{{ $r->t5 }}" name="t5_{{$r->id}}" style="text-align: center;" placeholder="Termin 5" class="form-control nomor" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group-feedback form-group-feedback-left">
                                                <input type="text" value="{{ $r->retensi }}" name="retensi_{{$r->id}}" value="5" style="text-align: center;" placeholder="Retensi" class="form-control nomor" readonly>
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
                                                <input type="text" value="{{ $r->t1 + $r->t2 +$r->t3 +$r->t4 +$r->t5 + $r->retensi  }}" id="termin_{{$r->id}}"  placeholder="0%" style="text-align: center;background-color: #fff;opacity: 1; " class="form-control rupiah font-weight-bold text-primary-600 font-size-lg" readonly>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                               
                        </div>
                        <div class="border-top mb-1"></div>
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

<script src="{{ asset("plugins/switchery/switchery.min.js")}}"></script>
<script src="{{ asset("js/page-form-slider-switcher.demo.min.js")}}"></script> 

<script src="{{ asset('js/jquery.number.js') }}"></script> 

<script type="text/javascript">
    $(document).ready(function() { 
        PageDemo.init();
    });
</script> 

<script type="text/javascript"> 
    $('.nomor').number(true, 2, '.', ',');
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
	
    function calculateTotalm(){
        var totalAmount = 0;
        $("[id^='gross_m']").each(function() {
            var rp = $(this).val();

            rp = intVal(rp);

            totalAmount += rp;

        });


        $('#totalm').val(tandaPemisahTitik(parseFloat(totalAmount)));
    }

</script>


<script type="text/javascript">
    $(document).ready(function() {
       
        $(".add_field_button").click(function(e){ //on add input button click
            e.preventDefault();

                i = $('<div class="row"><div class="col-lg-3"><input type="text" placeholder="Keterangan" maxlength="50" name="akun[]"  class="form-control" required></div> <div class="col-lg-1"><div class="row">  <div class="col-md-12">  <div class="form-group-feedback form-group-feedback-left">  <input type="text" name="qty[]" style="text-align: center;" placeholder="Volume" class="form-control rupiah" required></div>  </div></div></div><div class="col-lg-2"><div class="row">  <div class="col-md-12">  <div class="form-group-feedback form-group-feedback-left">  <select name="satuan[]" placeholder="Satuan"  class="default-select2 form-control" required><option value="" >Satuan</option><option value="m2" >m<sup>2</sup></option> <option value="m3" >m<sup>3</sup></option> <option value="Meter Lari" >Meter Lari</option> <option value="Ls" >Ls</option><option value="Pcs" >Pcs</option><option value="Box" >Box</option><option value="Pkt" >Pkt</option><option value="Set" >Set</option></select> </div>  </div></div> </div><div class="col-lg-2"><div class="row">  <div class="col-md-12">  <div class="form-group-feedback form-group-feedback-left">  <input type="text" name="price[]" style="text-align: center;" placeholder="Harga Satuan" class="form-control rupiah" required></div>  </div></div></div>  <div class="col-lg-1"><div class="row"><div class="col-md-12"><span class="text-center form-control font-weight-bold text-primary-600 font-size-lg"> = </span></div></div></div><div class="col-lg-2"><div class="row">  <div class="col-md-12">  <div class="form-group-feedback form-group-feedback-left">  <input type="text" id="gross_m" name="grossm[]"  placeholder="Jumlah (Rp)" style="text-align: right;" class="form-control rupiah" required></div>  </div></div></div><label class="col-form-label col-lg-1"><i class="fa fa-window-close remove_field text-danger "> </i></label></div>');
                //re-init mask money to apply new added input
                $(".input_fields_wrap").append(i); //add input box
                $('.rupiah').number(true, 0,);
                calculateTotalm();
                            
        });
		
		$("#submit").click(function(e){ //on add input button click
           $("#submit").hide();
                            
        });

        $(".input_fields_wrap").on('click', '.remove_field', function(e){ //Once remove button is clicked
            e.preventDefault();
            $(this).closest("div").remove(); //Remove field html
            calculateTotalm();
             
        });

    });

</script>
@stop
