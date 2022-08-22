<?php

namespace App\Modules\Mrabr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Mrabr\Models\Mrabr;
use App\Modules\Mrabr\Models\Mrabrdetail;
use App\Modules\Mrabr\Models\Mrabrjob;
use App\Modules\Mrabr\Models\Mrabrmaterial;
use App\Modules\Mrabr\Models\Prodmastr;
use App\Modules\Munit\Models\Munit;
use App\Modules\Trxkonsumen\Models\Trxkonsumen;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MrabrController extends Controller
{
    /* Display a listing of the resource.
    *
    * @param mrabr $data
    */

   public function __construct(Mrabr $data)
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
       
       return view('Mrabr::index', ['data' =>$data ]);

   }

    /**
    * Display a listing of the resource.
    * @return Response
    */

    public function data(Request $request, $id)
    {
 
        $properti = $this->data->namaproperti($id);
        $data = Mrabr::select(db::raw("mrab_proyek.*, properti_kav.nama as nama_kav, properti_kav.tipe as tipe_unit"))
				->leftjoin("properti_kav","mrab_proyek.id_kav","=","properti_kav.id")
				->where("mrab_proyek.id_properti","=",$id)
				->where("mrab_proyek.kategori","=","Revisi")
                ->OrderBy("mrab_proyek.id","DESC")->get(); 
 
        return view('Mrabr::data', ['data' =>$data, 
									'properti' => $properti, 
									'id_properti' => $id 
								]);
 
    }
	
	/**
    * Show the form for creating a new resource.
    * @return Response
    */
   public function add(Request $request, $id)
   {
       /*
		$kav  =  Trxkonsumen::select(db::raw("properti_kav.id, properti_kav.nama as nama_kav, properti_kav.tipe as tipe_unit"))
					->leftjoin("properti_kav","konsumen_spr.id_kav","=", "properti_kav.id")
					->where("konsumen_spr.id_properti","=",$id)
					->OrderBy("properti_kav.id", "ASC")
					->get();
					*/
		$kav  = Munit::select(db::raw("id, nama as nama_kav, tipe as tipe_unit"))
				->where("id_properti","=",$id)->OrderBy("id", "ASC")->get();		
       return view('Mrabr::create',['id_properti' => $id, 'kav' => $kav]);
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
		   'judul' => 'required', 
		   'hari' => 'required|numeric', 
		   'pekerja' => 'required|numeric', 
		   'gross' => 'required', 
       );

       $validator =Validator::make($request->all(), $rules);

       if ($validator->fails()) {

           return Redirect::to('mrabr/add/'.$request->input('id_properti'))->withErrors($validator)->withInput();
       }
       else
       { 
               
               $data = new Mrabr;
               $data->id_properti 	= $request->input('id_properti'); 
               $data->id_kav 	= $request->input('id_kav'); 
               $data->judul 	= $request->input('judul'); 
               $data->hari 	= $request->input('hari'); 
               $data->pekerja 	= $request->input('pekerja'); 
               $data->satuan 	= $request->input('satuan'); 
               $data->qty 	=  str_replace(",","",$request->input('qty')); 
               $data->bobot  		= 100;
               $data->kategori 		= 'Revisi';
               $data->jenis 	 	= 'Borongan';  
               $data->gross 		= str_replace(",","",$request->input('gross'));
               $data->t1 			= $request->input('t1');
               $data->t2 			= $request->input('t2');
               $data->t3 			= $request->input('t3');
               $data->t4 			= $request->input('t4');
               $data->t5 			= $request->input('t5');
               $data->retensi 		= $request->input('retensi');
               $data->created_by	= Auth::user()->name;
               $data->created_date = date("Y-m-d");
               $data->save();
           
          
           Session::flash('flash_message', 'Data has ben successful Added!');
          return Redirect::to('mrabr/data/'.$request->input('id_properti'));

       }

   }


   public function view($id)
   { 
       
       $material = $this->data->rabm($id); 
	   
       $setjob = $this->data->viewjob($id);
      
       $data = Mrabr::findOrFail($id);
       
        
       return view('Mrabr::view', [ 
                                   'id' => $id,
                                   'material' => $material,
                                   'setjob' =>$setjob								
                               ])->with('data', $data);
                                
   }
   
  
   public function ubah($id)
   {
       
		$data = Mrabr::findOrFail($id);
	    $kav  =  Trxkonsumen::select(db::raw("properti_kav.id, properti_kav.nama as nama_kav, properti_kav.tipe as tipe_unit"))
					->leftjoin("properti_kav","konsumen_spr.id_kav","=", "properti_kav.id")
					->where("konsumen_spr.id_properti","=",$data->id_properti)
					->OrderBy("properti_kav.id", "ASC")
					->get();
        
       return view('Mrabr::ubah',['kav' => $kav])->with('data', $data);
                                
   }
   
   public function ubahsimpan(Request $request)
   {
       $rules = array(  
		   'judul' => 'required', 
		   'id_kav' => 'required|numeric', 
		   'hari' => 'required|numeric', 
		   'pekerja' => 'required|numeric', 
		   'gross' => 'required', 
       );

       $validator =Validator::make($request->all(), $rules);

       if ($validator->fails()) {

           return Redirect::to('mrabr/ubah/'.$request->input('id'))->withErrors($validator)->withInput();
       }
       else
       {    
		    $data = Mrabr::findOrFail($request->input('id'));
		    $data->judul 		= $request->input('judul'); 
		    $data->id_kav 		= $request->input('id_kav'); 
		    $data->hari 		= $request->input('hari'); 
		    $data->pekerja 		= $request->input('pekerja'); 
		    $data->satuan 		= $request->input('satuan'); 
		    $data->qty 			=  str_replace(",","",$request->input('qty')); 
		    $data->bobot  		= 100;
		    $data->kategori 	= 'Revisi';
		    $data->jenis 	 	= 'Borongan';  
		    $data->gross 		= str_replace(",","",$request->input('gross'));
		    $data->t1 			= $request->input('t1');
		    $data->t2 			= $request->input('t2');
		    $data->t3 			= $request->input('t3');
		    $data->t4 			= $request->input('t4');
		    $data->t5 			= $request->input('t5');
		    $data->retensi 		= $request->input('retensi');
		    $data->created_by	= Auth::user()->name;
		    $data->created_date = date("Y-m-d");
		    $data->save();
          
           Session::flash('flash_message', 'Data has ben successful Edited!');
		   return Redirect::to('mrabr/data/'.$data->id_properti);

       }
       
                                
   }
   
   public function rabm($id)
   { 
       $prodmast = $this->data->prodmast(); 
       $data = $this->data->rabm($id); 
		
       return view('Mrabr::rabm', [	'prodmast' => $prodmast,
									'data' => $data,
									'id' => $id								   
                               ]);
							    
   }
   
   public function rabmsimpan(Request $request)
   {
       $rules = array(
           'id' => 'required|numeric',
       );

       $validator =Validator::make($request->all(), $rules);

       if ($validator->fails()) {
 
			 $arr = array('msg' =>"Semua Form Harus diisi!!", 'status'=>false);   
			 return response()->json($arr); 
       }
       else
       {
			$menu = Mrabrmaterial::where("id_mrabr","=",$request->input('id'));
			$menu->delete();
			
			$i = 0;
			$prdcd = $request->input('prdcd');
			$qty = $request->input('qty');
			foreach($prdcd as $r)
			{
				$prodmast = Prodmastr::findOrFail($r);
			 
				$data = new Mrabrmaterial;
				$data->id_mrabr 	= $request->input('id');
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
   public function settermin($id)
   { 
		$job = $this->data->listjobproyek();
       $data = Mrabrjob::select(db::raw("mrab_job_proyek.*, jenis_progres_proyek.nama"))
					->leftjoin("jenis_progres_proyek", "mrab_job_proyek.id_pekerjaan","jenis_progres_proyek.id")
					->where("mrab_job_proyek.id_mrabp","=",$id)
					->orderby("mrab_job_proyek.id","ASC")
                    ->get();
       
       
      return view('Mrabr::setjob', 
                   [
                       'data' => $data, 
                       'job' => $job, 
                       'id' => $id
                   ]
               );
                

   }

   
   
   public function setterminsave(Request $request)
   {
       $rules = array(
           'id' => 'required',
       );

       $validator =Validator::make($request->all(), $rules);

       if ($validator->fails()) { 
			$arr = array('msg' =>"Semua Form Harus diisi!!", 'status'=>false);
			return response()->json($arr);  
       }
       else
       {
			$id =  $request->input('id');
			$x = mrabrjob::where("id_mrabp","=",$id);
			$x->delete();
            
            $id_pekerjaan =  $request->input('id_pekerjaan');
            $bobot =  $request->input('bobot');
            $i  = 0;
			foreach($id_pekerjaan as $r){ 
				
			    $data = new Mrabrjob;
			    $data->id_mrabp 		= $id;
			    $data->id_pekerjaan 	= $r; 
			    $data->bobot       = str_replace(",","", $bobot[$i]);
			    $data->save();	 
				$i++;
			}
           
			$arr = array('msg' =>"Data Berhasil Disimpan!!", 'status'=>true);
			return response()->json($arr);  
       }

       
   }


   public function ajukan($id_properti,$id)
   {
       $this->data->ajukan($id); 

       Session::flash('flash_message', 'RAB Berhasil diajukan.');
       return redirect('mrabr/data/'.$id_properti);

   }


}
