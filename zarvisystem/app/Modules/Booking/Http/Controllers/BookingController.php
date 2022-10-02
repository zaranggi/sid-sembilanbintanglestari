<?php

namespace App\Modules\Booking\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Modules\Booking\Models\Booking;
use App\Modules\Booking\Models\Mtrankonsumen;
use App\Modules\Trxkonsumen\Models\Konsumenlog;
use App\Modules\Trxkonsumen\Models\Trxkonsumen;
use App\Modules\Bank\Models\Bank;
use App\Modules\Pomaterial\Models\Tconst;
use App\Modules\Booking\Models\Mtran;
use App\Modules\Jurnalumum\Models\Jurnalumum;
use App\Modules\Jurnalumum\Models\Jurnalumumd;
use App\Modules\Munit\Models\Munit;
use App\Modules\Mproperti\Models\Mproperti;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class BookingController extends Controller
{

        /**
     * Display a listing of the resource.
     *
     * @param Bank $data
     */

    public function __construct(Booking $data)
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
        return view('Booking::index',['data' => $data]);
    }


    public function listall($id)
    {
        $data = $this->data->listall($id);
		$bank_pt = Bank::All();
		$bank = $this->data->listbank();
        return view('Booking::data',['data' => $data, 'bank_pt' => $bank_pt, 'bank' => $bank]);
    }

    public function detail($id)
    {
        $data = $this->data->detail($id);
        return view('Booking::view',['data' => $data]);
    }




    public function tagihan(Request $request)
    {
        $kode = substr($request->kode,0,7);
        $data = $this->data->listsatu($kode);
        $bank_pt = Bank::All();
		$bank = $this->data->listbank();
        return view('Booking::data',['data' => $data, 'bank_pt' => $bank_pt, 'bank' => $bank]);
    }


    public function edit($id)
    {
        $data = Booking::findOrFail($id);

        return view("booking::edit")->with('data', $data);

    }

     /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function simpanbayar(Request $request, Mtran $datamtran)
    {
        $rules = array(
            'id_tagihan' => 'required|numeric',
            'nama' => 'required|max:50',
            'tanggal' => 'required',
            'gross' => 'required',
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('booking')->withErrors($validator)->withInput();
        }
        else
        {

            $gross = str_replace(",","",$request->input('gross'));

            $menu = Booking::findOrFail($request->input("id_tagihan"));
			if(($menu->tagihan - $gross) == 0){

				$menu->bayar         	= $gross + $menu->bayar;
				$menu->kurang 	        = $menu->tagihan - $menu->bayar ;
				$menu->tgl_bayar 	    = $request->input('tanggal');
				$menu->keterangan 	    = $request->input('keterangan');
				($menu->bayar) == $menu->tagihan ? $status = "Lunas" : $status = "Belum Lunas" ;
				$menu->status       =  $status;
				$menu->save();

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

				$data = new Mtrankonsumen;
				$data->kode 	        = "BOK-".$menu->id."-".$menu->urutan;
				$data->id_spr 			= $menu->id_spr;
				$data->id_jenis 	    = 1;
				$data->tanggal 	        = $request->input('tanggal');
				$data->pembayar 	    = $request->input('nama');
				$data->penerima 	    = Auth::user()->name;
				$data->tipe_pembayaran 	= $request->input('tipe_pembayaran');
				if($request->input('tipe_pembayaran') == "Transfer"){
					$data->bank_pengirim 	= $request->input('bank_pengirim');
					$data->norek_pengirim 	= $request->input('norek_pengirim');
					$data->id_bank 			= $request->input('id_bank');
				}
				$data->jumlah 	        = $gross;
				$data->angsuran_ke 	    = $menu->urutan;
				$data->photo    	    = $namafile;
				$data->keterangan 	    = $request->input('keterangan');
				$data->save();

					//=================Insert Log Konsumen===================================
					$kon = Trxkonsumen::findOrFail($menu->id_spr);
						$k = new Konsumenlog;
						$k->id_konsumen = $kon->id_konsumen;
						$k->id_marketing = $kon->id_marketing;
						$k->id_properti = $kon->id_properti;
						$k->id_kav = $kon->id_kav;
						$k->id_spr = $kon->id;
						$k->tanggal = $request->input('tanggal');
						$k->status = "Booking Fee";
						$k->keterangan = "Booking Fee : Nominal = ".$gross;
						$k->created_by = Auth::user()->name;
						$k->save();
					//=================END Insert Log Konsumen===================================


					//=================Insert Mtran ===================================
					$const = Tconst::where("rkey","=","AR")->get();
					foreach($const as $r)
					{
						$docno = sprintf("%05s", $r->docno + 1);
					}

					$mt = new Mtran;
					$mt->kode 	        = "AR-".date("ymd")."-".$docno;
					$mt->rtype			= "AR";
					$mt->kode_tagihan 	        = "BOK-".$menu->id."-".$menu->urutan;
					$mt->id_properti 	=  $kon->id_properti;
					$mt->id_kav 	    =  $kon->id_kav;
					$mt->tanggal 	        = $request->input('tanggal');
					$mt->pembayar 	    = $request->input('nama');
					$mt->penerima 	    = Auth::user()->name;
					$mt->tipe_pembayaran 	= $request->input('tipe_pembayaran');
					if($request->input('tipe_pembayaran') == "Transfer"){
						$mt->bank 	= $request->input('bank_pengirim');
						$mt->norek 	= $request->input('norek_pengirim');
						$mt->id_bank 			= $request->input('id_bank');
					}
					$mt->jumlah 	        = $gross;
					$mt->photo    	    = $namafile;
					$mt->keterangan 	    = $request->input('keterangan');
					$mt->save();

					$d = Tconst::findOrfail(9);
					$d->docno = $d->docno+1;
					$d->save();

					//=================END Insert Mtran ===================================

					//=================START INSER JURNAL UMUM===================================

					$data_kon = Trxkonsumen::findOrFail($menu->id_spr);
					$mproperti = Mproperti::findOrFail($data_kon->id_properti);
					$munit = Munit::findOrFail($data_kon->id_kav);

					$ket_jurnal = "Penerimaan Pembayaran Booking Fee :: ".$mproperti->nama." Kav ".$munit->nama." . Dari :".$request->input('nama')." Kode: BOK-".$menu->id."-".$menu->urutan." | ".$request->input("keterangan");
					$ppju = $request->input("tanggal");
					$noUrutAkhir = Jurnalumum::max('id');
					$kode = "JU-".substr($ppju,2,2).substr($ppju,5,2).substr($ppju,8,2)."-".sprintf("%04s", $noUrutAkhir + 1);

					$data_jurnal = new Jurnalumum;
					$data_jurnal->id_properti 	= $data_kon->id_properti;
					$data_jurnal->nomor 	    = $kode;
					$data_jurnal->tanggal 		= $request->input("tanggal");
					$data_jurnal->keterangan 	= $ket_jurnal;
					$data_jurnal->created_by 	= Auth::user()->name;
					$data_jurnal->jenis 		= "J";
					$data_jurnal->posting 		= "Y";
					$data_jurnal->save();

					if($request->input("tipe_pembayaran") == "Cash"){
						$id_akun = "11101";
					}else{
						$b = Bank::findOrFail($request->input("id_bank"));
						$id_akun = $b->acc_kode;
					}

					if($data_kon->isreal == "1"){
						/* Jika KPR sudah Real
							Kas/Bank (D)
								Piutang Usaha (K)
						*/
							//======= Debit ========
								$u = new Jurnalumumd;
								$u->id_jurnal 	= $data_jurnal->id;
								$u->id_akun 	    = $id_akun;
								$u->jenis 		= "J";
								$u->tanggal 		= $request->input("tanggal");
								$u->keterangan 	= $ket_jurnal;
								$u->debit    	= $gross;
								$u->kredit   	= 0;
								$u->posting 		= "Y";
								$u->created_by 	= Auth::user()->name;
								$u->save();

							//======= Kredit ========
							// 11111 - Piutang Usaha
								$u = new Jurnalumumd;
								$u->id_jurnal 	= $data_jurnal->id;
								$u->id_akun 	    = 11111;
								$u->jenis 		= "J";
								$u->tanggal 		= $request->input("tanggal");
								$u->keterangan 	= $ket_jurnal;
								$u->debit    	= 0;
								$u->kredit   	= $gross;
								$u->posting 		= "Y";
								$u->created_by 	= Auth::user()->name;
								$u->save();

					}elseif($data_kon->isreal != "1"){
						/* Jika KPR belum Real
							Kas/Bank (D)
								Pendapatan Diterima Dimuka (K)
						*/
							//======= Debit ========
								$u = new Jurnalumumd;
								$u->id_jurnal 	= $data_jurnal->id;
								$u->id_akun 	    = $id_akun;
								$u->jenis 		= "J";
								$u->tanggal 		= $request->input("tanggal");
								$u->keterangan 	= $ket_jurnal;
								$u->debit    	= $gross;
								$u->kredit   	= 0;
								$u->posting 		= "Y";
								$u->created_by 	= Auth::user()->name;
								$u->save();

							//======= Kredit ========
							// 41203 - Pendapatan Diterima Di muka
								$u = new Jurnalumumd;
								$u->id_jurnal 	= $data_jurnal->id;
								$u->id_akun 	    = 41203;
								$u->jenis 		= "J";
								$u->tanggal 		= $request->input("tanggal");
								$u->keterangan 	= $ket_jurnal;
								$u->debit    	= 0;
								$u->kredit   	= $gross;
								$u->posting 		= "Y";
								$u->created_by 	= Auth::user()->name;
								$u->save();

					}

					//=================END Insert Jurnal ===================================

				Session::flash('flash_message', 'Data Pembayaran Berhasil Disimpan!');

			}else{
				Session::flash('flash_message', 'Pembayaran Harus sesuai dengan Tagihan Booking Fee!');
			}
            return redirect('booking');



        }

	}

	public function cetak($id, $urutan)
    {
		$data = $this->data->datacetak("BOK-$id-$urutan");

		$pdf = PDF::loadview('Booking::cetak', ['data'=>$data])->setPaper('a4');
		//PDF::loadHTML($html)->setPaper('a4')->setOrientation('landscape')
		//->setOption('margin-bottom', 0)->save('myfile.pdf')
       // $pdf->setWatermarkImage(public_path('images/approve.jpg'));
		return $pdf->download('Bukti Pembayaran.pdf');


	}

}
