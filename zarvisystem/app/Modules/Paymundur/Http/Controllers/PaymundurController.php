<?php

namespace App\Modules\Paymundur\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
 
use App\Modules\Paymundur\Models\Paymundur;  
use App\Modules\Bank\Models\Bank;
use App\Modules\Pomaterial\Models\Tconst;
use App\Modules\Booking\Models\Mtran;
use App\Modules\Jurnalumum\Models\Jurnalumum;
use App\Modules\Jurnalumum\Models\Jurnalumumd;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Modules\Trxkonsumen\Models\Trxkonsumen;

class PaymundurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Paymundur $data
     */

    public function __construct(Paymundur $data)
    {
        $this->data = $data;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->listall();
        $bank_pt = Bank::All();
		$bank = $this->data->listbank();
        return view('Paymundur::index',['data' => $data, 'bank_pt' => $bank_pt, 'bank' => $bank]);
    }
    
    public function store(Request $request)
    {
        $rules = array( 
            'tgl_bayar' => 'required', 
            'gross' => 'required',  
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) { 
            return Redirect::to('paysubkon')->withErrors($validator)->withInput();  
        }
        else
        {


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
             
                    $gross = str_replace(",","",$request->input('gross')); 
                    $id_mundur = $request->input('id_mundur');

                    $const = Tconst::where("rkey","=","AP")->get();
					foreach($const as $r)
					{
						$docno = $r->docno + 1;
                    }
                    
                    $datamundur = Paymundur::findOrfail($request->input("id_mundur"));
                    $d = Trxkonsumen::findOrfail($datamundur->id_spr);
                if($datamundur->pengembalian == $gross){

					$mt = new Mtran;
					$mt->kode 	        = "AP-".date("ymd")."-0".$docno;
					$mt->rtype			= "AP";
					$mt->id_properti	= $d->id_properti;
					$mt->id_kav     	= $d->id_kav;
					$mt->tanggal 	    = $request->input('tgl_bayar');
					$mt->pembayar 	    = Auth::user()->name;
					$mt->penerima 	    = $request->input('nama');
                    $mt->tipe_pembayaran 	= $request->input('tipe_pembayaran');
                    
					if($request->input('tipe_pembayaran') == "Transfer"){
						$mt->bank 	= $request->input('bank_pengirim');
						$mt->norek 	= $request->input('norek_pengirim');
						$mt->id_bank 			= $request->input('id_bank');	
					}				
					$mt->jumlah 	        = $gross; 
				    $mt->photo = $namafile;
					$mt->keterangan 	    = $request->input('keterangan_bayar');
					$mt->save();
					
					$d = Tconst::findOrfail(8);
					$d->docno = $docno;
                    $d->save();
                    
                    $datamundur->bayar = $gross;
                    $datamundur->save();
					
                    //=================END Insert Mtran ===================================  
                    
                    //=================START INSER JURNAL UMUM===================================
					$ket_jurnal = "Pembayaran Pengembalian UM Konsumen Mundur";
					
					$ppju = $request->input("tgl_bayar");
					$noUrutAkhir = Jurnalumum::max('id');
					$kodej = "JU-".substr($ppju,2,2).substr($ppju,5,2).substr($ppju,8,2)."-".sprintf("%04s", $noUrutAkhir + 1); 
	
					$data_jurnal = new Jurnalumum;
					$data_jurnal->id_properti 	= $d->id_properti;
					$data_jurnal->nomor 	    = $kodej;
					$data_jurnal->tanggal 		= $request->input("tgl_bayar");
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
                    /* Jurnalnya
                        41203 - Pendapatan Diterima Dimuka
                            Kas
                            Pendapatan Konsumen Mundur 
                                
						*/ 
							//======= Debit ======== 
							// 141203 - Pendapatan Diterima Dimuka
							$u = new Jurnalumumd;
							$u->id_jurnal 	= $data_jurnal->id;
							$u->id_akun 	    = 41203;
							$u->jenis 		= "J";
							$u->tanggal 		= $request->input("tanggal");
							$u->keterangan 	= $ket_jurnal;
							$u->debit    	= $datamundur->terbayar;
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
                            
                            //41202  Pendapatan Konsumen Mundur
							$u = new Jurnalumumd;
							$u->id_jurnal 	= $data_jurnal->id;
							$u->id_akun 	    = 41202;
							$u->jenis 		= "J";
							$u->tanggal 		= $request->input("tanggal");
							$u->keterangan 	= $ket_jurnal;
							$u->debit    	= 0;
							$u->kredit   	= $datamundur->terbayar - $gross;
							$u->posting 		= "Y";  
							$u->created_by 	= Auth::user()->name;                  
                            $u->save();
                            
                            
                    //=================END INSER JURNAL UMUM===================================

                    Session::flash('flash_message', 'Pembayaran Pengembalain Sukses!');	
                }else{
                    Session::flash('flash_message', 'Pembayaran Harus sesuai dengan Pengembalian !');	
                }

        }
        return redirect('paymundur'); 

    }

    public function jurnal($id)
    {
        $id_mundur = $id;

        $datamundur = Paymundur::findOrfail($id_mundur);

        $d = Trxkonsumen::findOrfail($datamundur->id_spr);

        if($datamundur->pengembalian == 0){ 
            
            $datamundur->bayar = 0;
            $datamundur->status = 4;
            $datamundur->save();
            
            //=================END Insert Mtran ===================================  
            
            //=================START INSER JURNAL UMUM===================================
            $ket_jurnal = "Pendapatan Konsumen Mundur";
            
            $ppju = date("Y-m-d");
            $noUrutAkhir = Jurnalumum::max('id');
            $kodej = "JU-".substr($ppju,2,2).substr($ppju,5,2).substr($ppju,8,2)."-".sprintf("%04s", $noUrutAkhir + 1); 

            $data_jurnal = new Jurnalumum;
            $data_jurnal->id_properti 	= $d->id_properti;
            $data_jurnal->nomor 	    = $kodej;
            $data_jurnal->tanggal 		= $ppju;
            $data_jurnal->keterangan 	= $ket_jurnal;
            $data_jurnal->created_by 	= Auth::user()->name;
            $data_jurnal->jenis 		= "J";
            $data_jurnal->posting 		= "Y";                
            $data_jurnal->save();  
            
            /* Jurnalnya
                41203 - Pendapatan Diterima Dimuka
                    Kas
                    Pendapatan Konsumen Mundur 
                        
                */ 
                    //======= Debit ======== 
                    // 141203 - Pendapatan Diterima Dimuka
                    $u = new Jurnalumumd;
                    $u->id_jurnal 	= $data_jurnal->id;
                    $u->id_akun 	    = 41203;
                    $u->jenis 		= "J";
                    $u->tanggal 		= date("Y-m-d");
                    $u->keterangan 	= $ket_jurnal;
                    $u->debit    	= $datamundur->terbayar;
                    $u->kredit   	= 0;
                    $u->posting 		= "Y";  
                    $u->created_by 	= Auth::user()->name;                  
                    $u->save(); 								
                    
                //======= Kredit ========  
                    
                    //41202  Pendapatan Konsumen Mundur
                    $u = new Jurnalumumd;
                    $u->id_jurnal 	= $data_jurnal->id;
                    $u->id_akun 	    = 41202;
                    $u->jenis 		= "J";
                    $u->tanggal 		= date("Y-m-d");
                    $u->keterangan 	= $ket_jurnal;
                    $u->debit    	= 0;
                    $u->kredit   	= $datamundur->terbayar;
                    $u->posting 		= "Y";  
                    $u->created_by 	= Auth::user()->name;                  
                    $u->save();
                    
                    
            //=================END INSER JURNAL UMUM===================================

            Session::flash('flash_message', 'Penjurnalan Sukses!');	
        }  
         
        return redirect('paymundur'); 
    }
 

}
