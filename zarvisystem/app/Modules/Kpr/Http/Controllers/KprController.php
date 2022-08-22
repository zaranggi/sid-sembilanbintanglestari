<?php

namespace App\Modules\Kpr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 

use App\Modules\Kpr\Models\Kpr; 
use App\Modules\Kpr\Models\Tagihankpr; 
use App\Modules\Bank\Models\Bank; 
use App\Modules\Trxkonsumen\Models\Trxkonsumen;
use App\Modules\Trxkonsumen\Models\Konsumenlog;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KprController extends Controller
{

      /**
     * Display a listing of the resource.
     *
     * @param Kpr $data
     */

    public function __construct(Kpr $data)
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
        
        return view("Kpr::index", ['data' => $data]);
        
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function datakonsumen($id)
    {
        $data = $this->data->datakpr($id);      

        return view("Kpr::datakonsumen", 
                            [
                                'data' => $data,
                                'id_properti' => $id                                    
                            ]);
 
    }

      
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function mykonsumen(Request $request)
    {
        $kode = substr($request->kode,0,7);
        $data = $this->data->mykonsumen($kode);      

        return view("Kpr::datakonsumen", ['data' => $data]);
 
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        $a = new Bank;
        $bank = $a->listbank();
		$data = Trxkonsumen::findOrFail($id);
        return view('Kpr::create',['id' => $id, 'bank' => $bank])->with('rx', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'id_spr' => 'required',
            'tanggal' => 'required',
            'bank' => 'required',
            'status' => 'required',
            'nominal_pengajuan' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('kpr/create/'.$request->id_spr)->withErrors($validator)->withInput();
        }
        elseif(str_replace(",","",$request->input('nominal_pengajuan')) == 0){
			return Redirect::to('kpr/create/'.$request->id_spr)->withErrors($validator)->withInput();
		}else{
			
            $data = new Kpr;
            $data->id_spr 	= $request->input('id_spr');
            $data->tanggal 		= $request->input('tanggal');
            $data->bank 		= $request->input('bank');
            $data->status 		= $request->input('status');
            $data->keterangan 	= $request->input('keterangan');
            $data->nominal 	= str_replace(",","",$request->input('nominal_pengajuan'));
            $data->tanggal_sp3k 	= $request->input('tanggal_sp3k');
            $data->keterangan_sp3k 	= $request->input('keterangan_sp3k');
            $data->nominal_sp3k 	= str_replace(",","",$request->input('nominal_sp3k'));
            $namafile = "";
				if ($request->hasFile('photo')) {
					$path ='image/sp3k';
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}                
					$file = $request->file('photo');    
					$namafile = uniqid() . '_' . trim($file->getClientOriginalName());    
					$file->move($path, $namafile);
				}

			$data->file_sp3k 	= $namafile;            
			$data->save();

            $data = Trxkonsumen::findOrFail($request->input('id_spr'));
            if($data->log_kpr <> "Realisasi KPR"){
                $data->log_kpr = $request->input('status');
            } 
            
            $data->log_kpr_bank = $request->input('bank');
            $data->sp3k_nominal = str_replace(",","",$request->input('nominal_sp3k'));
            $data->sp3k_status = $request->input('sp3k_status');
			if($request->input('keterangan_sp3k') == ""){
				$data->keterangan = $request->input('keterangan');
			}else{
				$data->keterangan = $request->input('keterangan_sp3k');
			}
            
            $data->save();
			
			

               //=================Insert Log Konsumen===================================
         
               $k = new Konsumenlog;
               $k->id_konsumen = $data->id_konsumen;
               $k->id_marketing = $data->id_marketing; 
               $k->id_properti = $data->id_properti; 
               $k->id_kav = $data->id_kav;
               $k->id_spr = $request->input('id_spr');
               $k->tanggal = date("Y-m-d"); 
               $k->status = strtoupper($request->input('status'))." KPR"; 
               $k->keterangan = strtoupper($request->input('status'))." KPR : Tanggal = ".$request->input('tanggal')." , Bank = ".$request->input('bank')." Nama Petugas : ". Auth::user()->name; 
               $k->created_by = Auth::user()->name; 
               $k->save();
                //=================Insert Log Konsumen===================================

            Session::flash('flash_message', 'Data has ben successful Added!');
            return redirect('kpr');
        }

    }
 
    

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    { 
        $a = new Bank;
        $bank = $a->listbank();
        $data = KPR::where('id_spr','=',$id)->orderby('id','DESC')->take(1)->get();
        return view('Kpr::edit',['id' => $id, 'bank' => $bank])->with('data', $data); 
    }
	
	
	public function update(Request $request)
    {
        $rules = array(
            'id_spr' => 'required',
            'id_kpr' => 'required',
            'tanggal' => 'required',
            'bank' => 'required',
            'status' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('kpr/'.$request->id_spr.'/edit')->withErrors($validator)->withInput();
        }
        else{
			
            $data = Kpr::findOrFail($request->input('id_kpr'));
            $data->tanggal 		= $request->input('tanggal');
            $data->bank 		= $request->input('bank');
            $data->status 		= $request->input('status');
            $data->keterangan 	= $request->input('keterangan');
            $data->nominal 	= str_replace(",","",$request->input('nominal_pengajuan'));
            $data->tanggal_sp3k 	= $request->input('tanggal_sp3k');
            $data->keterangan_sp3k 	= $request->input('keterangan_sp3k');
            $data->nominal_sp3k 	= str_replace(",","",$request->input('nominal_sp3k'));
            $namafile = "";
				
				if ($request->hasFile('photo')) {
					$path ='image/sp3k';
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}                
					$file = $request->file('photo');    
					$namafile = uniqid() . '_' . trim($file->getClientOriginalName());    
					$file->move($path, $namafile);
				}

			$data->file_sp3k 	= $namafile;            
			$data->save();

            $kon = Trxkonsumen::findOrFail($request->input('id_spr'));
            
            if($kon->log_kpr <> "Realisasi KPR"){
                $kon->log_kpr = $request->input('status');
            }

            $kon->log_kpr_bank = $request->input('bank');
            $kon->tanggal_sp3k = str_replace(",","",$request->input('tanggal_sp3k'));
            $kon->sp3k_nominal = str_replace(",","",$request->input('nominal_sp3k'));
            $kon->sp3k_status = $request->input('status');
			
			if($request->input('keterangan_sp3k') == ""){
				$kon->keterangan = $request->input('keterangan');
			}else{
				$kon->keterangan = $request->input('keterangan_sp3k');
			}
            $kon->save();
			
			if($request->input('status') == "ACC" && ($data->nominal > $data->nominal_sp3k)){
				 
				$dbtag_um = new Tagihankpr;
				$dbtag_um->id_spr       = $kon->id;
				$dbtag_um->id_jenis     = 7;
				$dbtag_um->urutan       = 1;
				$dbtag_um->nilai_mou    =  $kon->gross_total;
				$dbtag_um->tagihan      = $data->nominal - $data->nominal_sp3k;
				$dbtag_um->tgl_jatuhtempo  = date("Y-m-d");    
				$dbtag_um->bayar        = 0;
				$dbtag_um->status        = "Belum Lunas";
				$dbtag_um->kurang       = $data->nominal - $data->nominal_sp3k;
				$dbtag_um->created_by   = Auth::user()->name;
				$dbtag_um->save(); 
			}
			

               //=================Insert Log Konsumen===================================
         
               $k = new Konsumenlog;
               $k->id_konsumen = $kon->id_konsumen;
               $k->id_marketing = $kon->id_marketing; 
               $k->id_properti = $kon->id_properti; 
               $k->id_kav = $kon->id_kav;
               $k->id_spr = $request->input('id_spr');
               $k->tanggal = date("Y-m-d"); 
               $k->status = strtoupper($request->input('status'))." KPR"; 
               $k->keterangan = strtoupper($request->input('status'))." KPR : Tanggal = ".$request->input('tanggal')." , Bank = ".$request->input('bank')." Nama Petugas : ". Auth::user()->name; 
               $k->created_by = Auth::user()->name; 
               $k->save();
                //=================Insert Log Konsumen===================================

            Session::flash('flash_message', 'Data has ben successful Updated!');
            return redirect('kpr');
        }

    }
 
    
}
