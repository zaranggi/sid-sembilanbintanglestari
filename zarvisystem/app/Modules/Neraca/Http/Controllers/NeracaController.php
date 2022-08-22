<?php

namespace App\Modules\Neraca\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Neraca\Models\Neraca;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Helpers\Tanggal;

class NeracaController extends Controller
{ /**
     * Display a listing of the resource.
     *
     * @param Neraca $data
     */

    public function __construct(Neraca $data)
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
        return view('Neraca::index', ['data' => $data]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function preview(Request $request)
    {
        $periode = $request->input("periode");
        $id_properti = $request->input("id_properti");
		$komponen = $this->data->komponen($periode);  
		
		
		$laba_ditahan = 0;
		$lababerjalan = 0;
		
		foreach($komponen as $k){			
			$klasifikasi[$k->id] = $this->data->klasifikasi($k->id);			
			foreach($klasifikasi[$k->id] as $kl){
				
				$akun[$k->id][$kl->id] = $this->data->akun($k->id,$kl->id);					
				foreach($akun[$k->id][$kl->id] as $ak){

					switch($ak->kode){
						default:
							if($ak->posting == "D"){				
								$dtakun[$ak->kode] = $this->data->dtakun_debit($id_properti,$periode,$ak->kode);
							}else{
								$dtakun[$ak->kode] = $this->data->dtakun_kredit($id_properti,$periode,$ak->kode);
							}						
						break;
						
						case "31103":
							//Laba Ditahan
							$labakotor_ditahan = $this->data->labakotor_ditahan($id_properti,$periode);
							$beban_ditahan = $this->data->beban_ditahan($id_properti,$periode);
							$pajak_ditahan = $this->data->pajak_ditahan($id_properti,$periode);
							 
						break;
						
						case "31104":
							//Laba Periode Berjalan
							$labakotor = $this->data->labakotor($id_properti,$periode);
							$beban = $this->data->beban($id_properti,$periode);
							$pajak = $this->data->pajak($id_properti,$periode);
							 
						break;
						
					}
					
				} 
			 
			}
			 
		}
		
		return view('Neraca::preview', ['periode' => $periode, 
									'komponen' => $komponen,
									'klasifikasi' => $klasifikasi,
									'labakotor_ditahan' => $labakotor_ditahan,
									'beban_ditahan' => $beban_ditahan, 
									'pajak_ditahan' => $pajak_ditahan,
									'labakotor' => $labakotor,
									'beban' => $beban,
									'pajak' => $pajak,
									'akun' => $akun,
									'dtakun' => $dtakun]
					);
    }
}
