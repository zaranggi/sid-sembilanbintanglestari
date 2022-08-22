<?php

namespace App\Modules\Appmarketingfee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Appmarketingfee\Models\Appmarketingfee; 
use App\Modules\Trxkonsumen\Models\Trxkonsumen; 
use App\Modules\Users\Models\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

class AppmarketingfeeController extends Controller
{
    
    /* Display a listing of the resource.
     *
     * @param Gl $data
     */

    public function __construct(Appmarketingfee $data)
    {
        $this->data = $data;
    }
    
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->listdata();
        return view('Appmarketingfee::index', ['data' => $data]); 
    }
 
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function detail($id)
    {
        $db = DB::connection('mysql'); 
		
		$data = $db->select("select c.`name` as nama_marketing, id_fee, tanggal,
        a.gross as total_fee,
        d.nama as nama_properti, e.nama as nama_kav,f.nama as nama_konsumen
        from marketing_fee a 
        left join konsumen_spr b on a.id_trx_konsumen = b .id
        left join users c on a.id_marketing = c.id
                    left join properti d on b.id_properti = d.id 
                    left join properti_kav e on b.id_kav = e.id
                    left join konsumen f on b.id_konsumen = f.id
                    where a.id_fee='$id'
       ");

        return view('Appmarketingfee::detail', ['data' => $data] );
    }
    public function approve($id)
    { 
        $upd = $this->data->approve($id);
        
        Session::flash('flash_message', 'Pengajuan Marketing Fee sudah diApprove!');
        return redirect('appmarketingfee');


    }
    public function reject($id)
    {
        $upd = $this->data->reject($id);
        
        Session::flash('flash_message', 'Pengajuan Marketing Fee sudah diReject!');
        return redirect('appmarketingfee');

    } 

     
}
