<?php

namespace App\Modules\Apppaymaterial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Modules\Apppaymaterial\Models\Apppaymaterial;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
class ApppaymaterialController extends Controller
{
      /**
     * Display a listing of the resource.
    *
    * @param Apppaymaterial $data
    */

    public function __construct(Apppaymaterial $data)
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
        return view('Apppaymaterial::index',['data' =>$data]);  
    }
	

    public function detail($docno,$pembayaran)
    {
        $data = $this->data->detail($docno,$pembayaran);
        
        return view('Apppaymaterial::preview')->with('data', $data);

    }
	  
    public function approve($docno,$pembayaran){ 

        $db = DB::connection('mysql');
        
        if(Auth::user()->id_jabatan == 5 ){
            $data = $db->table('po_real')
            ->where('docno', $docno)
            ->where('pembayaran', $pembayaran)
            ->update(['status' => "2", 'app_mgr' => date('Y-m-d')]);
			$c = $db->select("select b.nama as nama_rekanan,id_properti,dari,docno,sum(gross_real) as gross,pembayaran 
									from po_real  a 
									left join rekanan b on a.dari = b.id
								where docno = $docno and pembayaran = '$pembayaran'
							");
			foreach($c as $u){
				$pesan = "Anda memiliki Pending Approval atas Pembayaran Material  <br>
					<strong>Data Pembayaran</strong><br>
					<strong>Nama Rekanan: </strong>". $u->nama_rekanan."<br>
					<strong>Total Pembayaran : </strong> Rp ". number_format($u->gross)."<br>
					";				
				
			}
				  
			Mail::send('email', ['pesan' =>$pesan ], function ($message) use ($request)
				{
					$message->subject("New Approval :: Pembayaran Material");
					$message->from('sembilanbintanglestari@gmail.com', 'PT Sembilan Bintang Lestari');
					$message->to("harishfauzan@gmail.com");
				});
            
        }elseif(Auth::user()->id_jabatan == 4 OR Auth::user()->id_jabatan == 3 OR Auth::user()->id_jabatan == 1){
            $data = $db->table('po_real')
				->where('docno', $docno)
				->where('pembayaran', $pembayaran)
				->update(['status' => "4", 'app_dir' => date('Y-m-d')]); 
			
        
		
			$db = DB::connection('mysql');
			$c = $db->select("
				select id_properti,dari,docno,sum(gross_real) as gross,pembayaran from po_real 
				where docno = $docno and pembayaran = '$pembayaran'
				");
			
			foreach($c as $in){
				$new = New Apppaymaterial;
				$new->id_vendor = $in->dari;
				$new->id_properti = $in->id_properti;
				$new->docno = $in->docno;
				$new->gross = $in->gross;
				$new->pembayaran = $in->pembayaran;
				$new->save();				
			}
		}			

        
            Session::flash('flash_message', 'Data Approval Pembayaran Material Berhasil Disimpan!');
            return redirect('apppaymaterial');
		
    }
    
    public function reject($docno,$pembayaran){ 

		$db = DB::connection('mysql');
        if(Auth::user()->id_jabatan == 5 ){
            $data = $db->table('po_real')
            ->where('docno', $docno)
            ->where('pembayaran', $pembayaran)
            ->update(['status' => "3", 'app_mgr' => date('Y-m-d')]);
            
        }elseif(Auth::user()->id_jabatan == 4 OR Auth::user()->id_jabatan == 3 OR Auth::user()->id_jabatan == 1){
            $data = $db->table('po_real')
            ->where('docno', $docno)
            ->where('pembayaran', $pembayaran)
            ->update(['status' => "5", 'app_dir' => date('Y-m-d')]);
        }
		
		Session::flash('flash_message', 'Data Pembayaran Material Berhasil Disimpan!');
        return redirect('apppaymaterial');
        
	}

}
