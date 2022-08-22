<?php

namespace App\Modules\Pmodal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Pmodal\Models\Pmodal;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Helpers\Tanggal;

class PmodalController extends Controller
{ /**
     * Display a listing of the resource.
     *
     * @param Pmodal $data
     */

    public function __construct(Pmodal $data)
    {
        $this->data = $data;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->perumahan();
        return view('Pmodal::index', ['data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function preview(Request $request)
    {
        $xtanggal1 = $request->input("tanggal1");
        $xtanggal2 = $request->input("tanggal2");
		
        $tanggal1 = $request->input("tanggal1");
        $tanggal2 = $request->input("tanggal2");
		
        $id_properti = $request->input("id_properti");
		$komponen = $this->data->komponen();  
		
		foreach($komponen as $k){			
            $klasifikasi[$k->id] = $this->data->klasifikasi();		
            
			foreach($klasifikasi[$k->id] as $kl){	
                $akun[$k->id][$kl->id] = $this->data->akun($k->id,$kl->id);	 				
				foreach($akun[$k->id][$kl->id] as $ak){		
                    
                    switch($ak->kode){
						default: 
                            $dtakun[$ak->kode] = $this->data->dtakun_kredit($id_properti,$tanggal1,$tanggal2,$ak->kode);                             			
						break;
						
						case "31103":
							//Laba Ditahan
							$labakotor_ditahan = $this->data->labakotor_ditahan($id_properti,$tanggal1);
							$beban_ditahan = $this->data->beban_ditahan($id_properti,$tanggal1);
							$pajak_ditahan = $this->data->pajak_ditahan($id_properti,$tanggal1);
							 
						break;
						
						case "31104":
							//Laba Periode Berjalan
							$labakotor = $this->data->labakotor($id_properti,$tanggal1,$tanggal2);
							$beban = $this->data->beban($id_properti,$tanggal1,$tanggal2);
							$pajak = $this->data->pajak($id_properti,$tanggal1,$tanggal2);
							 
						break;
						
					}				
                } 
                
			 
			}
			
        }
       	 
	 
		return view('Pmodal::preview', ['tanggal1' => $xtanggal1, 
									'tanggal2' => $xtanggal2, 
                                    'komponen' => $komponen,
                                    'klasifikasi' => $klasifikasi,
                                    'dtakun' =>  $dtakun,
									'labakotor_ditahan' => $labakotor_ditahan,
									'beban_ditahan' => $beban_ditahan, 
									'pajak_ditahan' => $pajak_ditahan,
									'labakotor' => $labakotor,
									'beban' => $beban,
									'pajak' => $pajak,
									'akun' => $akun,
									'dtakun' => $dtakun
									 ]
					);    
    }
}
