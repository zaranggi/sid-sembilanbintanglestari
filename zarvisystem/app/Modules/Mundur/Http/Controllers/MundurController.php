<?php

namespace App\Modules\Mundur\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Mundur\Models\Mundur; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MundurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Mundur $data
     */

    public function __construct(Mundur $data)
    {
        $this->data = $data;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->listall();
        return view('Mundur::index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {     
        $data = $this->data->mou();
        return view('Mundur::create',['data' => $data]);
    }

    /**
     *
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = array(
            'id_spr' => 'required|max:255', 
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('mundur/create')->withErrors($validator)->withInput();
        }
        else
        { 
            $id_spr = $request->input('id_spr');
            $k = $this->data->datanya($id_spr);
			
			$cek = Mundur::where("id_spr","=",$id_spr)->where("status","=",1)->count();
			if($cek == 0){
				
				foreach($k as $r){
					$data = new Mundur;
					$data->id_spr 	= $id_spr;
					$data->total_tagihan 	= $r->total_tagihan;
					$data->terbayar 		= $r->terbayar;
					$data->pengembalian 	= 0;
					$data->tanggal = date("Y-m-d");
					$data->keterangan =$request->input('keterangan');
					$data->created_by = Auth::user()->name;
					$data->status = 1;
					$data->save();  
					
					$pesan = "Anda memiliki Pending Approval atas Pengajuan Konsumen Mundur <br>
					<strong>Data Konsumen</strong><br>
					<strong>Nama : </strong>". $r->nama_konsumen."<br>
					<strong>Perumahan : </strong>". $r->nama_properti."<br>
					<strong>Kavling / Tipe : </strong>". $r->nama_kav." / ".$r->tipe_unit."<br>
					<strong>Marketing : </strong>". $r->nama_marketing."<br>
					<strong>Keterangan Mundur : </strong><small>". $request->input('keterangan')."</small><br>
					";				
				}  
				Mail::send('email', ['data' => $data,'pesan' =>$pesan ], function ($message) use ($request)
				{
                    $message->subject("New Approval :: Konsumen Mundur"); 
					$message->from('admin@sembilanbintanglestari.com', 'PT Sembilan Bintang Lestari');
                    $message->to("harishfauzan@gmail.com");
                    //$message->to("donnyirianto.anggriawan@gmail.com");
				});
				Session::flash('flash_message', 'Data has ben successful Added!');	
				 return redirect('mundur');
			
			}else{
				
				Session::flash('flash_message', 'Maaf Data Pengajuan Sudah Pernah Diajukan!');	
				 return redirect('mundur');
			}
           

        }
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->data->datanya($id);

        return view('Mundur::edit',['data' => $data]);

         
    }



     /**
     * Display a listing of the resource.
     * @return Response
     */
    public function isikan(Request $request)
    {
        $id_spr = $request->input("query");
        
        $data = $this->data->datanya($id_spr);

        return response()->json($data); 
    }

 
    
}
