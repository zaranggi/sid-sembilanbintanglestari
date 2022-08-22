<?php

namespace App\Modules\Apppo\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Apppo\Models\Apppo; 
use App\Modules\Apppo\Models\Pobayar; 
use App\Modules\Apppo\Models\Material;  

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Mail;

class ApppoController extends Controller
{
	    /**
     * Display a listing of the resource.
    *
    * @param Apppo $data
    */

    public function __construct(Apppo $data)
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
        return view('Apppo::index',['data' =>$data]);  
    }
	
	public function detail($docno,$pembayaran)
    {
        $data = $this->data->detail($docno,$pembayaran);
        
        return view('Apppo::preview')->with('data', $data);

    }
	  
    public function approve($docno,$pembayaran){ 

        $db = DB::connection('mysql');
        
        if(Auth::user()->id_jabatan == 5 OR Auth::user()->id_jabatan == 1){
            $data = $db->table('po')
            ->where('docno', $docno)
            ->where('pembayaran', $pembayaran)
            ->update(['status' => "2", 'app_mgr' => date('Y-m-d')]);

            $datanya = $db->select("SELECT SUM(gross) AS total FROM po WHERE docno='$docno' and pembayaran = '$pembayaran'");
            foreach($datanya as $r){
                $pesan = "Anda memiliki Pending Approval atas Pengajuan PO Material <br>
                <strong>Data PO</strong><br>
                <strong>Tanggal PO: </strong>". $r->tanggal."<br>
                <strong>Total Pembelian : </strong>". number_format($r->total)."<br>
                <strong>Cara Pembayaran: </strong>". $pembayaran."<br>
                <strong>Keterangan: </strong>". $r->keterangan."<br>
                <strong>Diajukan Oleh : </strong>". $r->created_by."<br>
                
                ";				
                Mail::send('email', ['data' => $data,'pesan' =>$pesan ], function ($message) use ($request)
                {
                    $message->subject("New Approval :: Pengajuan PO Material"); 
                    $message->from('admin@sembilanbintanglestari.com', 'PT Sembilan Bintang Lestari');
                    $message->to("harishfauzan@gmail.com");
                    //$message->to("donnyirianto.anggriawan@gmail.com");
                });
            }
          
            

            
        }elseif(Auth::user()->id_jabatan == 4 OR Auth::user()->id_jabatan == 3 ){
            $data = $db->table('po')
				->where('docno', $docno)
				->where('pembayaran', $pembayaran)
				->update(['status' => "4", 'app_dir' => date('Y-m-d')]); 
			
        }
        
            Session::flash('flash_message', 'Data Approval PO Material Berhasil Disimpan!');
            return redirect('apppo');
		
    }
    
    public function reject($docno,$pembayaran){ 

		$db = DB::connection('mysql');
        if(Auth::user()->id_jabatan == 5 OR Auth::user()->id_jabatan == 1){
            $data = $db->table('po')
            ->where('docno', $docno)
            ->where('pembayaran', $pembayaran)
            ->update(['status' => "3", 'app_mgr' => date('Y-m-d')]);
            
        }elseif(Auth::user()->id_jabatan == 4 OR Auth::user()->id_jabatan == 3 ){
            $data = $db->table('po')
            ->where('docno', $docno)
            ->where('pembayaran', $pembayaran)
            ->update(['status' => "5", 'app_dir' => date('Y-m-d')]);
        }
		//echo "halo";
		Session::flash('flash_message', 'Data PO Material Berhasil Disimpan!');
        return redirect('apppo');
        
	}

}
