<?php

namespace App\Modules\Lr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Lr\Models\Lr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Helpers\Tanggal;

class LrController extends Controller
{ /**
     * Display a listing of the resource.
     *
     * @param Lr $data
     */

    public function __construct(Lr $data)
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
        return view('Lr::index', ['data' => $data]);
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
		 
		$xlabakotor = 0;
		$beban = 0;
		$pajak = 0;
		
		foreach($komponen as $k){			
			$klasifikasi[$k->id] = $this->data->klasifikasi($k->id);			
			foreach($klasifikasi[$k->id] as $kl){
				
				$akun[$k->id][$kl->id] = $this->data->akun($k->id,$kl->id);					
				foreach($akun[$k->id][$kl->id] as $ak){		
					if($ak->posting == "D"){				
						$dtakun[$ak->kode] = $this->data->dtakun_debit($id_properti,$tanggal1,$tanggal2,$ak->kode);
					}else{
						$dtakun[$ak->kode] = $this->data->dtakun_kredit($id_properti,$tanggal1,$tanggal2,$ak->kode);
					}						
				} 
			 
			}
			
		}
		 
		$xlabakotor = $this->data->labakotor($id_properti,$tanggal1,$tanggal2);			
	 
		$beban = $this->data->beban($id_properti,$tanggal1,$tanggal2);
	 
		$pajak = $this->data->pajak($id_properti,$tanggal1,$tanggal2);
	 
		return view('Lr::preview', ['xtanggal1' => $xtanggal1, 
									'xtanggal2' => $xtanggal2, 
									'komponen' => $komponen,
									'klasifikasi' => $klasifikasi,
									'akun' => $akun,
									'dtakun' => $dtakun,
									'pajak' => $pajak,
									'beban' => $beban,
									'xlabakotor' => $xlabakotor]
					);
    }
}
