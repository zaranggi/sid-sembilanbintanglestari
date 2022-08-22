<?php

namespace App\Modules\Adjmaterial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
 
use App\Modules\Adjmaterial\Models\Adjmaterial;  
use App\Modules\Adjmaterial\Models\Tconst; 
use App\Modules\Adjmaterial\Models\Prodmast; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;


class AdjmaterialController extends Controller
{
	/**
    * Display a listing of the resource.
	
	
	
	
    *
    * @param Adjmaterial $data
    */

   public function __construct(Adjmaterial $data)
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
        
		return view("Adjmaterial::index", ['data' => $data]);
	   
       
    }
	
	public function create()
    {
		$data = $this->data->prodmast();  
		$docno = "";
        $const = Tconst::where("rkey","=","X")->get();
		foreach($const as $r)
		{
			$docno = $r->docno + 1;
		}
		
       return view("Adjmaterial::create", ['data' => $data,'docno' => $docno]);
	   
       
    }

     /**
    * Store a newly created resource in storage.
    * @param Request $request
    * @return Response
    */
   public function simpan(Request $request)
   {
       $rules = array(
           'docno' => 'required',
           'tanggal' => 'required', 
           'prdcd' => 'required', 

       );

       $validator =Validator::make($request->all(), $rules);

       if ($validator->fails()) { 
           
            $arr = array('msg' =>"Maaf Pengisian Form Harus Lengkap!!", 'status'=>false);                 
            return response()->json($arr); 

       }
       else
       {
          
		$tanggal  = $request->input("tanggal"); 
		$id_properti  = $request->input("id_properti"); 
		$keterangan  = $request->input("keterangan");
		$prdcd  = $request->input("prdcd");
        $qty  = $request->input("qty");  
		
        $index = 0;
		$const = Tconst::where("rkey","=","X")->get();
		foreach($const as $r)
		{
			$docno = $r->docno + 1;
		}
        
        foreach($prdcd as $r){
            $cprdcd = $r;
            $cqty = $qty[$index]; 
			
			$prod = Prodmast::findOrfail($r);
			 
            $this->data->insert_adj($cprdcd , $cqty,$prod->price, $docno, $tanggal, $keterangan);  
            $index++;
                
        } 
		$d = Tconst::findOrfail(6);
		$d->docno = $docno;
		$d->save();
		
        $arr = array('msg' =>"Data Berhasil Disimpan !!", 'status'=>true);        
        return response()->json($arr); 
            

       }
   }
   public function detail(Request $request, $id)
    {
       $data = Adjmaterial::select(db::raw("docno, tanggal, adj.prdcd, 
								qty as qty, prodmast.nama as nama_prodmast,
								prodmast.satuan,
								keterangan, adj.status, app_mgr, app_dir")) 
					->leftJoin("prodmast","adj.prdcd","=","prodmast.prdcd")
					->where("docno","=", $id)
					->get();
		
		$one = $this->data->dataone($id);
       
       return view("Adjmaterial::preview", ['data' => $data, 'one' => $one]);

    } 
	public function listprodmast(Request $request)
    {
        $data = $this->data->listprodmast($request->id);
        return response()->json($data);

    }
 
}
