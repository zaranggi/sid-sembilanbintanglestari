<?php

namespace App\Modules\Bayarsubkon\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Bayarsubkon\Models\Bayarsubkon; 
use App\Modules\Bayarsubkon\Models\Termin; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
class BayarsubkonController extends Controller
{
      /**
     * Display a listing of the resource.
    *
    * @param Bayarsubkon $data
    */

    public function __construct(Bayarsubkon $data)
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
        return view('Bayarsubkon::index',['data' => $data]);
        
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
		$dd = array();
		foreach($spk as $r) {
			$id_jenis = $r->id_jenis;
			$dd[$id_jenis] = $this->data->progres($id,$id_jenis);		
			
		}

        return view('Bayarsubkon::edit',['spk' => $spk, 
												'dd' => $dd, 
												'detailnya' => $detailnya, 'id_spk' => $id])->with('data', $data);

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
            return Redirect::to('bayarsubkon/'.$request->input('id_spk').'/edit')->withErrors($validator)->withInput();  
        }
        else
        {
			$t = Termin::findOrFail($request->input('id_termin'));
			
			if(str_replace(",","",$request->input('gross')) == $t->nilai){
				
				$data = new Bayarsubkon;
				$data->id_spk           = $request->input('id_spk');
				$data->id_termin        = $request->input('id_termin'); 
				$data->tanggal 	        = $request->input('tanggal');
				$data->keterangan 	    = $request->input('keterangan');
				$data->status 	   		= 1;
				$data->created_by 	    = Auth::user()->name; 
				$data->bayar 	        = str_replace(",","",$request->input('gross'));
				$data->save();

				$pesan = "Anda memiliki Pending Approval atas Pengajuan Pembayaran Subkon / Pembangunan Unit Rumah 
Data Pembayaran
Total Pembayaran:  Rp ". $request->input('gross')."
Keterangan : ". $request->input('keterangan');
DB::table('wa')->insert([
    'pesan' => $pesan,
    'status_wa'=> 0,
]);
				Mail::send('email', ['data' => $data,'pesan' =>$pesan ], function ($message) use ($request)
				{
					$message->subject("New Approval :: Pembayaran Pembangunan Unit Rumah");
                    $message->from('admin@sembilanbintanglestari.com', 'PT Sembilan Bintang Lestari');
					$message->to("harishfauzan@gmail.com");
				});
				
				Session::flash('flash_message', 'Pengajuan Pembayaran Berhasil Disimpan!');
			
			}else{
				
				Session::flash('flash_message', 'Pengajuan Pembayaran Harus Sama Dengan Termin!');
			
			}
             
            return redirect('bayarsubkon/'.$request->input('id_spk').'/edit');
             

        }
    }
 
}
