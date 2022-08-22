<?php

namespace App\Modules\Materialkeluar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Materialkeluar\Models\Materialkeluar; 
use App\Modules\Materialkeluar\Models\Stmast; 
use App\Modules\Materialkeluar\Models\Tconst; 
use App\Modules\Munit\Models\Munit; 
use App\Modules\Spkproyek\Models\Spkproyek;
use App\Modules\Spkrevisi\Models\Spkrevisi; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialkeluarController extends Controller
{
	 /**
     * Display a listing of the resource.
     *
     * @param Material $data
     */

    public function __construct(Materialkeluar $data)
    {
        $this->data = $data;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(){
   
        return view('Materialkeluar::index');
    }

	/**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function unit()
    {
		$properti = $this->data->listproperti();
		$prodmast = Materialkeluar::all();
		$list = $this->data->listunittemp();
		$const = Tconst::where("rkey","=","J")->get();
		foreach($const as $r)
		{
			$docno = $r->docno + 1;
		}
		
		return view('Materialkeluar::unit', ['docno'=>$docno, 'prodmast' => $prodmast, 'list' =>$list, 'listproperti' => $properti]);
    }
	 
	
	public function unitsimpan(Request $request)
    {
		$id_properti  = $request->input("id_properti"); 
		$id_kav  = $request->input("id_kav"); 
		$tanggal  = $request->input("tanggal"); 
		$keterangan  = $request->input("keterangan");
		$prdcd  = $request->input("prdcd");
        $qty  = $request->input("qty");
		
		$const = Tconst::where("rkey","=","J")->get();
		foreach($const as $r)
		{
			$docno = $r->docno + 1;
		}
		
        
        $d = Munit::findOrfail($id_kav);
		
        $index = 0;
        $tacuan  = count($prdcd);
        foreach($prdcd as $r){
            $cprdcd = $r;
            $cqty = $qty[$index];

            $cek = $this->data->cekplu( $cprdcd , $cqty, $id_properti, $id_kav, $d->tipe);
            
            if($cek == 0){
                $arr = array('msg' =>"Maaf Item dengan Kode $cprdcd Telah Melebihi Batas Maximum!!", 'status'=>false);
                
                break;
            }elseif($cek == 1){
                $arr = array('msg' =>"Maaf Item Stock $cprdcd Tidak Mencukupi!!", 'status'=>false);
                
                break;
            }elseif($cek == 2){
                $arr = array('msg' =>"Maaf Item $cprdcd Tidak masuk dalam RAB!!", 'status'=>false);
                
                break;
            }else{
                $arr = array('msg' =>"Data Berhasil disimpan!!", 'status'=>true);
            }

            $index++;

        }

        if($tacuan == $index){
            $index2 = 0;
            foreach($prdcd as $r){
                $cprdcd = $r;
                $cqty = $qty[$index2];
    
                $cek = $this->data->insert_mstran( $cprdcd , $cqty, $id_properti, $id_kav, $d->tipe, $docno, $tanggal, $keterangan);  
                $index2++;
            }
			$d = Tconst::findOrfail(2);
			$d->docno = $docno;
			$d->save();
		
        }
		


        return response()->json($arr); 
        
		
		//return Redirect::to('materialkeluar');
    }
	
	 /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function fasum()
    {
		$listproyek = $this->data->listproyek();
		$prodmast = Materialkeluar::all();
		$const = Tconst::where("rkey","=","J")->get();
		foreach($const as $r)
		{
			$docno = $r->docno + 1;
		}
		return view('Materialkeluar::fasum', ['docno'=> $docno, 'prodmast' => $prodmast, 'listproyek' => $listproyek ]);
        
    }
	
	public function fasumsimpan(Request $request)
    {
		$id_spk  = $request->input("id_spk");  
		$tanggal  = $request->input("tanggal"); 
		$keterangan  = $request->input("keterangan");
		$prdcd  = $request->input("prdcd");
        $qty  = $request->input("qty");
		
        $const = Tconst::where("rkey","=","J")->get();
		foreach($const as $r)
		{
			$docno = $r->docno + 1;
		}
		
		$u = Spkproyek::findOrfail($id_spk);
		
        $index = 0;
        $tacuan  = count($prdcd);
        foreach($prdcd as $r){
            $cprdcd = $r;
            $cqty = $qty[$index];

            $cek = $this->data->cekplufasum( $cprdcd , $cqty, $u->id_mrabp, $id_spk);
            
             if($cek == 0){
                $arr = array('msg' =>"Maaf Item dengan Kode $cprdcd Telah Melebihi Batas Maximum!!", 'status'=>false);
                
                break;
            }elseif($cek == 1){
                $arr = array('msg' =>"Maaf Item Stock $cprdcd Tidak Mencukupi!!", 'status'=>false);
                
                break;
            }elseif($cek == 2){
                $arr = array('msg' =>"Maaf Item $cprdcd Tidak masuk dalam RAB!!", 'status'=>false);
                
                break;
            }else{
                $arr = array('msg' =>"Data Berhasil disimpan!!", 'status'=>true);
            }

            $index++;

        }

        if($tacuan == $index){
            $index2 = 0;
            foreach($prdcd as $r){
                $cprdcd = $r;
                $cqty = $qty[$index2];
    
                $cek = $this->data->insert_mstran_fasum( $cprdcd , $cqty, $u->id_properti, $id_spk, $docno, $tanggal, $keterangan);  
                $index2++;
            }
			$d = Tconst::findOrfail(2);
			$d->docno = $docno;
			$d->save();
        }
		 
        return response()->json($arr); 
        
		
		//return Redirect::to('materialkeluar');
    }
	
	
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function revisi()
    {
		$listproyek = $this->data->listproyekrev();
		$prodmast = Materialkeluar::all();
		$const = Tconst::where("rkey","=","J")->get();
		foreach($const as $r)
		{
			$docno = $r->docno + 1;
		}
		return view('Materialkeluar::revisi', ['docno'=>$docno, 'prodmast' => $prodmast, 'listproyek' => $listproyek ]);
        
    }
	
	public function revisisimpan(Request $request)
    {
		$id_spk  = $request->input("id_spk");  
		$tanggal  = $request->input("tanggal"); 
		$keterangan  = $request->input("keterangan");
		$prdcd  = $request->input("prdcd");
        $qty  = $request->input("qty");
		
		$const = Tconst::where("rkey","=","J")->get();
		foreach($const as $r)
		{
			$docno = $r->docno + 1;
		}
        
		$u = Spkrevisi::findOrfail($id_spk);
		
        $index = 0;
        $tacuan  = count($prdcd);
        foreach($prdcd as $r){
            $cprdcd = $r;
            $cqty = $qty[$index];

            $cek = $this->data->cekplurevisi( $cprdcd , $cqty, $u->id_mrabp, $id_spk);
            
             if($cek == 0){
                $arr = array('msg' =>"Maaf Item dengan Kode $cprdcd Telah Melebihi Batas Maximum!!", 'status'=>false);
                
                break;
            }elseif($cek == 1){
                $arr = array('msg' =>"Maaf Item Stock $cprdcd Tidak Mencukupi!!", 'status'=>false);
                
                break;
            }elseif($cek == 2){
                $arr = array('msg' =>"Maaf Item $cprdcd Tidak masuk dalam RAB!!", 'status'=>false);
                
                break;
            }else{
                $arr = array('msg' =>"Data Berhasil disimpan!!", 'status'=>true);
            }

            $index++;

        }

        if($tacuan == $index){
            $index2 = 0;
            foreach($prdcd as $r){
                $cprdcd = $r;
                $cqty = $qty[$index2];
    
                $cek = $this->data->insert_mstran_revisi( $cprdcd , $cqty, $u->id_properti,$u->id_kav, $id_spk, $docno, $tanggal, $keterangan);  
                $index2++;
            }
			$d = Tconst::findOrfail(2);
			$d->docno = $docno;
			$d->save();
        }
		

        return response()->json($arr); 
        
		
		//return Redirect::to('materialkeluar');
    }
	
	
	public function listunit(Request $request)
    {
        $data = $this->data->listunit($request->id);
        return response()->json($data);

    }

  
}
