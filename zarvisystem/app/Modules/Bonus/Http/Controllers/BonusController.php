<?php

namespace App\Modules\Bonus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Bonus\Models\Bonus; 
use App\Modules\Users\Models\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

class BonusController extends Controller
{
    
    /* Display a listing of the resource.
     *
     * @param Gl $data
     */

    public function __construct(Bonus $data)
    {
        $this->data = $data;
    }
    
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Bonus::select(DB::raw("periode,sum(total) as total,
                                count(*) as tkaryawan,
                                keterangan,
                                if(app=1,'Pengajuan',if(app = 2,'Di Setujui','Di Tolak')) as status,
                                tgl_app,created_by,tanggal"))
                            ->groupBy('periode')->OrderBy("periode","desc")->get();
        return view('Bonus::index', ['data' => $data]); 
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data_user = Users::All();
        return view('Bonus::create', [ 
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
 
            return Redirect::to('bonus/create')->withErrors($validator)->withInput();
 
        } else {
          
            $id_user  = $request->input("id_user"); 
            $tanggal  = $request->input("tanggal"); 
            $keterangan  = $request->input("keterangan");
            $total_bonus  = $request->input("total_bonus");
            
            $index2 = 0;
            foreach($id_user as $r){

                $r_total_bonus = $total_bonus[$index2];
                
                $data = new Bonus;
                $data->periode = $tanggal; 
                $data->tanggal = date("Y-m-d");
                $data->id_user = $r;
                $data->keterangan = $keterangan;
                $data->total = $r_total_bonus;
                $data->app = 1;
                $data->created_by = Auth::user()->name;
                $data->save();  

                $index2++;
            }
 
            $arr = array('msg' =>"Data Berhasil disimpan!!", 'status'=>true);
            $pesan = "Anda memiliki Pending Approval atas Pengajuan Bonus Karyawan<br>
            <strong>Bonus Karyawan</strong><br>
            <strong>Diajukan Oleh: </strong> ". Auth::user()->name."<br>
            <strong>Periode Bonus: </strong> ". $tanggal."<br>
            <strong>Keterangan : </strong><small>". $keterangan."</small><br>
            ";				
          
            /* Mail::send('email', ['data' => $data,'pesan' =>$pesan, 'tanggal'=> $tanggal ], function ($message) use ($request)
            {
                $message->subject("New Approval :: Pengajuan Bonus Karyawan Periode ". $request->input("tanggal"));
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
		
		$data = $db->select("SELECT a.*,b.name FROM bonus a left join users b on a.id_user = b.id where a.periode = '$id' Order by b.name");

        return view('Bonus::detail', ['data' => $data] );
    }

     
}
