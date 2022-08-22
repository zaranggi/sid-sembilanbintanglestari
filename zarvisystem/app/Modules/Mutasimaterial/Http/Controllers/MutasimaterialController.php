<?php

namespace App\Modules\Mutasimaterial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Mutasimaterial\Models\Mutasimaterial;
 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MutasimaterialController extends Controller
{
	 /**
     * Display a listing of the resource.
     *
     * @param Konsumen $data
     */

    public function __construct(Mutasimaterial $data)
    {
        $this->data = $data;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		$data = $this->data->listitem();
        
        return view("Mutasimaterial::index", ['data' => $data]);  
    }

    
    public function preview(Request $request)
    {
          
		$tanggal1 = $request->input("tanggal1"); 
		$tanggal2 = $request->input("tanggal2"); 
		$prdcd = $request->input("prdcd");
		if($prdcd == "all"){
			$data = $this->data->mutasiall($tanggal1,$tanggal2);	
		}else{
			$data = $this->data->mutasi($tanggal1,$tanggal2,$prdcd);
		}
		
	   
		return view("Mutasimaterial::preview", ['data' => $data, 'tanggal1' => $tanggal1
													, 'tanggal2' => $tanggal2
													]); 


        
    }

     
}
