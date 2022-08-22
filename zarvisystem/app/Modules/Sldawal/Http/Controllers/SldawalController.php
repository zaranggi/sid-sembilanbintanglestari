<?php

namespace App\Modules\Sldawal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Sldawal\Models\Sldawal;
use App\Modules\Sldawal\Models\Sldawald;
use App\Modules\Sldawal\Models\Closing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SldawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Jurnal $data
     */
    public function __construct(Sldawal $data)
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
        
        return view("Sldawal::index", ['data' => $data]);
 
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
        return view('sldawal::tambah',['akunnya' => $akunnya, 'id_properti' => $id_properti]);

    }

    
     /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {   
		$blold = \App\Helpers\Tanggal::bulan_lalu2($request->input("tanggal"));
		$thari = \App\Helpers\Tanggal::jumlah_hari($blold);
		
		$ppju = $blold;
		
        $noUrutAkhir = Sldawal::max('id');
        $kode = "OB-".substr($ppju,2,2).substr($ppju,5,2)."-".sprintf("%04s", $noUrutAkhir + 1); 
			
         
        $data = new Sldawal;
        $data->id_properti 	= $request->input("id_properti");
        $data->nomor 	    = $kode;
        $data->jenis 	    = "J";
        $data->tanggal 		= $blold."-".$thari;
        $data->keterangan 	= "Saldo Awal";
        $data->created_by 	= Auth::user()->name;
        $data->posting 		= "Y";                
        $data->save(); 
        
        $id_akun = $request->input("id_akun");
        $d = $request->input("gross_d");
        $k = $request->input("gross_k"); 
        
        $no = 0;

        foreach($id_akun as $id){

            $u = new Sldawald;
            $u->id_jurnal 	= $data->id;
            $u->id_akun 	= $id;
            $u->jenis 	    = "J";
            $u->tanggal 	= $blold."-".$thari;
            $u->keterangan 	= "Saldo Awal";
            $u->debit    	= $d[$no];
            $u->kredit   	= $k[$no];
            $u->posting 	= "Y";
            $u->created_by 	= Auth::user()->name;                
            $u->save();
            $no++;
    
        }
		//input sebagai saldo untuk akhir bulan tersebut
		$no2 = 0;
		foreach($id_akun as $id){

            $e = new Closing;
            $e->kode 		= $id;
            $e->periode 	= $blold;
            $e->debit    	= $d[$no2];
            $e->kredit   	= $k[$no2];
            $e->created_by 	= Auth::user()->name;                
            $e->save();
            $no2++;
    
        }
         
        $arr = array('msg' =>"Data Saldo Awal Berhasil Disimpan", 'status'=>true);               
        return response()->json($arr); 

    }
     
 
}
