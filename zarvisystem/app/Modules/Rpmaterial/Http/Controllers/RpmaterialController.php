<?php

namespace App\Modules\Rpmaterial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Modules\Rpmaterial\Models\Rpmaterial;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;


class RpmaterialController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @param Rpmaterial $data
     */

    public function __construct(Rpmaterial $data)
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
        return view('Rpmaterial::index',['data' => $data]);
    }

     
    public function listall(Request $request)
    {
		$tanggal1 = $request->input("tanggal1");
		$tanggal2 = $request->input("tanggal2");
		$id_properti = $request->input("id_properti");
		
        $data = $this->data->listall($id_properti,$tanggal1,$tanggal2);
        return view('Rpmaterial::data',['data' => $data]);
    }

     
    public function detail($id)
    {
        $data = $this->data->detail($id); 
		
        return view('Rpmaterial::view', ['data' => $data]);
    }

    
     
    public function tagihan(Request $request)
    {
        $kode = substr($request->kode,0,7);
        $data = $this->data->listsatu($kode);

        return view('Rpmaterial::data',['data' => $data]);
    }
     

      

}
