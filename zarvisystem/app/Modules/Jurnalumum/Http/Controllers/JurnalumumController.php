<?php

namespace App\Modules\Jurnalumum\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Jurnalumum\Models\Jurnalumum;
use App\Modules\Jurnalumum\Models\Jurnalumumd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class JurnalumumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Jurnal $data
     */
    public function __construct(Jurnalumum $data)
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
        
        return view("Jurnalumum::index", ['data' => $data]);
 
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function tambah($id_properti)
    {   
        $akunnya = DB::table('daftar_akun')
						->select('id','kode', 'nama_akun')
                        ->where('id_komponen', '<>', '0')
                        ->where('id_klasifikasi', '<>', '0')
						->get(); 
        return view('Jurnalumum::tambah',['akunnya' => $akunnya, 'id_properti' => $id_properti]);

    }

    
     /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {   
		$ppju = $request->input("tanggal");
        $noUrutAkhir = Jurnalumum::max('id');
        $kode = "JU-".substr($ppju,2,2).substr($ppju,5,2).substr($ppju,8,2)."-".sprintf("%04s", $noUrutAkhir + 1); 
		
        $data = new Jurnalumum;
        $data->id_properti 	    = $request->input("id_properti");
        $data->nomor 	    = $kode;
        $data->tanggal 		= $request->input("tanggal");
        $data->keterangan 	= $request->input("keterangan");
        $data->created_by 	= Auth::user()->name;
        $data->jenis 		= "J";
        $data->posting 		= "Y";                
        $data->save(); 
        
        $id_akun = $request->input("id_akun");
        $d = $request->input("gross_d");
        $k = $request->input("gross_k"); 
        $keterangan2 = $request->input("keterangan2");
        $no = 0;

        foreach($id_akun as $id){

            $u = new Jurnalumumd;
            $u->id_jurnal 	= $data->id;
            $u->id_akun 	    = $id;
			$u->jenis 		= "J";
            $u->tanggal 		= $request->input("tanggal");
            $u->keterangan 	= $keterangan2[$no];
            $u->debit    	= $d[$no];
            $u->kredit   	= $k[$no];
            $u->posting 		= "Y";  
			$u->created_by 	= Auth::user()->name;                  
            $u->save();
            $no++;
    
        }
         
        $arr = array('msg' =>"Jurnal Berhasil Disimpan", 'status'=>true);               
        return response()->json($arr); 

    }
    
   

 
}
