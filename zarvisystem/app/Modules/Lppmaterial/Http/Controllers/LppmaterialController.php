<?php

namespace App\Modules\Lppmaterial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Lppmaterial\Models\Lppmaterial;
 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LppmaterialController extends Controller
{
	 /**
     * Display a listing of the resource.
     *
     * @param Konsumen $data
     */

    public function __construct(Lppmaterial $data)
    {
        $this->data = $data;
    }
	
 
	public function index()
    {
		$data = $this->data->listitem();
        
        return view("Lppmaterial::index", ['data' => $data]);  
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
		
	   
		return view("Lppmaterial::preview", ['data' => $data, 'tanggal1' => $tanggal1
													, 'tanggal2' => $tanggal2
													]); 


        
    }

    
}
