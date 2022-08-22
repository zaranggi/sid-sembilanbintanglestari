<?php

namespace App\Modules\Cuti\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Cuti\Models\Cuti; 
use App\Modules\Cuti\Models\Cutisaldo; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use App\Helpers\Tanggal;

use Illuminate\Support\Facades\Mail;
class CutiController extends Controller
{
	/**
	  * Display a listing of the resource.
	  *
	  * @param Cuti $data
	  */

	 public function __construct(Cuti $data)
	 {
		 $this->data = $data;
	 }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('Cuti::index');
    } 

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
           'jenis_cuti'           => 'required', 
           'tanggal1'           => 'required', 
           'tanggal2'           => 'required', 
           'keterangan'           => 'required', 
       ); 

       $validator = Validator::make($request->all(), $rules); 

       if ($validator->fails()) {

           return Redirect::to('cuti')->withErrors($validator)->withInput();

       } else {

        $tcuti = Tanggal::selisih_hari2($request->input("tanggal1"),$request->input("tanggal2"));
                                     
        $cek = Cutisaldo::findOrFail(Auth::user()->id);
        $saldo = $cek->saldo_akh;
        if(($saldo - $tcuti) >= 0 OR $request->input("jenis_cuti") <> "Cuti Melahirkan" ){
            $data = new Cuti;
            $data->jenis_cuti = $request->input("jenis_cuti");
            $data->tanggal_start = $request->input("tanggal1");
            $data->tanggal_end = $request->input("tanggal2"); 
            $data->keterangan = $request->input("keterangan");
            $data->total_cuti = $tcuti;
            $data->status = 1;
            $data->id_user = Auth::user()->id;
            $data->save();  
            
            Session::flash('flash_message', 'Data Cuti Berhasil Diajukan!');
            $pesan = "Anda memiliki Pending Approval atas Pengajuan Cuti Karyawan<br>
				<strong>Data Karyawan</strong><br>
				<strong>Nama: </strong> ". Auth::user()->name."<br>
				<strong>NIK: </strong> ". Auth::user()->nik."<br>
				<strong>Tanggal Cuti: </strong> ". $request->input("tanggal1")." s/d ".$request->input("tanggal2")."<br>
				<strong>Keterangan : </strong><small>". $request->input('keterangan')."</small><br>
				";				
			  
				Mail::send('email', ['data' => $data,'pesan' =>$pesan ], function ($message) use ($request)
				{
					$message->subject("New Approval :: Pembayaran Proyek");
                    $message->from('admin@sembilanbintanglestari.com', 'PT Sembilan Bintang Lestari');
					$message->to("harishfauzan@gmail.com");
                });
                
        }elseif($request->input("jenis_cuti") == "Cuti Melahirkan"){
            $data = new Cuti;
            $data->jenis_cuti = $request->input("jenis_cuti");
            $data->tanggal_start = $request->input("tanggal1");
            $data->tanggal_end = $request->input("tanggal2"); 
            $data->keterangan = $request->input("keterangan");
            $data->total_cuti = $tcuti;
            $data->status = 1;
            $data->id_user = Auth::user()->id;
            $data->save();  
            
            Session::flash('flash_message', 'Data Cuti Berhasil Diajukan!');
            $pesan = "Anda memiliki Pending Approval atas Pengajuan Cuti Karyawan<br>
            <strong>Data Karyawan</strong><br>
            <strong>Nama: </strong> ". Auth::user()->name."<br>
            <strong>NIK: </strong> ". Auth::user()->nik."<br>
            <strong>Tanggal Cuti: </strong> ". $request->input("tanggal1")." s/d ".$request->input("tanggal2")."<br>
            <strong>Keterangan : </strong><small>". $request->input('keterangan')."</small><br>
            ";				
          
            Mail::send('email', ['data' => $data,'pesan' =>$pesan ], function ($message) use ($request)
            {
                $message->subject("New Approval :: Pembayaran Proyek");
                $message->from('admin@sembilanbintanglestari.com', 'PT Sembilan Bintang Lestari');
                $message->to("harishfauzan@gmail.com");
            });
            
           
        }else{
            Session::flash('flash_message', 'Saldo Cuti Tidak Mencukupi!');
        }
           
           return redirect('cuti');


       }
    }

     
}
