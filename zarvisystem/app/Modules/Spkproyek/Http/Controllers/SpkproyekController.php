<?php

namespace App\Modules\Spkproyek\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Spkproyek\Models\Spkproyek; 
use App\Modules\Spk\Models\Spk;
use App\Modules\Mrabp\Models\Mrabp; 
use App\Modules\Mrabp\Models\Mrabpjob; 
use App\Modules\Konsumen\Models\Konsumen; 
use App\Modules\Spkproyek\Models\Terminproyek; 
use App\Modules\Spkproyek\Models\Progresbangun; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

class SpkproyekController extends Controller
{
	  /**
  * Display a listing of the resource.
  *
  * @param Docproperti $data
  */

	public function __construct(Spkproyek $data)
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

       return view('Spkproyek::index',['data' => $data]);
   }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $dirman = $this->data->dirman();
        $subkon = $this->data->subkon();
        $jenis_spk = $this->data->jenis_spk();

        return view('Spkproyek::create', ['dirman' => $dirman, 'subkon'=> $subkon, 'jenis_spk' =>$jenis_spk]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'jenis'   => 'required',
            'pihak1'   => 'required',
            'id_subkon'   => 'required', 
            'tanggal_mulai'   => 'required', 
            'tanggal_selesai'   => 'required'
        ); 
 
        $validator = Validator::make($request->all(), $rules); 
 
        if ($validator->fails()) {
 
            return Redirect::to('spkproyek/create')->withErrors($validator)->withInput();
 
        } else {
			
			$cek = Mrabp::findOrfail($request->input("jenis"));
			
            $noUrutAkhir = Spkproyek::max('id');
            $kode = "SPKP-".sprintf("%04s", $noUrutAkhir + 1);

            $data = new Spkproyek;
            $data->id_properti = $cek->id_properti;
			$data->id_mrabp = $request->input("jenis");
            $data->kode = $kode;
            $data->kategori = $cek->kategori;
            $data->tanggal= date("Y-m-d");
            $data->pihak1 = $request->input("pihak1");
            $data->id_subkon = $request->input("id_subkon");
            $data->gross = $cek->gross;
            $data->gross_total = $cek->gross;
            $data->hari = $cek->hari;
            $data->pekerja = $cek->pekerja;
            $data->tanggal_mulai = $request->input("tanggal_mulai");
            $data->tanggal_bast = $request->input("tanggal_selesai");            
            $data->krgbayar = str_replace(",","",$request->input("gross_total"));
			$data->krgbayarret = str_replace(",","",$request->input("gross_total")) * 0.05;
            $data->status = 0;
            $data->created_by = Auth::user()->name;             
            $data->save(); 
			
			$gt = $cek->gross;
			 
				if($cek["t1"] > 0){
					$termin = new Terminproyek;
                    $termin->id_spk       = $data->id;
                    $termin->termin       = 1;
                    $termin->nilai        = ($gt * $cek["t1"])/100;
                    $termin->ket_termin   =  "Termin 1 - ". $cek["t1"]."%";
                    $termin->status       = 0;  
                    $termin->save();
				}
				if($cek["t2"] > 0){
					$termin = new Terminproyek;
                    $termin->id_spk       = $data->id;
                    $termin->termin       = 2;
                    $termin->nilai        = ($gt * $cek["t2"])/100;
                    $termin->ket_termin   =  "Termin 2 - ". $cek["t2"]."%";
                    $termin->status       = 0;  
                    $termin->save();
				}
				if($cek["t3"] > 0){
					$termin = new Terminproyek;
                    $termin->id_spk       = $data->id;
                    $termin->termin       = 3;
                    $termin->nilai        = ($gt * $cek["t3"])/100;
                    $termin->ket_termin   =  "Termin 3 - ". $cek["t3"]."%";
                    $termin->status       = 0;  
                    $termin->save();
				}
				if($cek["t4"] > 0){
					$termin = new Terminproyek;
                    $termin->id_spk       = $data->id;
                    $termin->termin       = 4;
                    $termin->nilai        = ($gt * $cek["t4"])/100;
                    $termin->ket_termin   =  "Termin 4 - ". $cek["t4"]."%";
                    $termin->status       = 0;  
                    $termin->save();
				}
				if($cek["t5"] > 0){
					$termin = new Terminproyek;
                    $termin->id_spk       = $data->id;
                    $termin->termin       = 5;
                    $termin->nilai        = ($gt * $cek["t5"])/100;
                    $termin->ket_termin   =  "Termin 5 - ". $cek["t5"]."%";
                    $termin->status       = 0;  
                    $termin->save();
				}
				if($cek["retensi"] > 0){
					$termin = new Terminproyek;
                    $termin->id_spk       = $data->id;
                    $termin->termin       = 6;
                    $termin->nilai        = ($gt * $cek["retensi"])/100;
                    $termin->ket_termin   =  "Retensi - ". $cek["retensi"]."%";
                    $termin->status       = 0;  
                    $termin->save();
				}
				
			 
			
			$mrabjob = Mrabpjob::where("id_mrabp","=",$request->input("jenis"))
								->get();
					
			foreach($mrabjob as $d){
				//id, id_spk, id_properti, id_mrabp, id_pekerjaan, photo1, photo2, photo3, status, created_at, updated_at
				$dx = new Progresbangun;
				$dx->id_spk = $data->id;
				$dx->id_properti = $cek->id_properti;
				$dx->id_mrabp = $d->id_mrabp;
				$dx->id_pekerjaan = $d->id_pekerjaan; 
				$dx->bobot = $d->bobot; 
				$dx->save();
			}		
			 
 
            Session::flash('flash_message', 'Data has been successful Added!');
            return redirect('spkproyek');
 
 
        }
    }
 
     

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function setjob($idspk)
    {
        $data = Terminproyek::where("id_spk","=",$idspk)->get();
        $data_spk = SPK::select(DB::raw("spk.*,nama_spk"))
                ->leftjoin("jenis_spk","spk.id_jenis","=","jenis_spk.id")
                ->where("spk.id","=",$idspk)->get();
       
       $setjob = $this->data->job();
        
       return view('spkproyek::setjob', ['data' => $data, 'setjob' => $setjob, 'idspk' => $idspk, 'data_spk' =>$data_spk]);

    } 

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function ajukan(Request $request,$idspk)
    {
       $data = Spkproyek::findOrfail($idspk);
       $data->status = 1;
       $data->save();

        $this->data->update_termin($idspk);
        Session::flash('flash_message', 'Data has been successful Edited!');
        return redirect('spkproyek');

    }

     
    
    public function detail($id)
    {
        $data = $this->data->spkdetail($id);
        $termin = $this->data->termindetail($id);
        $job = $this->data->jobdetail($id);
          
        return view('Spkproyek::detail',['data' =>$data, 'termin' => $termin, 'job' => $job]);

    }
   /**
     * Display a listing of the resource.
     * @return Response
     */
    public function isikan(Request $request)
    {
        $a = explode("|",$request->input("query"));
        $kode = $a[0];
        
        $data = Konsumen::select(DB::raw("properti.id as id_properti,konsumen.kode,konsumen.nama,idcard,
                                konsumen.alamat,telp,konsumen_spr.id as id_spr,
                                properti.nama as nama_properti,
                                properti_kav.nama as nama_kav,
                                properti_kav.tipe as tipe,
                                konsumen_spr.gross_unit as gross"))
        ->rightjoin("konsumen_spr","konsumen.id","=","konsumen_spr.id_konsumen")
        ->rightjoin("properti","konsumen_spr.id_properti","=","properti.id")
        ->rightjoin("properti_kav","konsumen_spr.id_kav","=","properti_kav.id")
        ->where("konsumen_spr.kode","LIKE","%{$kode}%")
        ->get();

        return response()->json($data);       
        
 
    }
	
	public function nilaispk(Request $request)
    {
        $a = $request->input("jenis_spk"); 
         
        $data = Mrabp::where("id","=",$a)
        ->get();
		
        return response()->json($data);       
 
    }
 

    public function autocomplete(Request $request)
    {
        if($request->get('query'))
        {
            
                $data = Konsumen::select(DB::raw("nama,idcard,konsumen.kode, konsumen_spr.kode as kode_spr"))
                ->rightjoin("konsumen_spr","konsumen.id","=","konsumen_spr.id_konsumen")
                ->where("konsumen.nama","LIKE","%{$request->input('query')}%")
                ->where("iskonsumen","=",1)
                ->orwhere("konsumen.nama","LIKE","%{$request->input('query')}%")
                ->orwhere("konsumen_spr.kode","LIKE","%{$request->input('query')}%")
                ->orwhere("konsumen.kode","LIKE","%{$request->input('query')}%")
                ->get();
            
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= '
                    <li><a href="#">'.$row->kode_spr.'|'.$row->nama.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    
}
