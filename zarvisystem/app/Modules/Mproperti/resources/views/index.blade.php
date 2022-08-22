@extends('admin.layout')

@section('styles') 
@stop
@section('content')

            <h1 class="page-header"> Manage  <small>Properti</small></h1>
            <!-- begin section-container -->
            <div class="section-container section-with-top-border p-b-5">
            <!-- begin row -->
                <div class="row">
                    <!-- begin col-9 -->
                    <div class="col-lg-9">
						@foreach($data as $r)
						<div class="col-xl-4 col-md-6">
							<div class="widget widget-stats bg-blue">
								<div class="stats-icon"><i class="fa fa-home"></i></div>
								<div class="stats-info">
									<h4>{{ ucfirst($r->nama)}}</h4>
									<p>{{ number_format($r->tunit) }} Unit</p>	
								</div>
								<div class="stats-link">
									<a href="{{ url('mproperti/'.$r->id.'/edit') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
								</div>
							</div>
						</div>
						@endforeach
                         
                    </div>
                    <!-- end col-9 -->

                     <!-- begin col-3 -->
                     <div class="col-lg-3">
                        <!-- begin panel -->
                        <div class="panel p-20">
                            <h5 class="m-t-0">Tambah Data Properti</h5>
                             
                            <div class="horizontal-divider m-0 m-b-15"></div> 
                            <div class="text-center">
                            <a href="{{ url('mproperti/create')}}" class="btn btn-rounded btn-info btn-sm"><i class="fa fa-plus"></i> Add new data</a>
                            </div>
                        </div>
                        <!-- end panel -->
                    </div>
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

<script src="{{ asset('js/datadelete.js') }} "></script>
<script type="text/javascript">
    window.csrfToken = '<?php echo csrf_token(); ?>';
</script>
@stop 
