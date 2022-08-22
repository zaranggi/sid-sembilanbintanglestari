<?php

namespace App\Modules\Paysubkonr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Paysubkonr\Models\Paysubkonr; 
use App\Modules\Paysubkonr\Models\Terminapp; 
use App\Modules\Bank\Models\Bank;
use App\Modules\Paysubkonr\Models\Spk; 

use App\Modules\Pomaterial\Models\Tconst;
use App\Modules\Booking\Models\Mtran;


use App\Modules\Trxkonsumen\Models\Trxkonsumen;
use App\Modules\Jurnalumum\Models\Jurnalumum;
use App\Modules\Jurnalumum\Models\Jurnalumumd;
use App\Modules\Munit\Models\Munit;
use App\Modules\Mproperti\Models\Mproperti;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class PaysubkonrController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @param Mproperti $data
     */

    public function __construct(Paysubkonr $data)
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
        $bank_pt = Bank::All();
		$bank = $this->data->listbank();
        
        return view("Paysubkonr::index", ['data' => $data, 'bank_pt' => $bank_pt, 'bank' => $bank]); 
    }

     
    public function store(Request $request)
    {
        $rules = array(
            'id_termin' => 'required', 
            'tgl_bayar' => 'required', 
            'gross' => 'required',  
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) { 
            return Redirect::to('paysubkonr')->withErrors($validator)->withInput();  
        }
        else
        {
             
            $gross = str_replace(",","",$request->input('gross')); 
			$x = explode("-",$request->input("id_termin"));
			$id_termin = $x[0];
			$id_app = $x[1];
		 
            $menu = Paysubkonr::findOrFail($id_termin);
			if(($menu->nilai - $gross) == 0){
				
				$menu->tgl_bayar 	    = $request->input('tgl_bayar');
				$menu->tipe_pembayaran 	= $request->input('tipe_pembayaran');
				if($request->input('tipe_pembayaran') == "Transfer"){
					$menu->bank_penerima 	= $request->input('bank_penerima');
					$menu->norek_penerima 	= $request->input('norek_penerima');
					$menu->id_bank 			= $request->input('id_bank');	
				}
				$menu->jumlah_bayar     = $gross;
				$menu->keterangan 	    = $request->input('keterangan');
				
				$namafile = "";
				if ($request->hasFile('photo')) {
					$path ='image/buktibayar';
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}                
					$file = $request->file('photo');    
					$namafile = uniqid() . '_' . trim($file->getClientOriginalName());    
					$file->move($path, $namafile);
				}
				
				$menu->bukti = $namafile;
				$menu->save(); 
				
				$data = Spk::findOrFail($menu->id_spk);
				if($menu->termin == 6){
					$data->krgbayarret =  $data->krgbayarret - $gross;
					
				}	
				$data->krgbayar =  $data->krgbayar - $gross;
				$data->save();
				
				
				$u = Terminapp::findOrFail($id_app);
				$u->status = 4;
				$u->save();
				
				//=================Insert Mtran ===================================
					$const = Tconst::where("rkey","=","AP")->get();
					foreach($const as $r)
					{
						$docno = sprintf("%05s", $r->docno + 1);
					}
					
					$mt = new Mtran;
					$mt->kode 	        = "AP-".date("ymd")."-".$docno;
					$mt->rtype			= "AP";
					$mt->id_properti 	=  $menu->id_properti;
					$mt->id_kav 	    =  $menu->id_kav;
					$mt->tanggal 	        = $request->input('tanggal');
					$mt->pembayar 	    = Auth::user()->name;
					$mt->penerima 	    = $request->input('nama');
					$mt->tipe_pembayaran 	= $request->input('tipe_pembayaran');
					if($request->input('tipe_pembayaran') == "Transfer"){
						$mt->bank 	= $request->input('bank_pengirim');
						$mt->norek 	= $request->input('norek_pengirim');
						$mt->id_bank 			= $request->input('id_bank');	
					}				
					$mt->jumlah 	        = $gross;
					$mt->photo    	    = $namafile;
					$mt->keterangan 	    = $request->input('keterangan');
					$mt->save();
					
					$d = Tconst::findOrfail(8);
					$d->docno = $d->docno+1;
					$d->save();
					 
					
					//=================END Insert Mtran ===================================


					//=================START INSER JURNAL UMUM===================================

					$data_kon = Trxkonsumen::where("status_spr","=","1")
											->where("id_properti","=",$menu->id_properti)
											->where("kav","=",$menu->id_kav)
											->orderby("id","DESC")
											->take(1)
											->get();

					$mproperti = Mproperti::findOrFail($menu->id_properti);
					$munit = Munit::findOrFail($menu->id_kav);
					
					$ket_jurnal = "Pembayaran Pembangunan Unit :: ".$mproperti->nama." Kav ".$munit->nama;
					
					$ppju = $request->input("tanggal");
					$noUrutAkhir = Jurnalumum::max('id');
					$kode = "JU-".substr($ppju,2,2).substr($ppju,5,2).substr($ppju,8,2)."-".sprintf("%04s", $noUrutAkhir + 1); 
	
					$data_jurnal = new Jurnalumum;
					$data_jurnal->id_properti 	= $data->id_properti;
					$data_jurnal->nomor 	    = $kode;
					$data_jurnal->tanggal 		= $request->input("tanggal");
					$data_jurnal->keterangan 	= $ket_jurnal;
					$data_jurnal->created_by 	= Auth::user()->name;
					$data_jurnal->jenis 		= "J";
					$data_jurnal->posting 		= "Y";                
					$data_jurnal->save(); 
					
					if($request->input("tipe_pembayaran") == "Cash"){
						$id_akun = "11101";
					}else{
						$b = Bank::findOrFail($request->input("id_bank"));
						$id_akun = $b->acc_kode;
					} 
					//insert Jurnalnya
					if($data_kon->isreal == "1"){ 
						/* Jika KPR sudah Real
							 KPR sudah Real
								Piutang Produksi 11112 (K)
									Kas/Bank (D)
								Hpp
									Piutang Produksi
						*/  
							//======= Debit ======== 
							// 11112 - Piutang Produksi
								$u = new Jurnalumumd;
								$u->id_jurnal 	= $data_jurnal->id;
								$u->id_akun 	    = 11112;
								$u->jenis 		= "J";
								$u->tanggal 		= $request->input("tanggal");
								$u->keterangan 	= $ket_jurnal;
								$u->debit    	= $gross;
								$u->kredit   	= 0;
								$u->posting 		= "Y";  
								$u->created_by 	= Auth::user()->name;                  
								$u->save(); 								
								
							//======= Kredit ======== 
								//Kas  / Bank
								$u = new Jurnalumumd;
								$u->id_jurnal 	= $data_jurnal->id;
								$u->id_akun 	    = $id_akun;
								$u->jenis 		= "J";
								$u->tanggal 		= $request->input("tanggal");
								$u->keterangan 	= $ket_jurnal;
								$u->debit    	= 0;
								$u->kredit   	= $gross;
								$u->posting 		= "Y";  
								$u->created_by 	= Auth::user()->name;                  
								$u->save();
							
							//======= Debit ======== 
								// 41109 - HPP
								$u = new Jurnalumumd;
								$u->id_jurnal 	= $data_jurnal->id;
								$u->id_akun 	    = 41109;
								$u->jenis 		= "J";
								$u->tanggal 		= $request->input("tanggal");
								$u->keterangan 	= $ket_jurnal;
								$u->debit    	=  $gross;
								$u->kredit   	= 0;
								$u->posting 		= "Y";  
								$u->created_by 	= Auth::user()->name;                  
								$u->save(); 								
									
							//======= Kredit ======== 
								//Piutang Produksi
								$u = new Jurnalumumd;
								$u->id_jurnal 	= $data_jurnal->id;
								$u->id_akun 	    = 11112;
								$u->jenis 		= "J";
								$u->tanggal 		= $request->input("tanggal");
								$u->keterangan 	= $ket_jurnal;
								$u->debit    	= 0;
								$u->kredit   	= $gross;
								$u->posting 		= "Y";  
								$u->created_by 	= Auth::user()->name;                  
								$u->save();
							
							 
					}elseif($data_kon->isreal != "1"){
						/* Jika KPR belum Real
							 11112 Piutang Produksi (D)
								kas Bank (K)
						*/ 
							//======= Debit ======== 
							// 11112 - Piutang Produksi
							$u = new Jurnalumumd;
							$u->id_jurnal 	= $data_jurnal->id;
							$u->id_akun 	    = 11112;
							$u->jenis 		= "J";
							$u->tanggal 		= $request->input("tanggal");
							$u->keterangan 	= $ket_jurnal;
							$u->debit    	= $gross;
							$u->kredit   	= 0;
							$u->posting 		= "Y";  
							$u->created_by 	= Auth::user()->name;                  
							$u->save(); 								
							
						//======= Kredit ======== 
							//Kas  / Bank
							$u = new Jurnalumumd;
							$u->id_jurnal 	= $data_jurnal->id;
							$u->id_akun 	    = $id_akun;
							$u->jenis 		= "J";
							$u->tanggal 		= $request->input("tanggal");
							$u->keterangan 	= $ket_jurnal;
							$u->debit    	= 0;
							$u->kredit   	= $gross;
							$u->posting 		= "Y";  
							$u->created_by 	= Auth::user()->name;                  
							$u->save();
						
					}
					//=================END Insert Jurnal =================================== 

					


				Session::flash('flash_message', 'Pembayaran Termin Sukses!');	
			}else{
				Session::flash('flash_message', 'Pembayaran Harus sesuai dengan Tagihan Booking Fee!');	
			}
            return redirect('paysubkonr');
             

        }

    }

}
