<?php

namespace App\Modules\Rusematerial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Modules\Rusematerial\Models\Rusematerial;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;


class RusematerialController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @param Rusematerial $data
     */

    public function __construct(Rusematerial $data)
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
        return view('Rusematerial::index',['data' => $data]);
    }

     
    public function listall(Request $request)
    {
		$tanggal1 = $request->input("tanggal1");
		$tanggal2 = $request->input("tanggal2");
		$id_propertix = $request->input("id_properti");
		
        $data = $this->data->datanya("all",$tanggal1,$tanggal2);
        return view('Rusematerial::data',['data' => $data]);
    }

     
    public function detail($id)
    {
        $data = $this->data->detail($id); 
		
        return view('Rusematerial::view', ['data' => $data]);
    }

    
     
    public function tagihan(Request $request)
    {
        $kode = substr($request->kode,0,7);
        $data = $this->data->listsatu($kode);

        return view('Rusematerial::data',['data' => $data]);
    }
     

      

}
