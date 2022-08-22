<?php

namespace App\Modules\Gaji\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Gaji\Gaji; 
use App\Modules\Users\Models\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

class GajiController extends Controller
{
    
    /* Display a listing of the resource.
     *
     * @param Gl $data
     */

    public function __construct(Gaji $data)
    {
        $this->data = $data;
    }
    
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Gaji::select(DB::raw("periode,sum(total) as total,
                                count(*) as tkaryawan,
                                keterangan,
                                if(app=1,'Pengajuan',if(app = 2,'Di Setujui','Di Tolak')) as status,
                                tgl_app,created_by,tanggal"))
                            ->groupBy('periode')->OrderBy("periode","desc")->get();
        return view('Gaji::index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data_user = Users::All();
        return view('Gaji::create', [ 
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
 
            return Redirect::to('gaji/create')->withErrors($validator)->withInput();
 
        } else {
          
            $id_user  = $request->input("id_user"); 
            $tanggal  = $request->input("tanggal"); 
            $keterangan  = $request->input("keterangan");
            $gaji_pokok  = $request->input("gaji_pokok");
            $tunjangan1  = $request->input("tunjangan1");
            $tunjangan2  = $request->input("tunjangan2");
            $lembur  = $request->input("lembur"); 
            $potongan1  = $request->input("potongan1");
            $bpjs_kesehatan  = $request->input("bpjs_kesehatan");
            $bpjs_tk  = $request->input("bpjs_tk");
          
            $index2 = 0;
            foreach($id_user as $r){

                $r_gaji_pokok = $gaji_pokok[$index2];
                $r_tunjangan1 = $tunjangan1[$index2];
                $r_tunjangan2 = $tunjangan2[$index2];
                $r_lembur = $lembur[$index2]; 
                $r_potongan1 = $potongan1[$index2];
                $r_bpjs_kesehatan = $bpjs_kesehatan[$index2];
                $r_bpjs_tk = $bpjs_tk[$index2];
        
                $data = new Gaji;
                $data->periode = $tanggal; 
                $data->tanggal = date("Y-m-d");
                $data->id_user = $r;
                $data->keterangan = $keterangan;
                $data->gaji_pokok = $r_gaji_pokok;
                $data->tunjangan1 = $r_tunjangan1;
                $data->tunjangan2 = $r_tunjangan2;
                $data->lembur = $r_lembur; 
                $data->potongan1 = $r_potongan1;
                $data->bpjs_kesehatan = $r_bpjs_kesehatan;
                $data->bpjs_tk = $r_bpjs_tk;
                $data->total = ($r_gaji_pokok + $r_tunjangan1 + $r_tunjangan2 + $r_lembur - $r_bpjs_kesehatan - $r_potongan1 - $r_bpjs_tk);
                $data->app = 1;
                $data->created_by = Auth::user()->name;
                $data->save();  

                $index2++;
            }
 
            $arr = array('msg' =>"Data Berhasil disimpan!!", 'status'=>true);
$pesan = "Anda memiliki Pending Approval atas Pengajuan Gaji Karyawan
Diajukan Oleh:". Auth::user()->name."
Periode Gaji:". $tanggal."
Keterangan :". $keterangan;	

            $this->data->insertwa($pesan);
          
            /* Mail::send('email', ['data' => $data,'pesan' =>$pesan, 'tanggal'=> $tanggal ], function ($message) use ($request)
            {
                $message->subject("New Approval :: Pengajuan Gaji Karyawan Periode ". $request->input("tanggal"));
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
		
		$data = $db->select("SELECT a.*,b.name FROM gaji a left join users b on a.id_user = b.id where a.periode = '$id' Order by b.name");

        return view('Gaji::detail', ['data' => $data] );
    }

     
}
