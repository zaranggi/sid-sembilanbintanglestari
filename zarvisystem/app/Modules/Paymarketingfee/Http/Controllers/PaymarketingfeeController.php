<?php

namespace App\Modules\Paymarketingfee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Modules\Paymarketingfee\Models\Paymarketingfee;
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

class PaymarketingfeeController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @param Paymarketingfee $data
     */

    public function __construct(Paymarketingfee $data)
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
        $listbank = $this->data->listbank();

		$bank_pt = Bank::All();
        return view('Paymarketingfee::index',['data' => $data, 'listbank' => $listbank, 'bank_pt' =>$bank_pt]);
    }


    public function detail($id)
    {
        $data = $this->data->detail($id);
        $data_termin = $this->data->detail_termin($id);
        $data_termin_his = $this->data->detail_termin_his($id);

		$bank_pt = Bank::All();

		$bank = $this->data->listbank();

        return view('Paymarketingfee::view',['data' => $data,'data_termin' => $data_termin, 'data_termin_his' => $data_termin_his, 'bank_pt' => $bank_pt, 'bank' => $bank, 'id' => $id ]);
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
            'nama' => 'required|max:50',
            'tanggal' => 'required',
            'gross' => 'required'

        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            echo "Gagal";
            return Redirect::to('paymarketingfee')->withErrors($validator)->withInput();
        }
        else
        {

            $gross = str_replace(",","",$request->input('gross'));

            $data = new Paymarketingfee ;
            $data->id_marketing_fee = $request->input('id_tagihan');
            $data->diajukanoleh 	    = Auth::user()->name;
            $data->penerima 	    = $request->input('nama');
            $data->tipe_pembayaran 	= $request->input('tipe_pembayaran');
            if($request->input('tipe_pembayaran') == "Transfer"){
                $data->id_bank 			= $request->input('id_bank');
                $data->bank_penerima 	= $request->input('bank_penerima');
                $data->norek_penerima 	= $request->input('norek_penerima');
            }
            $data->tgl_bayar 	    = $request->input('tanggal');
            $data->jumlah_bayar = $gross;
            $data->keterangan   =  $request->input('keterangan');
            $data->save();

			Session::flash('flash_message', 'Data Pembayaran Berhasil Disimpan!');

			return redirect('paymarketingfee');
        }

	}


	public function cetak($kode)
    {
		$data = $this->data->datacetak($kode);

		$pdf = PDF::loadview('Paymarketingfee::cetak', ['data'=>$data])->setPaper('a4');
		return $pdf->download('Bukti Pembayaran.pdf');


	}


}
