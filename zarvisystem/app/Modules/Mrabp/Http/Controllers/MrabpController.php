<?php

namespace App\Modules\Mrabp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Mrabp\Models\Mrabp;
use App\Modules\Mrabp\Models\Mrabpdetail;
use App\Modules\Mrabp\Models\Mrabpjob;
use App\Modules\Mrabp\Models\Mrabpmaterial;
use App\Modules\Mrabp\Models\Prodmastp;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MrabpController extends Controller
{
    /* Display a listing of the resource.
    *
    * @param Mrabp $data
    */

   public function __construct(Mrabp $data)
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
       
       return view('Mrabp::index', ['data' =>$data ]);

   }

    /**
    * Display a listing of the resource.
    * @return Response
    */

    public function data(Request $request, $id)
    {
 
        $properti = $this->data->namaproperti($id);
        $data = Mrabp::where("id_properti","=",$id)
				->where("kategori","=","Proyek")
                ->OrderBy("id","DESC")->get(); 
 
        return view('Mrabp::data', ['data' =>$data, 
									'properti' => $properti, 
									'id_properti' => $id 
								]);
 
    }


   public function view($id)
   { 
       
       $material = $this->data->rabm($id); 
	   
       $setjob = $this->data->viewjob($id);
      
       $data = Mrabp::findOrFail($id);
       
        
       return view('Mrabp::view', [ 
                                   'id' => $id,
                                   'material' => $material,
                                   'setjob' =>$setjob								
                               ])->with('data', $data);
                                
   }
   
  
   public function ubah($id)
   {
       
       $data = Mrabp::findOrFail($id);
        
       return view('Mrabp::ubah')->with('data', $data);
                                
   }
   
   public function ubahsimpan(Request $request)
   {
       $rules = array(  
		   'judul' => 'required', 
		   'hari' => 'required|numeric', 
		   'pekerja' => 'required|numeric', 
		   'gross' => 'required', 
       );

       $validator =Validator::make($request->all(), $rules);

       if ($validator->fails()) {

           return Redirect::to('mrabp/ubah/'.$request->input('id'))->withErrors($validator)->withInput();
       }
       else
       {    
		    $data = Mrabp::findOrFail($request->input('id'));
		    $data->judul 		= $request->input('judul'); 
		    $data->hari 		= $request->input('hari'); 
		    $data->pekerja 		= $request->input('pekerja'); 
		    $data->satuan 		= $request->input('satuan'); 
		    $data->qty 			=  str_replace(",","",$request->input('qty')); 
		    $data->bobot  		= 100;
		    $data->kategori 	= 'Proyek';
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
		   return Redirect::to('mrabp/data/'.$data->id_properti);

       }
       
                                
   }
   
   public function rabm($id)
   { 
       $prodmast = $this->data->prodmast(); 
       $data = $this->data->rabm($id); 
		
       return view('Mrabp::rabm', [	'prodmast' => $prodmast,
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
			$menu = Mrabpmaterial::where("id_mrabp","=",$request->input('id'));
			$menu->delete();
			
			$i = 0;
			$prdcd = $request->input('prdcd');
			$qty = $request->input('qty');
			foreach($prdcd as $r)
			{
				$prodmast = Prodmastp::findOrFail($r);
			 
				$data = new Mrabpmaterial;
				$data->id_mrabp 	= $request->input('id');
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
       $data = Mrabpjob::select(db::raw("mrab_job_proyek.*, jenis_progres_proyek.nama"))
					->leftjoin("jenis_progres_proyek", "mrab_job_proyek.id_pekerjaan","jenis_progres_proyek.id")
					->where("mrab_job_proyek.id_mrabp","=",$id)
					->orderby("mrab_job_proyek.id","ASC")
                    ->get();
       
       
      return view('Mrabp::setjob', 
                   [
                       'data' => $data, 
                       'job' => $job, 
                       'id' => $id
                   ]
               );
                

   }

   /**
    * Show the form for creating a new resource.
    * @return Response
    */
   public function add(Request $request, $id)
   {
        
       return view('Mrabp::create',['id_properti' => $id]);
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

           return Redirect::to('mrabp/add/'.$request->input('id_properti'))->withErrors($validator)->withInput();
       }
       else
       { 
               
               $data = new Mrabp;
               $data->id_properti 	= $request->input('id_properti'); 
               $data->judul 	= $request->input('judul'); 
               $data->hari 	= $request->input('hari'); 
               $data->pekerja 	= $request->input('pekerja'); 
               $data->satuan 	= $request->input('satuan'); 
               $data->qty 	=  str_replace(",","",$request->input('qty')); 
               $data->bobot  		= 100;
               $data->kategori 		= 'Proyek';
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
          return Redirect::to('mrabp/data/'.$request->input('id_properti'));

       }

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
			$x = Mrabpjob::where("id_mrabp","=",$id);
			$x->delete();
            
            $id_pekerjaan =  $request->input('id_pekerjaan');
            $bobot =  $request->input('bobot');
            $i  = 0;
			foreach($id_pekerjaan as $r){ 
				
			    $data = new Mrabpjob;
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
       return redirect('mrabp/data/'.$id_properti);

   }


}
