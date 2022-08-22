@extends('admin.layout')

@section('styles') 
<link href="{{ asset("plugins/DataTables/media/css/dataTables.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Select/css/select.bootstrap.min.css") }}" rel="stylesheet" />
<link href="{{ asset("plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css") }}" rel="stylesheet" />
 
@stop
@section('content') 
    <h1 class="page-header">Laporan <small>Neraca</small></h1>
    
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" >
                <!-- begin panel-heading -->
                <div class="panel-heading">
                <h4 class="panel-title">Periode : {{ App\Helpers\Tanggal::tgl_indo($periode) }}</h4>
                    
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                     
                    <!-- begin table-responsive -->
                    <div class="panel pagination-grey clearfix m-b-0">
						<div class="alert alert-info ">
						  <h3 class="text-center">
						  LAPORAN NERACA<br/>
						  </h3>
						  <h4 class="text-center">PT. SEMBILAN BINTANG LESTARI<br/></h4>
						  <h6 class="text-center">Periode : {{ App\Helpers\Tanggal::tgl_indo($periode) }}<br/></h6>
						  
                        </div>
					
					
                        <div class="table-responsive">
                            <table class="table table-invoice non-pre">
                                
                                <tbody>
                                    <?php 									
									foreach($komponen as $k){
										if($k->id == 1){
											 
											$tkom = 0;
											echo '<tr><td></td><td class="font-weight-bold text-info">'.$k->nama_akun."</td></tr>";
											foreach($klasifikasi[$k->id] as $kl){
												echo '<tr><td></td><td class="font-weight-bold text-warning" colspan="2">'.$kl->nama_akun."</td></tr>";										
												
												$subtk = 0;
												
												foreach($akun[$k->id][$kl->id] as $ak){
													echo '<tr><td class="font-weight-bold text-center text-info">'.$ak->kode."</td><td>".$ak->nama_akun."</td>";
													
													foreach($dtakun[$ak->kode] as $dak){
														 
														if($ak->posting == "D"){
															$subtk += $dak->saldo;	
															echo "<td class='text-right'>Rp ".number_format($dak->saldo)."</td></tr>";
														}else{
															$subtk -= $dak->saldo;
															echo "<td class='text-right'>(Rp ".number_format($dak->saldo).")</td></tr>";
														}
													}												
												} 
												
												echo "<tr><td class='font-weight-bold text-center text-info' colspan='2'> Total </td><td class='font-weight-bold text-info text-right'> Rp ".number_format($subtk)."</td></tr>";		
												$tkom += $subtk;
											
											}
												
											echo "<tr class='font-weight-bold bg-lime'><td colspan='2' class='text-center'> Grand Total ".$k->nama_akun."</td>
											<td class='text-right'>Rp ".number_format($tkom)."</td></tr>
											";
										}elseif($k->id == 2){
											
											$tkom = 0;
											echo '<tr><td></td><td class="font-weight-bold text-info">'.$k->nama_akun."</td></tr>";
											foreach($klasifikasi[$k->id] as $kl){
												echo '<tr><td></td><td class="font-weight-bold text-warning" colspan="2">'.$kl->nama_akun."</td></tr>";										
												
												$subtk = 0;
												
												foreach($akun[$k->id][$kl->id] as $ak){
													echo '<tr><td class="font-weight-bold text-center text-info">'.$ak->kode."</td><td>".$ak->nama_akun."</td>";
													
													foreach($dtakun[$ak->kode] as $dak){
													
															$subtk += $dak->saldo;	
															echo "<td class='text-right'>Rp ".number_format($dak->saldo)."</td></tr>";
														 
													}												
												} 
												
												echo "<tr><td class='font-weight-bold text-center text-info' colspan='2'> Total </td><td class='font-weight-bold text-info text-right'> Rp ".number_format($subtk)."</td></tr>";		
												$tkom += $subtk;
											
											}
												
										}else{
											
											echo '<tr><td></td><td class="font-weight-bold text-info">'.$k->nama_akun."</td></tr>";
											foreach($klasifikasi[$k->id] as $kl){
												echo '<tr><td></td><td class="font-weight-bold text-warning" colspan="2">'.$kl->nama_akun."</td></tr>";										
												
												$subtk = 0;
												
												foreach($akun[$k->id][$kl->id] as $ak){
													
													echo '<tr><td class="font-weight-bold text-center text-info">'.$ak->kode."</td><td>".$ak->nama_akun."</td>";
													
													switch($ak->kode){
														default:
															foreach($dtakun[$ak->kode] as $dak){													
																$subtk += $dak->saldo;
																if($dak->saldo < 0){
																	echo "<td class='text-right'>(Rp ".number_format($dak->saldo * -1).")</td></tr>";
																}else{
																	echo "<td class='text-right'>Rp ".number_format($dak->saldo)."</td></tr>";
																}																
															}							
														break;
														
														case "31103":
															//Laba Ditahan
															$lbk_ditahan = 0;
															$bb_ditahan = 0;
															$pj_ditahan = 0;
															foreach($labakotor_ditahan as $nun){
																$lbk_ditahan = $nun->labakotor;
															}
															foreach($beban_ditahan as $nun){
																$bb_ditahan = $nun->beban;
															}
															foreach($pajak_ditahan as $nun){
																$pj_ditahan = $nun->pajak;
															}
															$laba_ditahan = $lbk_ditahan - ($bb_ditahan + $pj_ditahan);
															
															$subtk += $laba_ditahan;
															
															if($laba_ditahan < 0){
																echo "<td class='text-right'>(Rp ".number_format($laba_ditahan * -1).")</td></tr>";
															}else{
																echo "<td class='text-right'>Rp ".number_format($laba_ditahan)."</td></tr>";
															}
															
														break;
														
														case "31104":
															//Laba Periode Berjalan
															$lbk_berjalan = 0;
															$bb_berjalan = 0;
															$pj_berjalan = 0;
															foreach($labakotor as $nun){
																$lbk_berjalan = $nun->labakotor;
															}
															foreach($beban as $nun){
																$bb_berjalan = $nun->beban;
															}
															foreach($pajak as $nun){
																$pj_berjalan = $nun->pajak;
															}
																														
															$laba_berjalan = $lbk_berjalan- ($bb_berjalan + $pj_berjalan);
															
															$subtk += $laba_berjalan;
															
															if($laba_berjalan < 0){
																echo "<td class='text-right'>(Rp ".number_format($laba_berjalan * -1).")</td></tr>";
															}else{
																echo "<td class='text-right'>Rp ".number_format($laba_berjalan)."</td></tr>";
															}
															
														break;
														
													}
																								
												} 
												
												echo "<tr><td class='font-weight-bold text-center text-info' colspan='2'> Total </td><td class='font-weight-bold text-info text-right'> Rp ".number_format($subtk)."</td></tr>";		
												$tkom += $subtk;
											
											}
												
											echo "<tr class='font-weight-bold bg-aqua'><td colspan='2' class='text-center'> Grand Total Pasiva</td>
											<td class='text-right'>Rp ".number_format($tkom)."</td></tr>
											";
										}
										
									}						
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
    