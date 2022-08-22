<?php

namespace App\Modules\Appmrab\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Appmrab\Models\Appmrab;
use App\Modules\Mrab\Models\Mrabdetail;
use App\Modules\Mrab\Models\Mrabjob;
use App\Modules\Mrab\Models\Mrabmaterial;
use App\Modules\Mrab\Models\Prodmast;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Auth;

class AppmrabController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @param Appmrab $data
     */

    public function __construct(Appmrab $data)
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
        return view('Appmrab::index',["data" => $data]);
    }

    public function approve($kode)
    { 
        $upd = $this->data->approve($kode);
        
        Session::flash('flash_message', 'RAB sudah di Approve!');
        return redirect('appmrab');


    }
    public function reject($kode)
    {
        $upd = $this->data->reject($kode);
        
        Session::flash('flash_message', 'RAB sudah di Reject!');
        return redirect('appmrab');

    }
	public function view($id_properti,$tipe_unit,$kode)
    { 
        $properti = $this->data->namaproperti($id_properti);
        $material = $this->data->rabm($kode); 
		$data = Appmrab::select(db::raw("mrab.*, jenis_spk.nama_spk"))
				->rightjoin("jenis_spk","mrab.jenis_spk","=","jenis_spk.id") 
				->where('kode', $kode)
				->get();
		 
		$setjob = $this->data->job();
	   
	   foreach($data as $r){
		$cek = Mrabjob::where("kode","=",$kode)
						->where("id_mrab","=",$r->id)
						->get();
		
		if(count($cek) > 0){
			foreach($cek as $r2){
				
				$list_select[$r->id][] = $r2->id_pekerjaan;  	
			}
			
		}else{
			$list_select[$r->id] = array();
		}
		
	   }
        
		 
        return view('Appmrab::view', [ 'properti' => $properti,
									'id_properti' => $id_properti,
									'tipe_unit' => $tipe_unit ,
									'material' => $material,
									'data' => $data , 
									'setjob' =>$setjob,
									'list_select' => $list_select									
								]);
								 
	}


    
}
