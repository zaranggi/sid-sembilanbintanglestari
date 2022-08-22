<?php

namespace App\Modules\Realadm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Realadm\Models\Realadm;  
use App\Modules\Konsumen\Models\Konsumen; 
use App\Modules\Trxkonsumen\Models\Trxkonsumen; 
use App\Modules\Trxkonsumen\Models\Konsumenlog; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

class RealadmController extends Controller
{
      /**
  * Display a listing of the resource.
  *
  * @param Realadm $data
  */

 public function __construct(Realadm $data)
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
       return view('Realadm::index',['data' => $data]); 
    }
  
  
   /**
    * Show the form for editing the specified resource.
    * @param int $id
    * @return Response
    */
   public function edit($id)
   {
       $data =  $this->data->datasatu($id);
       
       $bank = $this->data->listbank();
       $bank_pt = $this->data->bank_pt();
       return view('Realadm::edit', ['bank_pt' => $bank_pt,
                                        'bank' => $bank])->with('data', $data) ;
   }

   /**
    * Update the specified resource in storage.
    * @param Request $request
    * @param int $id
    * @return Response
    */
   public function store(Request $request)
   {
      $rules = array( 
            'id_spr' => 'required',
            'tanggal' => 'required', 
            'gross' => 'required', 
           );

       
       $validator = Validator::make($request->all(), $rules);
       
       $id = $request->input("id_spr");

       if ($validator->fails()) {
           
            return Redirect::to('realadm/'.$id.'/edit')->withErrors($validator)->withInput();

       } else {
            
            $data = Trxkonsumen::findOrfail($request->input("id_spr"));
            $data->realisasi = "Realisasi"; 
            $data->realisasi_rp = str_replace(",","",$request->input("gross"));
            $data->tanggal_real = $request->input("tanggal");
            $data->log_kpr = "Realisasi KPR";
            $data->log_kpr_bank = $request->input("bank_pengirim");
            $data->keterangan = "Realisasi KPR";
            $data->save();

            $k = new Konsumenlog;
            $k->id_konsumen = $data->id_konsumen;
            $k->id_marketing = $data->id_marketing; 
            $k->id_properti = $data->id_properti; 
            $k->id_kav = $data->id_kav;
            $k->id_spr = $request->input('id_spr');
            $k->tanggal = date("Y-m-d"); 
            $k->status = "Realisasi KPR"; 
            $k->keterangan = "Realisasi KPR : Tanggal = ".$request->input('tanggal')." , Bank = ".$request->input('bank_pengirim')." Nama Petugas : ". Auth::user()->name; 
            $k->created_by = Auth::user()->name; 
            $k->save();
            
            Session::flash('flash_message', 'Data Berhasil Disimpan!');
            return redirect('realadm/'.$id.'/edit'); 

                 
       }
   }

  

   public function listunit(Request $request)
   {
       $data = $this->data->listunit($request->id);
       return response()->json($data);

   }

   public function unitdetail(Request $request)
   {
       $id = $request->input("query");
       
       $data = $this->data->unitdetail($id);
       return response()->json($data);

   }
}
