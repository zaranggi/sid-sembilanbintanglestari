@extends('admin.layout')

@section('styles') 
@stop
@section('content')

            <h1 class="page-header"> Dokumen <small>Legalitas</small></h1>
            <!-- begin section-container -->
            <div class="section-container section-with-top-border p-b-5">
            <!-- begin row -->
                <div class="row">
                    <!-- begin col-9 -->
                    <div class="col-lg-12">
                        <div class="row">
                            @foreach($data as $r)
                            <div class="col-xl-5 col-md-5">
                                <div class="widget widget-stats bg-blue">
                                    <div class="stats-icon"><i class="fa fa-home"></i></div>
                                    <div class="stats-info">
                                        <h4>{{ ucfirst($r->nama)}}</h4>
                                        <br/>
                                        <br/>
                                        <small>{{ ucfirst($r->alamat) }} Unit</small>	
                                    </div>
                                    <div class="stats-link">
                                        <a href="{{ url('legalformal/data/'.$r->id) }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div> 
                    </div>
                    <!-- end col-9 -->  
                     
                </div>
                <!-- end row -->
            </div>
            <!-- end section-container -->
            @stop            
@section('scripts')
 
 
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
