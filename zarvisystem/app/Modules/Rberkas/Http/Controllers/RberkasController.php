<?php

namespace App\Modules\Rberkas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Konsumen\Models\Konsumen;
use App\Modules\Mproperti\Models\Mproperti;
use App\Modules\Rberkas\Models\Rberkas;
use App\Modules\Users\Models\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;
use App\Modules\Trxkonsumen\Models\Trxkonsumen;

class RberkasController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @param Rberkas $data
     */

    public function __construct(Rberkas $data)
    {
        $this->data = $data;
    }
	/**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Mproperti::OrderBy('created_at','desc')->get(); 
        return view('Rberkas::index',['data' => $data]);
    }
 
    public function preview(Request $request)
    {
        $tanggal1 = $request->input("tanggal1");
        $tanggal2 = $request->input("tanggal2");
        $id_properti = $request->input("id_properti"); 
        $status = $request->input("status_kpr"); 
		$statusx = $status;
		switch($status){
		 
			case"baru":
				$data = $this->data->baru($tanggal1,$tanggal2,$id_properti); 
				$data2 = $this->data->baru_rekap($tanggal1,$tanggal2,$id_properti); 
				$statusx = "Mou Baru";
				return view('Rberkas::preview',['status' => $statusx,'data' => $data,'data2' => $data2,'tanggal1' => $tanggal1 ,'tanggal2' => $tanggal2]);
			break;

			case"proses":
				$data = $this->data->proses($tanggal1,$tanggal2,$id_properti); 
				$data2 = $this->data->proses_rekap($tanggal1,$tanggal2,$id_properti);
				$statusx = "Proses Pengajuan";return view('Rberkas::preview',['status' => $statusx,'data' => $data,'data2' => $data2,'tanggal1' => $tanggal1 ,'tanggal2' => $tanggal2]);
			break;

			case"acc":
				$data = $this->data->acc($tanggal1,$tanggal2,$id_properti);
				$data2 = $this->data->acc_rekap($tanggal1,$tanggal2,$id_properti); 
				$statusx = "ACC / SP3K";
				return view('Rberkas::preview2',['status' => $statusx,'data' => $data,'data2' => $data2,'tanggal1' => $tanggal1 ,'tanggal2' => $tanggal2]);
			break;
			
			case"realisasi":
				$data = $this->data->realisasi($tanggal1,$tanggal2,$id_properti);
				$data2 = $this->data->realisasi_rekap($tanggal1,$tanggal2,$id_properti); 
				$statusx = "Realisasi";
				return view('Rberkas::preview2',['status' => $statusx,'data' => $data,'data2' => $data2,'tanggal1' => $tanggal1 ,'tanggal2' => $tanggal2]);
			break;
		}
        
        
    }
}
