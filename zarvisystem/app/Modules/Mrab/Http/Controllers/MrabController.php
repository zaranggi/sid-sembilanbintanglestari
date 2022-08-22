<?php

namespace App\Modules\Mrab\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Mrab\Models\Mrab;
use App\Modules\Mrab\Models\Mrabdetail;
use App\Modules\Mrab\Models\Mrabjob;
use App\Modules\Mrab\Models\Mrabmaterial;
use App\Modules\Mrab\Models\Prodmast;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class MrabController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @param Mrab $data
     */

    public function __construct(Mrab $data)
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
        return view('Mrab::index', ['data' =>$data ]);

    }

	public function view($id_properti,$tipe_unit,$kode)
    { 
		$data = Mrab::select(db::raw("mrab.*, jenis_spk.nama_spk"))
				->rightjoin("jenis_spk","mrab.jenis_spk","=","jenis_spk.id")
				->where("mrab.kode","=",$kode) 
				->get();
				
        $properti = $this->data->namaproperti($id_properti);
        $material = $this->data->rabm($kode); 
		
		$setjob = $this->data->job();
	   
	   foreach($data as $r){
		$cek = Mrabjob::where("kode","=",$r->kode)
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
        
		 
        return view('Mrab::view', [ 'properti' => $properti,
									'id_properti' => $id_properti,
									'tipe_unit' => $tipe_unit ,
									'material' => $material,
									'data' => $data , 
									'setjob' =>$setjob,
									'list_select' => $list_select									
								]);
								 
	}
	
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function data(Request $request, $id)
    {

        $properti = $this->data->namaproperti($id);
        $data = Mrab::select(db::raw("id,
					`status`,
					kode,
					tipe_unit,sum(gross) as gross, group_concat(distinct created_by)  as created_by"))
                ->where("id_properti","=",$id)
				->groupby(["tipe_unit","kode"])->get(); 

        return view('Mrab::data', ['data' =>$data, 'properti' => $properti, 'id' => $id ]);

    }
	public function ubah($kode)
    {
		$spk = $this->data->jenis_spk();
		$data = Mrab::select(db::raw("mrab.*, jenis_spk.nama_spk"))
				->rightjoin("jenis_spk","mrab.jenis_spk","=","jenis_spk.id")
				->where("mrab.kode","=",$kode)
				->get();
        foreach($data as $r){
			$id_properti = $r->id_properti;
			$tipe_unit = $r->tipe_unit;
		}
		 
        return view('Mrab::ubah', [ 
									'id_properti' => $id_properti,
									'tipe_unit' => $tipe_unit ,
									'kode' => $kode ,
									'data' => $data 
								]);
								 
	}
	
	public function ubahsimpan(Request $request)
    {
		$rules = array(
            'id_properti' => 'required|numeric',
            'tipe_unit' => 'required',

        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('mrab')->withErrors($validator)->withInput();
        }
        else
        {
			$data = Mrab::select(db::raw("mrab.*, jenis_spk.nama_spk"))
				->rightjoin("jenis_spk","mrab.jenis_spk","=","jenis_spk.id")
				->where("mrab.id_properti","=",$request->input('id_properti'))
				->where("mrab.tipe_unit","=",$request->input('tipe_unit'))
				->where("mrab.kode","=",$request->input('kode'))
				->get();
			
			foreach($data as $r){
				
				$data = Mrab::findOrFail($request->input('id_mrab_'.$r->id));
				$data->id_properti 	= $request->input('id_properti');
				$data->tipe_unit 	= $request->input('tipe_unit');
				$data->kategori 	= 'Pembangunan Rumah';
				$data->jenis 	= 'Borongan';
				$data->jenis_spk 	= $request->input('jenis_spk_'.$r->id);
				$data->qty 	= str_replace(",","",$request->input('qty_'.$r->id));
				$data->satuan 	= $request->input('satuan_'.$r->id);
				$data->price 	= str_replace(",","",$request->input('price_'.$r->id));
				$data->gross 	= str_replace(",","",$request->input('gross_'.$r->id));
				$data->t1 	= $request->input('t1_'.$r->id);
				$data->t2 	= $request->input('t2_'.$r->id);
				$data->t3 	= $request->input('t3_'.$r->id);
				$data->t4 	= $request->input('t4_'.$r->id);
				$data->t5 	= $request->input('t5_'.$r->id);
				$data->retensi 	= $request->input('retensi_'.$r->id); 
				$data->save();
				
			}
			 
            Session::flash('flash_message', 'Data has ben successful Edited!');
            return redirect('mrab/data/'.$request->input('id_properti'));

        }
		
								 
	}
	
	public function rabm($kode)
    { 
        $prodmast = $this->data->prodmast(); 
        $data = $this->data->rabm($kode); 

        return view('Mrab::rabm', ['prodmast' => $prodmast, 
									'kode' => $kode,
									'data' => $data 
								]);
	}
	
	public function rabmsimpan(Request $request)
    {
        $rules = array(
            'kode' => 'required|numeric',
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
 
			 $arr = array('msg' =>"Semua Form Harus diisi!!", 'status'=>false);   
			 return response()->json($arr); 
        }
        else
        {	
			$menu = Mrabmaterial::where("kode","=",$request->input('kode'));
			$menu->delete();
			
			$a = Mrab::where("kode","=",$request->input('kode'))->get();
			foreach($a as $x){
				$id_properti = $x->id_properti;
				$tipe_unit = $x->tipe_unit;
			}
			
			$i = 0;
			$prdcd = $request->input('prdcd');
			$qty = $request->input('qty');
			foreach($prdcd as $r)
			{
				$prodmast = Prodmast::findOrFail($r);
			 
				$data = new Mrabmaterial;
				$data->id_properti 	= $id_properti;
				$data->tipe_unit 	= $tipe_unit;
				$data->kode 	= $request->input('kode');
				$data->prdcd 	= $r;
				$data->qty 	= str_replace(",","",$qty[$i]);
				$data->satuan 	= $prodmast->satuan;
				$data->price 	= $prodmast->price;
				$data->gross 	= $prodmast->price * str_replace(",","",$qty[$i]);
				$data->save();	
				$i++;				
			}
			 
               
			$arr = array('msg' =>"Data Berhasil Disimpan!!", 'status'=>true);
			return response()->json($arr); 

        }

    }
	 
	/**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function settermin($kode)
    {
		$list_select = array();
       $data = Mrab::select(db::raw("mrab.*,jenis_spk.nama_spk"))
	   ->leftjoin("jenis_spk", "mrab.jenis_spk","=","jenis_spk.id")
	   ->where("kode","=",$kode)->get(); 
       
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
	   //var_dump(in_array("5", $list_select[11]));
       
	    
       return view('Mrab::setjob', 
					[
						'data' => $data, 
						'setjob' => $setjob, 
						'kode' => $kode,  
						'list_select' => $list_select						
					]
				);
				 

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function add(Request $request, $id)
    {
        $spk = $this->data->jenis_spk();
        return view('Mrab::create',['id_properti' => $id, 'spk' => $spk ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'id_properti' => 'required|numeric',
            'tipe' => 'required',

        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('mrab/create')->withErrors($validator)->withInput();
        }
        else
        {
			$cek = $this->data->cekmrab($request->input('id_properti'),$request->input('tipe'));
			if(count($cek) > 0){					
					Session::flash('flash_message', 'Master RAB Untuk Tipe Unit Tersebut Sudah Tersedia');
			}else{
				
				$spk = $this->data->jenis_spk();
				
				foreach($spk as $r){
					
					$data = new Mrab;
					$data->id_properti 	= $request->input('id_properti');
					$data->tipe_unit 	= $request->input('tipe');
					$data->kode 		= date("YmdH").rand(1000,9999);
					$data->bobot  		= $request->input('bobot_'.$r->id);
					$data->kategori 	= 'Pembangunan Rumah';
					$data->jenis 	 	= 'Borongan';
					$data->jenis_spk 	= $request->input('jenis_spk_'.$r->id);
					$data->qty 		 	= str_replace(",","",$request->input('qty_'.$r->id));
					$data->satuan 		= $request->input('satuan_'.$r->id);
					$data->price 		= str_replace(",","",$request->input('price_'.$r->id));
					$data->gross 		= str_replace(",","",$request->input('gross_'.$r->id));
					$data->t1 			= $request->input('t1_'.$r->id);
					$data->t2 			= $request->input('t2_'.$r->id);
					$data->t3 			= $request->input('t3_'.$r->id);
					$data->t4 			= $request->input('t4_'.$r->id);
					$data->t5 			= $request->input('t5_'.$r->id);
					$data->retensi 		= $request->input('retensi_'.$r->id);
					$data->created_by	= Auth::user()->name;
					$data->created_date = date("Y-m-d");
					$data->save();
				
				}
				
				Session::flash('flash_message', 'Data has ben successful Edited!');
				
			}
           
           return redirect('mrab');

        }

    }
	
	public function setterminsave(Request $request)
    {
		$rules = array(
            'kode' => 'required|numeric',

        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('mrab/create')->withErrors($validator)->withInput();
        }
        else
        {
			
			$datax = Mrab::select(db::raw("mrab.*,jenis_spk.nama_spk"))
		   ->leftjoin("jenis_spk", "mrab.jenis_spk","=","jenis_spk.id")
		   ->where("kode","=",$request->input('kode'))->get(); 
		   
			
			foreach($datax as $r){
				if(is_array($request->input('job_'.$r->id))){
					
					$menu = Mrabjob::where("kode","=",$request->input('kode')) 
					->where("id_mrab","=",$r->id);
					$menu->delete();
					

					foreach($request->input('job_'.$r->id) as $uu){
						//echo str_replace("#","", $uu)."<br/>"; 

						$data = new Mrabjob;
						$data->id_properti 	= $r->id_properti;
						$data->tipe_unit 	= $r->tipe_unit; 
						$data->kode 	= $r->kode; 
						$data->id_mrab 		= $r->id; 
						$data->id_pekerjaan       = str_replace("#","", $uu);
						$data->save();	 
						
					}
				}
			}
           
           Session::flash('flash_message', 'Data has ben successful Edited!');
           return redirect('mrab');
		}

        
	}
 
 
	public function ajukan($kode)
    {
		$this->data->ajukan($kode ); 

		Session::flash('flash_message', 'RAB Berhasil diajukan.');
		return redirect('mrab');

	}
	public function rabhapus($kode)
    {
		$this->data->nonaktifkan($kode); 

		Session::flash('flash_message', 'RAB Berhasil dinonaktifkan.');
		return redirect('mrab');

	}

}
