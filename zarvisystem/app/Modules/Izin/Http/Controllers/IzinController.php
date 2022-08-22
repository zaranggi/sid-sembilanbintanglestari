<?php

namespace App\Modules\Izin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Izin\Models\Izin; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

class IzinController extends Controller
{
	/**
	  * Display a listing of the resource.
	  *
	  * @param Izin $data
	  */

	 public function __construct(Izin $data)
	 {
		 $this->data = $data;
	 }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('Izin::index');
    } 

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
           'tanggal'           => 'required', 
           'jam_start'           => 'required', 
           'jam_end'           => 'required', 
           'keterangan'           => 'required', 
       ); 

       $validator = Validator::make($request->all(), $rules); 

       if ($validator->fails()) {

           return Redirect::to('izin')->withErrors($validator)->withInput();

       } else {
		 
           $data = new Izin;
           $data->tanggal = $request->input("tanggal"); 
           $data->jam_start = $request->input("jam_start");
           $data->jam_end = $request->input("jam_end"); 
           $data->keterangan = $request->input("keterangan");
           $data->status = 1;
           $data->id_user = Auth::user()->id;
           $data->save();  

           $pesan = "Anda memiliki Pending Approval atas Pengajuan Izin Karyawan<br>
           <strong>Data Karyawan</strong><br>
           <strong>Nama: </strong> ". Auth::user()->name."<br>
           <strong>NIK: </strong> ". Auth::user()->nik."<br>
           <strong>Tanggal Cuti: </strong> ". $request->input("tanggal")." Jam ".$request->input("jam_start")."s/d ".$request->input("jam_end")."<br>
           <strong>Keterangan : </strong><small>". $request->input('keterangan')."</small><br>
           ";				
         
           Mail::send('email', ['data' => $data,'pesan' =>$pesan ], function ($message) use ($request)
           {
               $message->subject("New Approval :: Pembayaran Proyek");
               $message->from('admin@sembilanbintanglestari.com', 'PT Sembilan Bintang Lestari');
               $message->to("harishfauzan@gmail.com");
           });
		   
           Session::flash('flash_message', 'Data Izin Berhasil Diajukan!');
           return redirect('izin');


       }
    }
}
