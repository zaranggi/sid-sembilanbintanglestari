@extends('admin.layout')

@section('styles')
@stop
@section('content')

            <h1 class="page-header"> Data Piutang  <small>Konsumen</small></h1>
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
									<a href="{{ url('tagkonsumen/listall/'.$r->id) }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
								</div>
							</div>
						</div>
						@endforeach

                    </div>
                    <!-- end col-9 -->

                    <!-- end col-3 -->
                <!-- end col-3 -->


                </div>
                <!-- end row -->
            </div>
            <!-- end section-container -->
            @stop
@section('scripts')

@stop
