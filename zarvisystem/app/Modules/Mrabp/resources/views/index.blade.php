@extends('admin.layout')

@section('styles') 
@stop
@section('content')

            <h1 class="page-header"> List  <small>Perumahan</small></h1>
            <!-- begin section-container -->
            <div class="section-container section-with-top-border p-b-5">
            <!-- begin row -->
                <div class="row">
                    <!-- begin col-9 -->
                    <div class="col-lg-8">
                        <!-- begin gallery-list -->
						@foreach($data as $r)
						<div class="col-xl-4 col-md-6">
							<div class="widget widget-stats bg-blue">
								<div class="stats-icon"><i class="fa fa-home"></i></div>
								<div class="stats-info">
									<h4>{{ ucfirst($r->nama)}}</h4>
									<p>{{ number_format($r->tunit) }} Rab</p>	
								</div>
								<div class="stats-link">
									<a href="{{ url('mrabp/data/'.$r->id) }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
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
  
@stop 
