<?php

namespace App\Modules\Pomaterial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
 
use App\Modules\Pomaterial\Models\Pomaterial; 
use App\Modules\Dafrekanan\Models\Dafrekanan; 
use App\Modules\Pomaterial\Models\Tconst; 
use App\Modules\Pomaterial\Models\Prodmast; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;


class PomaterialController extends Controller
{
	/**
    * Display a listing of the resource.
	
	
	
	
    *
    * @param Pomaterial $data
    */

   public function __construct(Pomaterial $data)
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
        
		return view("Pomaterial::index", ['data' => $data]);
	   
       
    }
	
	public function create()
    {
		$data = $this->data->prodmast();
		$perumahan = $this->data->perumahan();
        $rekanan = Dafrekanan::where("status","=","Y")->get();
		$docno = "";
        $const = Tconst::where("rkey","=","PO")->get();
		foreach($const as $r)
		{
			$docno = $r->docno + 1;
		}
		
       return view("Pomaterial::create", ['perumahan' => $perumahan, 'data' => $data,'rekanan' => $rekanan, 'docno' => $docno]);
	   
       
    }

     /**
    * Store a newly created resource in storage.
    * @param Request $request
    * @return Response
    */
   public function simpan(Request $request)
   {
       $rules = array(
           'dari' => 'required|max:255',
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
          
		$dari  = $request->input("dari"); 
		$tanggal  = $request->input("tanggal"); 
		$id_properti  = $request->input("id_properti"); 
		$keterangan  = $request->input("keterangan");
		$prdcd  = $request->input("prdcd");
        $qty  = $request->input("qty"); 
        $pembayaran  = $request->input("pembayaran"); 
		
        $index = 0;
		$const = Tconst::where("rkey","=","PO")->get();
		foreach($const as $r)
		{
			$docno = $r->docno + 1;
		}
        
        foreach($prdcd as $r){
            $cprdcd = $r;
            $cqty = $qty[$index];
            $cpembayaran = $pembayaran[$index];
			
			$prod = Prodmast::findOrfail($r);
			if($cpembayaran == "Cash"){
				$price = $prod->price;
			}else{
				$price = $prod->tempo;
			}
            $this->data->insert_po( $id_properti, $cprdcd , $cqty,$price,$cpembayaran, $dari, $docno, $tanggal, $keterangan);  
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
       $data = Pomaterial::select(db::raw("docno, tanggal, po.prdcd, 
								qty as qty, rekanan.nama as dari, prodmast.nama as nama_prodmast,
								prodmast.satuan,
								keterangan, po.status, app_mgr, app_dir"))
					->leftJoin("rekanan","po.dari","=","rekanan.id")
					->leftJoin("prodmast","po.prdcd","=","prodmast.prdcd")
					->where("docno","=", $id)
					->get();
		
		$one = $this->data->dataone($id);
       
       return view("Pomaterial::preview", ['data' => $data, 'one' => $one]);

    } 
	public function listprodmast(Request $request)
    {
        $data = $this->data->listprodmast($request->id);
        return response()->json($data);

    }
 
}
