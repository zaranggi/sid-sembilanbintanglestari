<?php

namespace App\Modules\Realisasi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Realisasi\Models\Realisasi; 
use App\Modules\Realisasi\Models\Realisasi2; 
use App\Modules\Konsumen\Models\Konsumen; 
use App\Modules\Trxkonsumen\Models\Trxkonsumen; 
use App\Modules\Trxkonsumen\Models\Konsumenlog; 

use App\Modules\Jurnalumum\Models\Jurnalumum;
use App\Modules\Jurnalumum\Models\Jurnalumumd;
use App\Modules\Munit\Models\Munit;
use App\Modules\Mproperti\Models\Mproperti;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

class RealisasiController extends Controller
{
      /**
  * Display a listing of the resource.
  *
  * @param Realisasi $data
  */

 public function __construct(Realisasi $data)
 {
     $this->data = $data;
 }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        
       $data = $this->data->dataall();
       return view('Realisasi::index',['data' => $data]); 
    }
  
  
   /**
    * Show the form for editing the specified resource.
    * @param int $id
    * @return Response
    */
   public function edit($id)
   {
	   $r = Trxkonsumen::findOrFail($id);
       $data =  $this->data->datasatu($id);
       $realisasi =  $this->data->realisasi($id);
       $bpembangunan = $this->data->bpembangunan($r->id_properti,$r->id_kav);
       $brevisi = $this->data->brevisi($r->id_properti,$r->id_kav);
       $bmaterial = $this->data->bmaterial($r->id_properti,$r->id_kav);
       $konsumen_bayar = $this->data->konsumen_bayar($id);
	   
       $bank = $this->data->listbank();
       $bank_pt = $this->data->bank_pt();
	   
       return view('Realisasi::edit', ['realisasi' => $realisasi, 
										'bpembangunan' => $bpembangunan,
										'brevisi' => $brevisi,
										'bmaterial' => $bmaterial,
										'konsumen_bayar' => $konsumen_bayar,
                                        'bank' => $bank,
										'bank_pt' => $bank_pt])->with('data', $data) ;
   }

   /**
    * Update the specified resource in storage.
    * @param Request $request
    * @param int $id
    * @return Response
    */
   public function store(Request $request)
   {
      $rules = array( 
            'id_spr' => 'required',
            'tanggal' => 'required', 
            'gross' => 'required', 
            'bank_pt' => 'required', 
           );

       
       $validator = Validator::make($request->all(), $rules);
       
       $id = $request->input("id_spr");

       if ($validator->fails()) {
           
            return Redirect::to('realisasi/'.$id.'/edit')->withErrors($validator)->withInput();

       } else {
           
            $spr =  Trxkonsumen::findOrfail($request->input("id_spr"));
			
			$data_kon = $spr;
			$mproperti = Mproperti::findOrFail($data_kon->id_properti);
			$munit = Munit::findOrFail($data_kon->id_kav);
			
			$ket_jurnal = "Pendapatan Realisasi :: ".$mproperti->nama." Kav ".$munit->nama;
			
			$ppju = $request->input("tanggal");
			$noUrutAkhir = Jurnalumum::max('id');
			$kode = "JU-".substr($ppju,2,2).substr($ppju,5,2).substr($ppju,8,2)."-".sprintf("%04s", $noUrutAkhir + 1);
			$gross = str_replace(",","",$request->input("gross"));			
 
            $cek = $this->data->cekreal($id);
                foreach($cek as $rcek){

                } 
            
           if(count($cek) == 0){
                if(str_replace(",","",$request->input("gross")) <= $spr->sp3k_nominal){
                    $data = new Realisasi; 
                    $data->id_spr = $request->input("id_spr"); 
                    $data->tanggal_realisasi = $request->input("tanggal"); 
                    $data->total_kpr = $spr->sp3k_nominal;     
                    $data->terbayar = $data->terbayar + str_replace(",","",$request->input("gross"));   
                    $data->dana_ditahan = $data->total_kpr - ($data->terbayar);
                    $data->total =  $spr->gross_total;
                    if( $data->terbayar  >= $data->total_kpr  ){
                        $data->status = "LUNAS";     
                    }else{
                        $data->status = "BELUM LUNAS";     
                    }
                    $data->keterangan =  $request->input("keterangan"); 
                    $data->tipe_pembayaran = "Transfer"; 
                    $data->bank = $request->input("bank_pengirim"); 
                    $data->norek_pengirim = $request->input("norek_pengirim"); 
                    $data->nama_rekening_pengirim = $request->input("nama_rekening_pengirim");  
                    $data->created_by = Auth::user()->name;    
                    $data->save();

                    $data = new Realisasi2; 
                    $data->id_spr = $request->input("id_spr"); 
                    $data->bank_pt = $request->input("id_bank"); 
                    $data->bank = $request->input("bank_pengirim"); 
                    $data->tanggal_realisasi = $request->input("tanggal");            
                    $data->nominal = str_replace(",","",$request->input("gross"));
                    $data->tipe_pembayaran = "Transfer"; 
                    $data->keterangan = $request->input("keterangan"); 
                    $data->created_by = Auth::user()->name;          
                    $data->save();  
					
					 //=================START INSER JURNAL UMUM=================================== 
					$data_jurnal = new Jurnalumum;
					$data_jurnal->id_properti 	= $data_kon->id_properti;
					$data_jurnal->nomor 	    = $kode;
					$data_jurnal->tanggal 		= $request->input("tanggal");
					$data_jurnal->keterangan 	= $ket_jurnal;
					$data_jurnal->created_by 	= Auth::user()->name;
					$data_jurnal->jenis 		= "J";
					$data_jurnal->posting 		= "Y";                
					$data_jurnal->save(); 
					 
					$id_akun =  $request->input("bank_pt"); 
					 
					//insert Jurnalnya
					$pend_dimuka =0;
					$piutang =0;
					$b_a =0;
					$b_b =0;
					$b_c =0;
					
					if($data_kon->isreal == "0"){ 
							
						/* Cek Pendapatan Diterima Dimuka */
						$bpembangunan = $this->data->bpembangunan($data_kon->id_properti,$data_kon->id_kav);
						$brevisi = $this->data->brevisi($data_kon->id_properti,$data_kon->id_kav);
						$bmaterial = $this->data->bmaterial($data_kon->id_properti,$data_kon->id_kav);
						$konsumen_bayar = $this->data->konsumen_bayar($data_kon->id);
						
						// Pendapatan Diterima Dimuka 
						foreach($konsumen_bayar as $za){
							$pend_dimuka = $za->bayar1+$za->bayar2+$za->bayar3+$za->bayar4+$za->bayar5+$za->bayar6+$za->bayar7;
							$piutang = ($za->tagihan1+$za->tagihan2+$za->tagihan3+$za->tagihan4+$za->tagihan5+$za->tagihan6+$za->tagihan7) - ($za->bayar1+$za->bayar2+$za->bayar3+$za->bayar4+$za->bayar5+$za->bayar6+$za->bayar7);
						}
						// HPP
						foreach($bpembangunan as $za){
							$b_a = $za->jumlah_bayar; 
						}
						foreach($brevisi as $za){
							$b_b = $za->jumlah_bayar_rev; 
						}
						foreach($bmaterial as $za){
							$b_c = $za->biaya_material; 
						}
						
						$total_hpp = $b_a + $b_b + $b_c + $munit->hpp_bangunan + ($munit->hpp_tanah * $data_kon->luas_penambahan_tanah);
						$total_piutang_prod = $b_a + $b_b + $b_c ;
						/*================= Debit ============== */
						/*====================================== */
							// Akun Penerimaan Bank PT
							$u = new Jurnalumumd;
							$u->id_jurnal 	= $data_jurnal->id;
							$u->id_akun 	    = $id_akun;
							$u->jenis 		= "J";
							$u->tanggal 		= $request->input("tanggal");
							$u->keterangan 	= $ket_jurnal;
							$u->debit    	= $gross;
							$u->kredit   	= 0;
							$u->posting 		= "Y";  
							$u->created_by 	= Auth::user()->name;                  
							$u->save();
							
							// 41203 - Pendapatan Diterima Di muka
							$u = new Jurnalumumd;
							$u->id_jurnal 	= $data_jurnal->id;
							$u->id_akun 	= 41203;
							$u->jenis 		= "J";
							$u->tanggal 	= $request->input("tanggal");
							$u->keterangan 	= $ket_jurnal;
							$u->debit    	= 0;
							$u->kredit   	= $pend_dimuka;
							$u->posting 	= "Y";  
							$u->created_by 	= Auth::user()->name;                  
							$u->save();
							
							if($piutang > 0){								
								// 11111 - Piutang Usaha
								$u = new Jurnalumumd;
								$u->id_jurnal 	= $data_jurnal->id;
								$u->id_akun     = 11111;
								$u->jenis 		= "J";
								$u->tanggal 	= $request->input("tanggal");
								$u->keterangan 	= "Piutang Usaha";
								$u->debit    	= 0;
								$u->kredit   	= $piutang;
								$u->posting 	= "Y";  
								$u->created_by 	= Auth::user()->name;                  
								$u->save(); 							
							}
							
							if( ($data_kon->realisasi_rp - $gross) > 0){
								// 11113 - Piutang KPR 
								$u = new Jurnalumumd;
								$u->id_jurnal 	= $data_jurnal->id;
								$u->id_akun     = 11111;
								$u->jenis 		= "J";
								$u->tanggal 	= $request->input("tanggal");
								$u->keterangan 	= "Dana Ditahan (KPR)";
								$u->debit    	= $data_kon->realisasi_rp - $gross;
								$u->kredit   	= 0;
								$u->posting 	= "Y";  
								$u->created_by 	= Auth::user()->name;                  
								$u->save();
							}
							
							// 41109 - Harga Pokok Penjualan
							$u = new Jurnalumumd;
							$u->id_jurnal 	= $data_jurnal->id;
							$u->id_akun     = 41109;
							$u->jenis 		= "J";
							$u->tanggal 	= $request->input("tanggal");
							$u->keterangan 	= "Harga Pokok Penjualan";
							$u->debit    	= $total_hpp;
							$u->kredit   	= 0;
							$u->posting 	= "Y";  
							$u->created_by 	= Auth::user()->name;                  
							$u->save(); 
							
							
						/*================= Kredit ============== */
						/*====================================== */
							// 41101 - Penjualan Rumah
							$u = new Jurnalumumd;
							$u->id_jurnal 	= $data_jurnal->id;
							$u->id_akun     = 41101;
							$u->jenis 		= "J";
							$u->tanggal 	= $request->input("tanggal");
							$u->keterangan 	= "Pendapatan Penjualan Rumah";
							$u->debit    	= 0;
							$u->kredit   	= $data_kon->gross_unit;
							$u->posting 	= "Y";  
							$u->created_by 	= Auth::user()->name;                  
							$u->save();  
							
							if($data_kon->gross_penambahan_tanah){
							// 41103 - Penjualan Kelebihan Tanah
								$u = new Jurnalumumd;
								$u->id_jurnal 	= $data_jurnal->id;
								$u->id_akun     = 41103;
								$u->jenis 		= "J";
								$u->tanggal 	= $request->input("tanggal");
								$u->keterangan 	= "Penjualan Kelebihan Tanah";
								$u->debit    	= 0;
								$u->kredit   	= $data_kon->gross_penambahan_tanah;
								$u->posting 	= "Y";  
								$u->created_by 	= Auth::user()->name;                  
								$u->save();
							}								
							
							if($data_kon->gross_penambahan_lain > 0){								
								// 41105 - Pendapatan Tambahan Bangunan
								$u = new Jurnalumumd;
								$u->id_jurnal 	= $data_jurnal->id;
								$u->id_akun     = 41105;
								$u->jenis 		= "J";
								$u->tanggal 	= $request->input("tanggal");
								$u->keterangan 	= "Pendapatan Tambahan Bangunan";
								$u->debit    	= 0;
								$u->kredit   	= $data_kon->gross_penambahan_lain;
								$u->posting 	= "Y";  
								$u->created_by 	= Auth::user()->name;                  
								$u->save(); 							
							}
							
							// 11112 - Piutang Produksi
							$u = new Jurnalumumd;
							$u->id_jurnal 	= $data_jurnal->id;
							$u->id_akun     = 11112;
							$u->jenis 		= "J";
							$u->tanggal 	= $request->input("tanggal");
							$u->keterangan 	= "Piutang Produksi";
							$u->debit    	= 0;
							$u->kredit   	= $total_piutang_prod;
							$u->posting 	= "Y";  
							$u->created_by 	= Auth::user()->name;                  
							$u->save(); 
							
							// 11117 - Persediaan Tanah
							$u = new Jurnalumumd;
							$u->id_jurnal 	= $data_jurnal->id;
							$u->id_akun     = 11117;
							$u->jenis 		= "J";
							$u->tanggal 	= $request->input("tanggal");
							$u->keterangan 	= "Pemakaian Persediaan Tanah";
							$u->debit    	= 0;
							$u->kredit   	= ($munit->hpp_tanah * $data_kon->luas_penambahan_tanah);
							$u->posting 	= "Y";  
							$u->created_by 	= Auth::user()->name;                  
							$u->save();
							
							// 11118 - Persediaan Unit Rumah
							$u = new Jurnalumumd;
							$u->id_jurnal 	= $data_jurnal->id;
							$u->id_akun     = 11118;
							$u->jenis 		= "J";
							$u->tanggal 	= $request->input("tanggal");
							$u->keterangan 	= "Pemakaian Persediaan Tanah";
							$u->debit    	= 0;
							$u->kredit   	= ($munit->hpp_bangunan);
							$u->posting 	= "Y";  
							$u->created_by 	= Auth::user()->name;                  
							$u->save();
						

							$spr->isreal = 1;
							$spr->save();
							 
					} 
					//=================END Insert Jurnal =================================== 
                    
                    Session::flash('flash_message', 'Data Berhasil Disimpan!');
                    

                }else{
                    Session::flash('flash_message', 'Realisasi Tidak Bole Melebihi SP3K!');
                    
                }
                
           }else{
                $u =  Realisasi::findOrfail($rcek->id);
                if(($u->terbayar + str_replace(",","",$request->input("gross"))) <= $spr->sp3k_nominal){
                    if(($u->terbayar + str_replace(",","",$request->input("gross")))  >= $u->total_kpr ){
                        $status = "LUNAS";     
                    }else{
                        $status = "BELUM LUNAS";     
                    }

                    $update = DB::table('realisasi_kpr')
                            ->where('id_spr', $id)
                            ->update([
                                'tipe_pembayaran' => "Transfer",
                                'bank' => $request->input("bank_pengirim"),
                                'total_kpr' => $spr->sp3k_nominal,     
                                'terbayar' => $u->terbayar + str_replace(",","",$request->input("gross")),   
                                'dana_ditahan' => $u->total_kpr - ( $u->terbayar + str_replace(",","",$request->input("gross"))),
                                'status' =>  $status,
                                'keterangan' =>  $request->input("keterangan"),
                                'created_by' => Auth::user()->name    
                            ]);

                    $data = new Realisasi2; 
                    $data->id_spr = $request->input("id_spr"); 
                    $data->bank_pt = $request->input("id_bank"); 
                    $data->bank = $request->input("bank_pengirim"); 
                    $data->tanggal_realisasi = $request->input("tanggal");            
                    $data->nominal = str_replace(",","",$request->input("gross"));
                    $data->tipe_pembayaran = "Transfer"; 
                    $data->keterangan = $request->input("keterangan"); 
                    $data->created_by = Auth::user()->name;          
                    $data->save(); 
  
                    Session::flash('flash_message', 'Data Berhasil Disimpan!');
                     
                }else{
                    Session::flash('flash_message', 'Realisasi Tidak Bole Melebihi SP3K!');  
                }     
           }
		   /* ================================== */
		    
		   
		   return redirect('realisasi/'.$id.'/edit'); 
           
           
            
       }
   }

   /**
    * Remove the specified resource from storage.
    * @param int $id
    * @return Response
    
   public function destroy($id)
   {
       $users = Realisasi::findOrFail($id);
       //$users->delete();
       Session::flash('flash_message', 'Data has ben successful Deleted!');

       return redirect('realisasi');
   }*/

   public function listunit(Request $request)
   {
       $data = $this->data->listunit($request->id);
       return response()->json($data);

   }

   public function unitdetail(Request $request)
   {
       $id = $request->input("query");
       
       $data = $this->data->unitdetail($id);
       return response()->json($data);

   }
}
