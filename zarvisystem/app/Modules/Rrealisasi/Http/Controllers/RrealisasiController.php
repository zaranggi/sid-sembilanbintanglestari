<?php

namespace App\Modules\Rrealisasi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 

use App\Modules\Konsumen\Models\Konsumen;
use App\Modules\Mproperti\Models\Mproperti;
use App\Modules\Rrealisasi\Models\Rrealisasi;
use App\Modules\Users\Models\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;
use App\Modules\Trxkonsumen\Models\Trxkonsumen;

class RrealisasiController extends Controller
{
	 /**
     * Display a listing of the resource.
     *
     * @param Rrealisasi $data
     */

    public function __construct(Rrealisasi $data)
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
        return view('Rrealisasi::index',['data' => $data]);
    }
 
    public function preview(Request $request)
    {
		 
        $tanggal1 = $request->input("tanggal1");
        $tanggal2 = $request->input("tanggal2");
        $id_properti = $request->input("id_properti"); 

        $data = $this->data->listall($tanggal1,$tanggal2,$id_properti); 
        $data2 = $this->data->listrekap($tanggal1,$tanggal2,$id_properti); 
        
        return view('Rrealisasi::preview',['data' => $data,'data2' => $data2,'tanggal1' => $tanggal1 ,'tanggal2' => $tanggal2]);
		 
    }
}
