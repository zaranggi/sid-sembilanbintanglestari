<?php

namespace App\Modules\Spk\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Spk\Models\Spk;
use App\Modules\Mrabnew\Models\Mrabnew;
use App\Modules\Konsumen\Models\Konsumen;
use App\Modules\Spk\Models\Termin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SpkController extends Controller
{
     /**
  * Display a listing of the resource.
  *
  * @param Docproperti $data
  */

 public function __construct(Spk $data)
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

       return view('Spk::index',['data' => $data]);
   }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $dirman = $this->data->dirman();
        $subkon = $this->data->subkon();
        $properti = $this->data->properti();
        $jenis_spk = $this->data->jenis_spk();

        return view('Spk::create', ['dirman' => $dirman, 'subkon'=> $subkon, 'jenis_spk' =>$jenis_spk,'properti' => $properti]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'id_properti'   => 'required',
            'id_kav'   => 'required',
            'jenis'   => 'required',
            'kode_mrab'   => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return Redirect::to('spk/create')->withErrors($validator)->withInput();

        } else {

			$id_properti =  $request->input("id_properti");
            $id_kav =  $request->input("id_kav");
            $tipe_unit =  $request->input("tipe_unit");
            $bobot =  $request->input("bobot");
            $kode_mrab =  $request->input("kode_mrab");

            $noUrutAkhir = Spk::max('id');
            $kode = "SPK-".sprintf("%04s", $noUrutAkhir + 1);

            $data = new Spk;
            $data->kode = $kode;
            $data->tanggal= date("Y-m-d");
            $data->id_properti = $id_properti;
            $data->id_kav = $id_kav;
            $data->tipe_unit = $tipe_unit;
            $data->kode_mrab = $request->input("kode_mrab");
            $data->pihak1 = $request->input("pihak1");
            $data->id_subkon = $request->input("id_subkon");
            $data->gross = str_replace(",","",$request->input("gross_spk"));
            $data->gross_total = str_replace(",","",$request->input("gross_total"));
            $data->krgbayar = str_replace(",","",$request->input("gross_total"));
            $data->krgbayarret = str_replace(",","",$request->input("gross_total")) * 0.05;
            $data->tanggal_mulai = $request->input("tanggal_mulai");
            $data->tanggal_bast = $request->input("tanggal_selesai");
            $data->retensi = str_replace(",","",$request->input("gross_total")) * 0.05;
            $data->status = 0;
            $data->created_by = Auth::user()->name;
            $data->save();

			$gt = str_replace(",","",$request->input("gross_total"));
			$mrab = Mrabnew::where("id","=",$request->input("kode_mrab"))
					->where("status","=",2)
					->get();

			foreach($mrab as $rx){
				if($rx["t1"] > 0){
					$termin = new Termin;
                    $termin->id_spk       = $data->id;
                    $termin->termin       = 1;
                    $termin->nilai        = ($gt * $rx["t1"])/100;
                    $termin->ket_termin   =  "Termin 1 - ". $rx["t1"]."%";
                    $termin->status       = 0;
                    $termin->save();
				}
				if($rx["t2"] > 0){
					$termin = new Termin;
                    $termin->id_spk       = $data->id;
                    $termin->termin       = 2;
                    $termin->nilai        = ($gt * $rx["t2"])/100;
                    $termin->ket_termin   =  "Termin 2 - ". $rx["t2"]."%";
                    $termin->status       = 0;
                    $termin->save();
				}
				if($rx["t3"] > 0){
					$termin = new Termin;
                    $termin->id_spk       = $data->id;
                    $termin->termin       = 3;
                    $termin->nilai        = ($gt * $rx["t3"])/100;
                    $termin->ket_termin   =  "Termin 3 - ". $rx["t3"]."%";
                    $termin->status       = 0;
                    $termin->save();
				}
				if($rx["t4"] > 0){
					$termin = new Termin;
                    $termin->id_spk       = $data->id;
                    $termin->termin       = 4;
                    $termin->nilai        = ($gt * $rx["t4"])/100;
                    $termin->ket_termin   =  "Termin 4 - ". $rx["t4"]."%";
                    $termin->status       = 0;
                    $termin->save();
				}
				if($rx["t5"] > 0){
					$termin = new Termin;
                    $termin->id_spk       = $data->id;
                    $termin->termin       = 5;
                    $termin->nilai        = ($gt * $rx["t5"])/100;
                    $termin->ket_termin   =  "Termin 5 - ". $rx["t5"]."%";
                    $termin->status       = 0;
                    $termin->save();
				}
				if($rx["retensi"] > 0){
					$termin = new Termin;
                    $termin->id_spk       = $data->id;
                    $termin->termin       = 6;
                    $termin->nilai        = ($gt * $rx["retensi"])/100;
                    $termin->ket_termin   =  "Retensi - ". $rx["retensi"]."%";
                    $termin->status       = 0;
                    $termin->save();
				}

			}

            Session::flash('flash_message', 'Data has been successful Added!');

            return redirect('spk');

        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('Spk::edit');
    }

    public function simpan(Request $request)
    {

       $idspk = $request->input("id_spk");
       $datanya = Termin::where("id_spk","=",$idspk)->get();

       foreach($datanya as $r){

            $a = $request->input("termin_".$r->id);
            foreach($a as $x){
                $ua = new Progresbangun;
                $ua->id_spk       = $idspk;
                $ua->id_termin       = $r->id;
                $ua->id_jenis       = str_replace("#","", $x);
                $ua->save();
            }

       }


       Session::flash('flash_message', 'Syarat Pembayaran Termin Berhasil disimpan!');
       return redirect('spk');

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function ajukan(Request $request,$idspk)
    {
       $data = Spk::findOrfail($idspk);
       $data->status = 1;
       $data->save();

        $this->data->update_termin($idspk);
        Session::flash('flash_message', 'Data has been successful Edited!');
        return redirect('spk');

    }
    public function detail($id)
    {
        $data = $this->data->spkdetail($id);
        $termin = $this->data->termindetail($id);
        $job = $this->data->jobdetail($id);

        return view('Spk::detail',['data' =>$data, 'termin' => $termin, 'job' => $job]);

    }
   /**
     * Display a listing of the resource.
     * @return Response
     */
    public function isikan(Request $request)
    {
        $a = $request->input("query");

        $data = $this->data->unit_kav($a);
        return response()->json($data);


    }

	public function nilaispk(Request $request)
    {

        $c = $request->input("id");

        $data = Mrabnew::where("id","=",$c)
		->where("status","=",2)
        ->get();

        return response()->json($data);

    }

    public function listunit(Request $request)
    {
        $data = $this->data->listunit($request->id);
        return response()->json($data);

    }
	 public function listspknya(Request $request)
    {
        $data = $this->data->listspknya($request->query1,$request->query2);
        return response()->json($data);

    }

    public function unitdetail(Request $request)
    {
        $id = $request->input("query");

        $data = $this->data->unitdetail($id);
        return response()->json($data);

    }


}
