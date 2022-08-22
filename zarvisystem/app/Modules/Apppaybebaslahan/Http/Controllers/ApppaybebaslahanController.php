<?php

namespace App\Modules\Apppaybebaslahan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Modules\Paybebaslahan\Models\Paybebaslahan;
use App\Modules\Apppaybebaslahan\Models\Apppaybebaslahan;
 
use App\Modules\Bank\Models\Bank;
use App\Modules\Jurnalumum\Models\Jurnalumum;
use App\Modules\Jurnalumum\Models\Jurnalumumd; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade as PDF;
class ApppaybebaslahanController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @param Um $data
     */

    public function __construct(Apppaybebaslahan $data)
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
        return view('Apppaybebaslahan::index',['data' => $data]);
    }

     
    public function detail($id)
    {
        $data = $this->data->detail($id);
        $data_termin = $this->data->detail_termin($id); 
        $data_termin_his = $this->data->detail_termin_his($id); 

		$bank_pt = Bank::All();

		$bank = $this->data->listbank();
		
        return view('Apppaybebaslahan::view',['data' => $data,'data_termin' => $data_termin, 'data_termin_his' => $data_termin_his, 'bank_pt' => $bank_pt, 'bank' => $bank, 'id' => $id ]);
    }

    public function approve($id)
    { 
        $upd = $this->data->approve($id);
        
        Session::flash('flash_message', 'Pengajuan sudah diApprove!');
        return redirect('apppaybebaslahan');


    }
    public function reject($id)
    {
        $upd = $this->data->reject($id);
        
        Session::flash('flash_message', 'Pengajuan sudah diReject!');
        return redirect('apppaybebaslahan');

    }
	
	public function cetak($kode)
    {
		$data = $this->data->datacetak($kode);
		
		$pdf = PDF::loadview('Paybebaslahan::cetak', ['data'=>$data])->setPaper('a4');
		//PDF::loadHTML($html)->setPaper('a4')->setOrientation('landscape')
		//->setOption('margin-bottom', 0)->save('myfile.pdf')
       // $pdf->setWatermarkImage(public_path('images/approve.jpg'));
		return $pdf->download('Bukti Pembayaran.pdf');
		

	}
    

}
