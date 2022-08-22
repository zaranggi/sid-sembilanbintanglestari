@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />

<link href="{{ asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/bootstrap-tagsinput/bootstrap-tagsinput.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/jquery-tag-it/css/jquery.tagit.css")}}" rel="stylesheet" />
<link href="{{ asset("plugins/select2/dist/css/select2.min.css")}}" rel="stylesheet" /> 
@stop
@section('content')


    <h1 class="page-header">RAB <small>Pembangunan Rumah </small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">
					@foreach($properti as $rp)
					{{ $rp->nama_properti   }} - Tipe : {{ $tipe_unit}}  </h4>
					@endforeach
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">                    
 
				 
					<h4 class="panel-title mb-15">RAB Pekerjaan</h4>
					
					 <div class="border-top my-3"></div>

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover ">
                            <thead>
                                <tr class="text-center text-nowrap"> 
                                    <th>No</th>  
                                    <th>Pekerjaan</th> 
                                    <th>Volume</th> 
                                    <th>Satuan</th> 
                                    <th>Harga</th> 
                                    <th>Total</th>   
                                </tr>

                            </thead>
                             <tbody>
                                @php 
								$no=1; 
								$gross=0;
								@endphp
                        @foreach($data as $r)

                            <tr>
                                <td class="text-center ">{{ $no }}</td>
                                <td class="text-left text-nowrap">{{ $r->nama_spk }}</td> 
                                <td class="text-right text-nowrap">{{ number_format($r->qty) }}</td> 
                                <td class="text-center text-nowrap">{{ $r->satuan }}</td> 
                                <td class="text-center text-nowrap">{{ number_format($r->price) }}</td> 
                                <td class="text-right text-nowrap">{{ number_format($r->gross) }}</td>  
                                 
                            </tr>
							@php 
								$no++;
								$gross += $r->gross;
							@endphp
                            
                        @endforeach 

                            </tbody>
							<tfoot>
								<tr class="text-center font-weight-bold">
									<td colspan="5">Grand Total</td>
									<td class="text-right">{{number_format($gross)}}</td>
								</tr>
							</tfoot>

                        </table>

						</div>
					</div>
					<br/>
					<h4 class="panel-title">RAB Material</h4>
					
					 <div class="border-top my-3"></div>


                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover ">
                            <thead>
                                <tr class="text-center text-nowrap"> 
                                    <th>No</th>  
                                    <th>Nama Material</th> 
                                    <th>Volume</th> 
                                    <th>Satuan</th> 
                                    <th>Harga</th> 
                                    <th>Total</th>   
                                </tr>

                            </thead>
                             <tbody>
                                @php 
								$no=1; 
								$gross=0;
								@endphp
                        @foreach($material as $r)

                            <tr>
                                <td class="text-center ">{{ $no }}</td>
                                <td class="text-left text-nowrap">{{ $r->prdcd }} - {{ $r->nama }}</td> 
                                <td class="text-right text-nowrap">{{ number_format($r->qty) }}</td> 
                                <td class="text-center text-nowrap">{{ $r->satuan }}</td> 
                                <td class="text-center text-nowrap">{{ number_format($r->price) }}</td> 
                                <td class="text-center text-nowrap">{{ number_format($r->gross) }}</td>  
                                 
                            </tr>
							@php 
								$no++;
								$gross += $r->gross;
							@endphp
                            
                        @endforeach 

                            </tbody>
							<tfoot>
								<tr class="text-center font-weight-bold">
									<td colspan="5">Grand Total</td>
									<td>{{number_format($gross)}}</td>
								</tr>
							</tfoot>

                        </table>

						</div>
					</div>
				<!-- end table -->
				
					<br/>
				<h4 class="panel-title">Detail Pekerjaan</h4>
					
					 <div class="border-top my-3"></div>


                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover ">
                            <thead>
                                <tr class="text-center text-nowrap"> 
                                    <th>No</th>  
                                    <th>List Pekerjaan</th> 
                                </tr>

                            </thead>
                             <tbody>
                                @php 
								$no=1; 
								$gross=0;
								@endphp
                        @foreach($data as $r)
							<tr class="font-weight-bold text-info">
                                <td class="text-center ">{{ $no }}</td>
                                <td class="text-left text-nowrap">{{ $r->nama_spk }}</td>   
                                 
                            </tr>
							
                                    @foreach($setjob as $rx)
										@if(in_array($rx->id, $list_select[$r->id]))
                                        <tr>
											<td class="text-center "></td>
											<td class="text-left text-nowrap">- {{ $rx->nama }}</td>   
											 
										</tr>
										@endif
										 
                                    @endforeach 
                            
								@php 
									$no++; 
								@endphp
                            
                        @endforeach 

                            </tbody>


                        </table>

						</div>
					</div>
				<!-- end table -->
				
					<br/>
				<h4 class="panel-title ">Termin SPK</h4>
					
					 <div class="border-top my-3"></div>

                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover ">
                            <thead>
                                <tr class="text-center text-nowrap"> 
                                    <th>No</th>  
                                    <th>Pekerjaan</th> 
                                    <th>Termin 1</th>  
                                    <th>Termin 2</th>  
                                    <th>Termin 3</th>  
                                    <th>Termin 4</th>  
                                    <th>Termin 5</th>    
                                    <th>Retensi</th>     
                                    <th>Total</th>    
                                </tr>

                            </thead>
                             <tbody>
                                @php 
								$no=1;  
								@endphp
                        @foreach($data as $r)
								 
                            <tr>
                                <td class="text-center ">{{ $no }}</td>
                                <td class="text-left text-info text-nowrap font-weight-bold">{{ $r->nama_spk }}</td> 
                                <td class="text-right text-nowrap">{{ $r->t1 > 0 ? number_format($r->t1,2)."%" : ""  }}</td>   
                                <td class="text-right text-nowrap">{{ $r->t2 > 0 ? number_format($r->t2,2)."%" : ""  }}</td>   
                                <td class="text-right text-nowrap">{{ $r->t3 > 0 ? number_format($r->t3,2)."%" : ""  }}</td>   
                                <td class="text-right text-nowrap">{{ $r->t4 > 0 ? number_format($r->t4,2)."%" : ""  }}</td>   
                                <td class="text-right text-nowrap">{{ $r->t5 > 0 ? number_format($r->t5,2)."%" : ""  }}</td>    
                                <td class="text-right text-nowrap">{{ number_format($r->retensi,2) }}%</td>    
                                <td class="text-right font-weight-bold text-info text-nowrap">
								{{ number_format($r->t1 + $r->t2 + $r->t3 + $r->t4 + $r->t5 + $r->retensi,2) }}%
								</td>    
                                 
                            </tr>
							@php 
								$no++;
								 
							@endphp
                            
                        @endforeach 

                            </tbody>
							 
                        </table>

						</div>
					</div>
				
            </div>
            <!-- end panel-body -->
            </div>
        </div>
    </div>
 
    <!-- /basic initialization --> 
@stop 
@section('scripts')
<script src="{{ asset("plugins/DataTables/media/js/jquery.dataTables.js") }}"></script>
<script src="{{ asset("plugins/DataTables/media/js/dataTables.bootstrap.min.js") }}"></script>
<script src="{{ asset("plugins/DataTables/extensions/Select/js/dataTables.select.min.js") }}"></script> 
<script src="{{ asset("js/page-table-manage-select.demo.min.js") }}"></script> 
<!-- ================== END PAGE LEVEL JS ================== -->
<script src="{{ asset('js/jquery.number.js') }}"></script>  
<script src="{{ asset('plugins/bootstrap-daterangepicker/moment.js') }}"></script>

<script type="text/javascript"> 
    $('.nomor').number(true, 0, '.', ',');
    $('.rupiah').number(true, 0,);
</script>

<script>
    $(document).ready(function() { 
        PageDemo.init();
    });
</script> 
 

@stop


