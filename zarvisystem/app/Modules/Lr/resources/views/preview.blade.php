@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
 
@stop
@section('content') 
    <h1 class="page-header">Laporan <small>Laba Rugi</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" >
                <!-- begin panel-heading -->
                <div class="panel-heading">
                <h4 class="panel-title">Periode : {{ App\Helpers\Tanggal::tgl_indo($xtanggal1) }} - {{ App\Helpers\Tanggal::tgl_indo($xtanggal2) }}</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                     
                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
						<div class="alert alert-info ">
						  <h3 class="text-center">LAPORAN LABA/RUGI<br/></h3>
						  <h4 class="text-center">PT. SEMBILAN BINTANG LESTARI<br/></h4>
						  <h6 class="panel-title text-center">Periode : {{ App\Helpers\Tanggal::tgl_indo($xtanggal1) }} - {{ App\Helpers\Tanggal::tgl_indo($xtanggal2) }}</h6>
						  
                        </div>
					
					
                        <div class="table-responsive">
                            <table class="table table-bordered table-invoice non-pre">
                                <thead> 
                                </thead>
                                <tbody>
                                    <?php 
									$total_labakotor = 0;
									$total_beban = 0;
									$total_pajak = 0;
									foreach($komponen as $k){
										echo '<tr><td></td><td class="font-weight-bold text-info">'.$k->nama_akun."</td></tr>";
										foreach($klasifikasi[$k->id] as $kl){
											echo '<tr><td></td><td class="font-weight-bold text-warning" colspan="2">'.$kl->nama_akun."</td></tr>";										
											$tk_d = 0;
											$tk_k = 0;
											
												$subtk = 0;												
												foreach($akun[$k->id][$kl->id] as $ak){
													echo '<tr><td class="font-weight-bold text-center text-info">'.$ak->kode."</td><td>".$ak->nama_akun."</td>";													
													foreach($dtakun[$ak->kode] as $dak){
														if($ak->posting == "D"){
															$subtk += $dak->saldo;
														 
																echo "<td class='text-right'> ".number_format($dak->saldo)."</td></tr>";
															 
														}
														else{
															$subtk += $dak->saldo;
															echo "<td class='text-right'>".number_format($dak->saldo)."</td></tr>";
															
														}
													}													
												} 
												
												echo "<tr><td class='font-weight-bold text-center text-info' colspan='2'> Total </td><td class='font-weight-bold text-info text-right'> ".number_format($subtk)."</td></tr>";		
												if($kl->kode == 511){
													echo "<tr class='bg-lime'><td class='font-weight-bold text-center' colspan='2'> LABA/RUGI KOTOR </td><td class='font-weight-bold text-right'> ".number_format($total_labakotor - $subtk)."</td></tr>";			
												}elseif($kl->kode == 513){
													echo "<tr class='bg-warning'><td class='font-weight-bold text-center' colspan='2'>TOTAL BEBAN NON PRODUKSI </td><td class='font-weight-bold text-right'> ".number_format($total_labakotor - $subtk)."</td></tr>";			
												}
											 
										}
										
										if($k->id == 4){
											
											foreach($xlabakotor as $lbktr)
											{
												$total_labakotor = $lbktr->labakotor;
												echo "<tr class='font-weight-bold bg-aqua'><td colspan='2'  class='text-center'> TOTAL PENDAPATAN </td><td class='text-right'> ".number_format($lbktr->labakotor)."</td></tr>";	
											}
										}

										if($k->id == 5){
											
											foreach($beban as $rbeban)
											{	
												$total_beban = $rbeban->beban;
												
											}
										}
										if($k->id == 6){
											
											foreach($pajak as $rpajak)
											{
												$total_pajak = $rpajak->pajak;
											}
										}
									 
									}
									echo "<tr class='font-weight-bold bg-lime'><td colspan='2' class='text-center'> LABA / RUGI </td>
									<td class='text-right'> ".number_format( $total_labakotor - ($total_beban + $total_pajak))."</td></tr>";
															
								?>
															
                                    
                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <!-- end table-responsive -->
                </div>
                <!-- end panel-body -->
            </div>
        </div>
    </div>

    @stop 
	
    @section('scripts')
    <script src="{{ asset('plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/extensions/Select/js/dataTables.select.min.js') }}"></script> 
    <script src="{{ asset('js/page-table-manage-select.demo.min.js') }}"></script>
   
    <script type="text/javascript">
        $(document).ready(function() { 
            PageDemo.init(); 
        });
    </script>
     
    @stop
    