<?php

namespace App\Modules\Thr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Thr\Models\Thr; 
use App\Modules\Users\Models\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

class ThrController extends Controller
{
    
    /* Display a listing of the resource.
     *
     * @param Gl $data
     */

    public function __construct(Thr $data)
    {
        $this->data = $data;
    }
    
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Thr::select(DB::raw("periode,sum(total) as total,
                                count(*) as tkaryawan,
                                keterangan,
                                if(app=1,'Pengajuan',if(app = 2,'Di Setujui','Di Tolak')) as status,
                                tgl_app,created_by,tanggal"))
                            ->groupBy('periode')->OrderBy("periode","desc")->get();
        return view('Thr::index', ['data' => $data]); 
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data_user = Users::All();
        return view('Thr::create', [ 
            'data_user' => $data_user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function simpan(Request $request)
    {
        $rules = array(
            'id_user'           => 'required'
        ); 
 
        $validator = Validator::make($request->all(), $rules); 
 
        if ($validator->fails()) {
 
            return Redirect::to('thr/create')->withErrors($validator)->withInput();
 
        } else {
          
            $id_user  = $request->input("id_user"); 
            $tanggal  = $request->input("tanggal"); 
            $keterangan  = $request->input("keterangan");
            $total_Thr  = $request->input("total_thr");
            
            $index2 = 0;
            foreach($id_user as $r){

                $r_total_Thr = $total_Thr[$index2];
                
                $data = new Thr;
                $data->periode = $tanggal; 
                $data->tanggal = date("Y-m-d");
                $data->id_user = $r;
                $data->keterangan = $keterangan;
                $data->total = $r_total_Thr;
                $data->app = 1;
                $data->created_by = Auth::user()->name;
                $data->save();  

                $index2++;
            }
 
            $arr = array('msg' =>"Data Berhasil disimpan!!", 'status'=>true);
            $pesan = "Anda memiliki Pending Approval atas Pengajuan Thr Karyawan<br>
            <strong>Thr Karyawan</strong><br>
            <strong>Diajukan Oleh: </strong> ". Auth::user()->name."<br>
            <strong>Periode Thr: </strong> ". $tanggal."<br>
            <strong>Keterangan : </strong><small>". $keterangan."</small><br>
            ";				
          
            /* Mail::send('email', ['data' => $data,'pesan' =>$pesan, 'tanggal'=> $tanggal ], function ($message) use ($request)
            {
                $message->subject("New Approval :: Pengajuan Thr Karyawan Periode ". $request->input("tanggal"));
                $message->from('admin@sembilanbintanglestari.com', 'PT Sembilan Bintang Lestari');
                $message->to("harishfauzan@gmail.com");
            }); */
            
            return response()->json($arr); 
 
 
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function detail($id)
    {
        $db = DB::connection('mysql'); 
		
		$data = $db->select("SELECT a.*,b.name FROM thr a left join users b on a.id_user = b.id where a.periode = '$id' Order by b.name");

        return view('Thr::detail', ['data' => $data] );
    }

     
}
