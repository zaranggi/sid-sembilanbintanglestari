@extends('admin.layout')

@section('styles') 
@stop
@section('content')

            <h1 class="page-header"> List Tagihan Pembelian Bertahap  <small>Konsumen</small></h1>
            <!-- begin section-container -->
            <div class="section-container section-with-top-border p-b-5">
            <!-- begin row -->
                <div class="row">
                    <!-- begin col-9 -->
                    <div class="col-lg-8">
                        @if(Session::has('flash_message'))
                        <div class="alert alert-info ">
                            <span class="glyphicon glyphicon-ok">
                            </span><em>  ~  {{ Session::get('flash_message') }}</em>
                        </div>
                        @endif
						@foreach($data as $r)
						<div class="col-xl-4 col-md-6">
							<div class="widget widget-stats bg-blue">
								<div class="stats-icon"><i class="fa fa-home"></i></div>
								<div class="stats-info">
									<h4>{{ ucfirst($r->nama)}}</h4>
									<p>{{ number_format($r->tunit) }} Unit</p>	
								</div>
								<div class="stats-link">
									<a href="{{ url('cicilan/listall/'.$r->id) }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
								</div>
							</div>
						</div>
						@endforeach
                        
                    </div>
                    <!-- end col-9 --> 

                    <div class="col-lg-4">
                        <!-- begin panel -->
                        <div class="panel p-20">
                            <h5 class="m-t-0">Quick Search</h5>
                            <form class="form-input-flat" method="POST" action="{{url('cicilan/tagihan')}}">
                                {{ csrf_field() }}
                                <div class="input-group m-b-15">
                                    <input type="text" name="kode" id="cari" class="form-control" placeholder="Enter keywords..." />
                                    <div id="tampil">
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                    
                                    
                                </div>
                            </form> 
                            
                            <div class="horizontal-divider m-0 m-b-15"></div> 
                             
                        </div>
                        <!-- end panel -->
                    </div>
                    <!-- end col-3 -->
                <!-- end col-3 --> 

                     
                </div>
                <!-- end row -->
            </div>
            <!-- end section-container -->
            @stop            
@section('scripts')
<!-- ================== BEGIN PAGE LEVEL JS ================== -->   
<script src="{{ asset("js/demo.min.js") }}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script>
 
 
<script type="text/javascript">

    $(document).ready(function(){

        $('#cari').keyup(function(){ 
                var query = $(this).val();
                if(query.length >3)
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ url('konsumen/autocomplete') }}",
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
            });  

    });


</script>

@stop 
