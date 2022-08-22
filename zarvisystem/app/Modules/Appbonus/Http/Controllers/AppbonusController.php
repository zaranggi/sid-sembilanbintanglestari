<?php

namespace App\Modules\Appbonus\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Appbonus\Models\Appbonus; 
use App\Modules\Users\Models\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

class AppbonusController extends Controller
{
    
    /* Display a listing of the resource.
     *
     * @param Gl $data
     */

    public function __construct(Appbonus $data)
    {
        $this->data = $data;
    }
    
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Appbonus::select(DB::raw("periode,sum(total) as total,
                                count(*) as tkaryawan,
                                keterangan,
                                app,
                                if(app=1,'Pengajuan',if(app = 2,'Di Setujui','Di Tolak')) as status,
                                tgl_app,created_by,tanggal"))
                            ->groupBy('periode')->OrderBy("periode","desc")->get();
        return view('Appbonus::index', ['data' => $data]); 
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

        return view('Appbonus::detail', ['data' => $data] );
    }
    public function approve($id)
    { 
        $upd = $this->data->approve($id);
        
        Session::flash('flash_message', 'Pengajuan Bonus sudah di Approve!');
        return redirect('appbonus');


    }
    public function reject($id)
    {
        $upd = $this->data->reject($id);
        
        Session::flash('flash_message', 'Pengajuan Bonus sudah di Reject!');
        return redirect('appbonus');

    }
	

     
}
