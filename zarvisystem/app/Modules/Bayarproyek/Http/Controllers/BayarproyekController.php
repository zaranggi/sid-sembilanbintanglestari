<?php

namespace App\Modules\Bayarproyek\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Bayarproyek\Models\Bayarproyek; 
use App\Modules\Bayarproyek\Models\Termin; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;
class BayarproyekController extends Controller
{
      /**
     * Display a listing of the resource.
    *
    * @param Docproperti $data
    */

    public function __construct(Bayarproyek $data)
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
        return view('Bayarproyek::index',['data' => $data]);
        
    }

      
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->data->terminnya($id);
        $detailnya = $this->data->detailnya($id);
		
		$spk = $this->data->spk($id); 
        return view('Bayarproyek::edit',['spk' => $spk,  
											'detailnya' => $detailnya, 
											'id_spk' => $id])->with('data', $data);

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
            'id_termin' => 'required|numeric',
            'id_spk' => 'required',
            'tanggal' => 'required', 
            'gross' => 'required', 
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) { 
            return Redirect::to('bayarproyek/'.$request->input('id_spk').'/edit')->withErrors($validator)->withInput();  
        }
        else
        {
			$t = Termin::findOrFail($request->input('id_termin'));
			
			if(str_replace(",","",$request->input('gross')) == $t->nilai){
				
				$data = new Bayarproyek;
				$data->id_spk           = $request->input('id_spk');
				$data->id_termin        = $request->input('id_termin'); 
				$data->tanggal 	        = $request->input('tanggal');
				$data->keterangan 	    = $request->input('keterangan');
				$data->status 	   		= 1;
				$data->created_by 	    = Auth::user()->name; 
				$data->bayar 	        = str_replace(",","",$request->input('gross'));
				$data->save();
				$pesan = "Anda memiliki Pending Approval atas Pengajuan Pembayaran Proyek
Data Pembayaran
Total Pembayaran:Rp ". $request->input('gross')."
Keterangan :". $request->input('keterangan');
                $this->data->insertwa($pesan);	
			  
				Mail::send('email', ['data' => $data,'pesan' =>$pesan ], function ($message) use ($request)
				{
					$message->subject("New Approval :: Pembayaran Proyek");
                    $message->from('admin@sembilanbintanglestari.com', 'PT Sembilan Bintang Lestari');
					$message->to("harishfauzan@gmail.com");
				});
				Session::flash('flash_message', 'Pengajuan Pembayaran Berhasil Disimpan!');
			
			}else{
				
				Session::flash('flash_message', 'Pengajuan Pembayaran Harus Sama Dengan Termin!');
			
			}
             
            return redirect('bayarproyek/'.$request->input('id_spk').'/edit');
             

        }
    }
 
}
