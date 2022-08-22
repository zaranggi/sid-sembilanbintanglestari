<?php

namespace App\Modules\Paybebaslahan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Modules\Paybebaslahan\Models\Paybebaslahan;
use App\Modules\Booking\Models\Mtran;

use App\Modules\Trxkonsumen\Models\Trxkonsumen;
use App\Modules\Bank\Models\Bank;
use App\Modules\Jurnalumum\Models\Jurnalumum;
use App\Modules\Jurnalumum\Models\Jurnalumumd;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade as PDF;
class PaybebaslahanController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @param Um $data
     */

    public function __construct(Paybebaslahan $data)
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
        return view('Paybebaslahan::index',['data' => $data]);
    }


    public function detail($id)
    {
        $data = $this->data->detail($id);
        $data_termin = $this->data->detail_termin($id);
        $data_termin_his = $this->data->detail_termin_his($id);

		$bank_pt = Bank::All();

		$bank = $this->data->listbank();

        return view('Paybebaslahan::view',['data' => $data,'data_termin' => $data_termin, 'data_termin_his' => $data_termin_his, 'bank_pt' => $bank_pt, 'bank' => $bank, 'id' => $id ]);
    }


     /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function simpanbayar(Request $request)
    {
        $rules = array(
            'id_tagihan' => 'required|numeric',
            'id' => 'required|max:50',
            'nama' => 'required|max:50',
            'tanggal' => 'required',
            'gross' => 'required',

        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('paybebaslahan/detail/'.$request->input('id'))->withErrors($validator)->withInput();
        }
        else
        {

            $gross = str_replace(",","",$request->input('gross'));

            $menu = Paybebaslahan::findOrFail($request->input("id_tagihan"));
			if($gross == $menu->nilai){
				$menu->jumlah_bayar = $gross;
				$menu->tgl_bayar 	    = $request->input('tanggal');
				$menu->status 	    = 1;
				$menu->diajukanoleh 	    = Auth::user()->name;
				$menu->diajukantgl 	    = Date("Y-m-d");
				$menu->penerima 	    = $request->input('nama');
				$menu->tipe_pembayaran 	= $request->input('tipe_pembayaran');
				if($request->input('tipe_pembayaran') == "Transfer"){
					$menu->bank 	= $request->input('bank_penerima');
					$menu->norek 	= $request->input('norek_penerima');
					$menu->id_bank 			= $request->input('id_bank');
				}

				$menu->keterangan   =  $request->input('keterangan');
				$menu->save();
/*
				$namafile = "";
				if ($request->hasFile('photo')) {
					$path ='image/buktibayar';
					if (!file_exists($path)) {
						mkdir($path, 0777, true);
					}
					$file = $request->file('photo');
					$namafile = uniqid() . '_' . trim($file->getClientOriginalName());
					$file->move($path, $namafile);
				}


    $pesan = "Anda memiliki Pending Approval atas Pengajuan Pembayaran Pembebasan lahan
Diajukan Oleh:". Auth::user()->name."
Periode Pembayara:". $request->input('tanggal')."
Keterangan :". $request->input('keterangan');

            $this->data->insertwa($pesan);
	*/
				Session::flash('flash_message', 'Data Pembayaran Berhasil Disimpan!');
			}else{
				Session::flash('flash_message', 'Pembayaran Harus sesuai dengan Nilai Termin!');
			}

			return redirect('paybebaslahan/detail/'.$request->input('id'));


        }

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
