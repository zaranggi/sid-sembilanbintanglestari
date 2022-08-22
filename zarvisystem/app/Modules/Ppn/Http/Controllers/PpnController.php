<?php

namespace App\Modules\Ppn\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Modules\Ppn\Models\Ppn;
use App\Modules\Booking\Models\Mtran;
use App\Modules\Ppn\Models\Mtrankonsumen;

use App\Modules\Trxkonsumen\Models\Konsumenlog;
use App\Modules\Trxkonsumen\Models\Trxkonsumen;
use App\Modules\Bank\Models\Bank;
use App\Modules\Pomaterial\Models\Tconst;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class PpnController extends Controller
{
	    /**
     * Display a listing of the resource.
     *
     * @param Bank $data
     */

    public function __construct(Ppn $data)
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
        return view('Ppn::index',['data' => $data]);
    }

     
    public function listall($id)
    {
        $data = $this->data->listall($id);
        return view('Ppn::data',['data' => $data]);
    }

    public function detail($id)
    {
        $data = $this->data->detail($id);
		$konsumen = Trxkonsumen::select(db::raw("
					konsumen_spr.bonus,konsumen_spr.kode,konsumen.idcard,konsumen.npwp,konsumen.nama,konsumen.alamat,konsumen.telp,konsumen.pekerjaan,
					properti.nama as nama_properti,properti_kav.nama as nama_kav,properti_kav.tipe as tipe_unit,
					users.name as nama_marketing"))
					->leftJoin("konsumen","konsumen_spr.id_konsumen","=","konsumen.id")
					->leftJoin("properti","konsumen_spr.id_properti","=","properti.id")
					->leftJoin("properti_kav","konsumen_spr.id_kav","=","properti_kav.id")
					->leftJoin("users","konsumen_spr.id_marketing","=","users.id")
					->where("konsumen_spr.id","=",$id)->get();
		
        $his = Mtrankonsumen::where("id_spr","=",$id)
				->wherein("id_jenis",[6])->orderBy("id","desc")->get();
		$bank_pt = Bank::All();
		$bank = $this->data->listbank();		
        return view('Ppn::view',['data' => $data, 'his' => $his, 'konsumen' => $konsumen,'bank_pt' => $bank_pt, 'bank' => $bank]);
    }
     
    public function tagihan(Request $request)
    {
        $kode = substr($request->kode,0,7);
        $data = $this->data->listsatu($kode);

        return view('Ppn::data',['data' => $data]);
    }
    

    public function edit($id)
    {
        $data = Tambahan::findOrFail($id); 

        return view("ppn::edit")->with('data', $data); 

    }

     /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function simpanbayar(Request $request)
    {
        $rules = array(
            'id_tagihan' => 'required|numeric',
            'nama' => 'required|max:50',
            'tanggal' => 'required', 
            'gross' => 'required', 

        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) { 
            return Redirect::to('ppn')->withErrors($validator)->withInput();  
        }
        else
        {
             
            $gross = str_replace(",","",$request->input('gross')); 

            $menu = Ppn::findOrFail($request->input("id_tagihan"));      
			if(($gross + $menu->bayar) <= $menu->tagihan){			
				$menu->bayar         	= $gross + $menu->bayar;
				$menu->kurang 	        = $menu->tagihan - $menu->bayar ;
				$menu->tgl_bayar 	    = $request->input('tanggal');
				$menu->keterangan 	    = $request->input('keterangan');
				($menu->bayar) == $menu->tagihan ? $status = "Lunas" : $status = "Belum Lunas" ;
				$menu->status       =  $status;
				$menu->save(); 

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
				
					$data = new Mtrankonsumen;
					$data->kode 	        = "PPN-".$menu->id."-".$menu->urutan;
					$data->id_jenis 	    = 6;
					$data->id_spr  			= $menu->id_spr;
					$data->tanggal 	        = $request->input('tanggal');
					$data->pembayar 	    = $request->input('nama');
					$data->penerima 	    = Auth::user()->name;
					$data->tipe_pembayaran 	= $request->input('tipe_pembayaran');
					if($request->input('tipe_pembayaran') == "Transfer"){
						$data->bank_pengirim 	= $request->input('bank_pengirim');
						$data->norek_pengirim 	= $request->input('norek_pengirim');
						$data->id_bank 			= $request->input('id_bank');	
					}	
					$data->jumlah 	        = $gross;
					$data->angsuran_ke 	    = $menu->urutan;
					$data->photo    	    = $namafile;
					$data->keterangan 	    = $request->input('keterangan');
					$data->save();
					
						//=================Insert Log Konsumen===================================
							$kon = Trxkonsumen::findOrFail($menu->id_spr);
								$k = new Konsumenlog;
								$k->id_konsumen = $kon->id_konsumen;
								$k->id_marketing = $kon->id_marketing; 
								$k->id_properti = $kon->id_properti; 
								$k->id_kav = $kon->id_kav;
								$k->id_spr = $kon->id; 
								$k->tanggal = $request->input('tanggal');
								$k->status = "PPN"; 
								$k->keterangan = "PPn : ".$menu->urutan." - Nominal = ".$gross; 
								$k->created_by = Auth::user()->name; 
								$k->save();
							//=================Insert Log Konsumen===================================
							
							//=================Insert Mtran ===================================
					$const = Tconst::where("rkey","=","AR")->get();
					foreach($const as $r)
					{
						$docno = $r->docno + 1;
					}
					
					$mt = new Mtran;
					$mt->kode 	        = "AR-".date("ymd")."-0".$docno;
					$mt->rtype			= "AR";
					$mt->id_properti 	=  $kon->id_properti;
					$mt->id_kav 	    =  $kon->id_kav;
					$mt->tanggal 	        = $request->input('tanggal');
					$mt->pembayar 	    = $request->input('nama');
					$mt->penerima 	    = Auth::user()->name;
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
					
					$d = Tconst::findOrfail(9);
					$d->docno = $docno;
					$d->save();
					 
					
					//=================END Insert Mtran ===================================
				
				 
				
				Session::flash('flash_message', 'Data Pembayaran Berhasil Disimpan!');
			}else{ 
				Session::flash('flash_message', 'Pembayaran Tidak Boleh Lebih dari Tagihan!');	
			}
		}
        return redirect('ppn/detail/'.$menu->id_spr);
             

    } 
}
