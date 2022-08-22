@extends('admin.layout')

@section('styles') 
@stop
@section('content')

            <h1 class="page-header"> Saldo Awal  <small>Keuangan</small></h1>
            <!-- begin section-container -->
            <div class="section-container section-with-top-border p-b-5">
            <!-- begin row -->
                <div class="row">
                    <!-- begin col-9 -->
                    <div class="col-lg-12"> 
                            
                        @foreach($data as $r)
                            <div class="col-xl-4 col-md-6">
                                <div class="widget widget-stats bg-blue">
                                    <div class="stats-icon"><i class="fa fa-chart-line"></i></div>
                                    <div class="stats-info">
                                        <h3>{{ ucfirst($r->nama)}}</h3> 
                                        <br/>
                                        <br/>
                                    </div>
                                    <div class="stats-link">
                                        <a href="{{ url('sldawal/tambah/'.$r->id) }}">Input Saldo Awal  <i class="fa fa-arrow-alt-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach 
                            
                    </div>
                    <!-- end col-9 --> 

                     
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

<script src="{{ asset('js/datadelete.js') }} "></script>
<script type="text/javascript">
    window.csrfToken = '<?php echo csrf_token(); ?>';
</script>
@stop 
