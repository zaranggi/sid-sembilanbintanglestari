<?php

namespace App\Modules\Materialmasuk\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
 
use App\Modules\Materialmasuk\Models\Materialmasuk; 
use App\Modules\Dafrekanan\Models\Dafrekanan; 
use App\Modules\Apppo\Models\Apppo; 
use App\Modules\Apppo\Models\Pobayar;
 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;

class MaterialmasukController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @param Materialmasuk $data
    */

   public function __construct(Materialmasuk $data)
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
        return view('Materialmasuk::index',['data' =>$data]);  
    }

   /**
    * Display a listing of the resource.
    * @return Response
    */
   public function terima($docno, $cb)
   {
        $data = $this->data->detail($docno,$cb);
        $dd = $this->data->rekap($docno,$cb);
       
       return view("materialmasuk::terima", ['data' => $data, 'dd' => $dd]);

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
           'cb' => 'required',
           'tanggal' => 'required', 

       );

       $validator =Validator::make($request->all(), $rules);

       if ($validator->fails()) { 
           
            $arr = array('msg' =>"Maaf Pengisian Form Harus Lengkap!!", 'status'=>false);                 
            return response()->json($arr); 

       }
       else
       {
          
		$cb  = $request->input("cb"); 
		$docno  = $request->input("docno"); 
		$tanggal  = $request->input("tanggal"); 
		$keterangan  = $request->input("keterangan"); 
		 
        $data = $this->data->detail($docno,$cb);
        
		foreach($data as $r){
            $prdcd = $r->prdcd;
            $po_price = $r->harga;
            $po_qty = $r->qty;
            $cb = $r->pembayaran;
            $tanggal_po = $r->tanggal;
            $nama_rekanan = $r->nama_rekanan;
            $price =  str_replace(",","",$request->input("price_".$prdcd)); 
            $qty 	=  str_replace(",","",$request->input("qty_".$prdcd)); 
            $dari 	=  $r->dari;
            $id_properti 	=  $r->id_properti; 
			$gross = $price * $qty;
			
			if($qty > 0 && $price > 0){
				$this->data->insert_mstran($id_properti,$price, $prdcd , $qty, $gross, $docno, $nama_rekanan, $dari, $tanggal, $tanggal_po, $keterangan, $po_price, $po_qty,$cb);
			}
                
        }
		
		
        $arr = array('msg' =>"Data Berhasil Disimpan !!", 'status'=>true);        
        return response()->json($arr); 
            

       }
   }
 

}
