<?php

namespace App\Modules\Apppayproyek\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Apppayproyek\Models\Apppayproyek; 
use App\Modules\Apppayproyek\Models\Termin;  

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ApppayproyekController extends Controller
{
        /**
     * Display a listing of the resource.
    *
    * @param Apppayproyek $data
    */

    public function __construct(Apppayproyek $data)
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
        return view('Apppayproyek::index',['data' =>$data]); 

    }
	public function detail($id)
    {
        $data = $this->data->terminnya($id);
        $detailnya = $this->data->detailnya($id);
		
		$spk = $this->data->spk($id); 
        return view('Apppayproyek::detail', ['spk' => $spk, 
											'detailnya' => $detailnya])->with('data', $data);

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
            return Redirect::to('apppayproyek')->withErrors($validator)->withInput();  
        }
        else
        {
            $data = Apppayproyek::findOrFail($request->input('id_termin'));
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
            return redirect('apppayproyek');
             

        }
    }
}
