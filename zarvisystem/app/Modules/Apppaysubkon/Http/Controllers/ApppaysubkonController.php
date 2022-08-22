<?php

namespace App\Modules\Apppaysubkon\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Apppaysubkon\Models\Apppaysubkon; 
use App\Modules\Apppaysubkon\Models\Termin;  

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class ApppaysubkonController extends Controller
{
        /**
     * Display a listing of the resource.
    *
    * @param Apppaysubkon $data
    */

    public function __construct(Apppaysubkon $data)
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
        return view('Apppaysubkon::index',['data' =>$data]); 

    }
	public function detail($id)
    {
        $data = $this->data->terminnya($id);
        $detailnya = $this->data->detailnya($id);
		
		$spk = $this->data->spk($id);
		$dd = array();
		foreach($spk as $r) {
			$id_jenis = $r->id_jenis;
			$dd[$id_jenis] = $this->data->progres($id,$id_jenis);		
			
		}
		
        return view('Apppaysubkon::detail', ['spk' => $spk, 
												'dd' => $dd, 'detailnya' => $detailnya])->with('data', $data);

    }
 

/**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function simpanbayar(Request $request)
    {
        $rules = array(
            'id_termin' => 'required|numeric'
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) { 
            return Redirect::to('apppaysubkon')->withErrors($validator)->withInput();  
        }
        else
        {
            $data = Apppaysubkon::findOrFail($request->input('id_termin'));
            $data->keterangan_app 	    = $request->input('keterangan');
            $data->tanggal_app = date("Y-m-d");
            $data->status = $request->input('status');            
            $data->app_by 	    = Auth::user()->name; 
            $data->save();

            //$uhu = Termin::findOrFail($data->id_termin);
            //$uhu->status = 0;
            //$uhu->tgl_bayar = date("Y-m-d");
            //$uhu->jumlah_bayar = $uhu->jumlah_bayar + $data->bayar;            
            //$uhu->save(); 

            //$this->data->updspk($data->id_spk);
			

            Session::flash('flash_message', 'Data Approval Pembayaran Berhasil Disimpan!');
            return redirect('apppaysubkon');
             

        }
    }
}
