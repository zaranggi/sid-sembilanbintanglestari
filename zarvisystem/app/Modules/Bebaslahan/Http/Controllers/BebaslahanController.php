<?php

namespace App\Modules\Bebaslahan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Bebaslahan\Models\Bebaslahan;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

class BebaslahanController extends Controller
{

    /* Display a listing of the resource.
     *
     * @param Bebaslahan $data
     */

    public function __construct(Bebaslahan $data)
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

        return view('Bebaslahan::index', ['data' => $data]);
    }

    public function create()
    {
        $properti = $this->data->dataproperti();

        return view('Bebaslahan::create', ['properti' => $properti]);
    }

    public function simpan(Request $request)
    {

        $rules = array(
            'nama'    => 'required',
            'id_properti'    => 'required|numeric',
            'harga'         => 'required|numeric',
            'luas_tanah'  => 'required',
            'tanggal'     => 'required',
            'gross'    => 'required',
            'tahapan_um'  => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

			$arr = array('msg' =>"Data Gagal disimpan!!", 'status'=>false);
            return response()->json($arr);

        } else {
            if(is_array($request->input('tag_um')) && count($request->input('tag_um')) > 0){

                $luas_tanah = str_replace(",","",$request->input('luas_tanah'));
                $harga = str_replace(",","",$request->input('harga'));
                $gross = str_replace(",","",$request->input('gross'));

                $data = new Bebaslahan;
                $data->id_properti  = $request->input('id_properti');
                $data->tanggal      = $request->input('tanggal');
                $data->tanggal_jth_tempo      = $request->input('tanggal_jth_tempo');
                $data->nama_pemilik = $request->input('nama');
                $data->alamat      	= $request->input('alamat');
                $data->ktp          = $request->input('ktp');
                $data->hp           = $request->input('hp');
                $data->luas_tanah   = $luas_tanah;
                $data->harga    	= $harga;
                $data->gross    	= $gross;
                $data->status_bebas_lahan    	= 0;
                $data->status_bayar    	=$request->input('tahapan_um');

                $data->created_by           = Auth::user()->name;
                $data->save();


                $no = 1;
                foreach($request->input('tag_um') as $r)
                {
                    $this->data->inserttermin($data->id,$no,$r);
                    $no++;
                }
                $pesan = "Anda memiliki pengajuan MOU Pembebasan lahan:
Nama Pemilik = ".$data->nama_pemilik."
No KTP = ".$data->ktp."
Alamat = ".$data->alamat."
No HP = ".$data->hp."
Luas Tanah = ".number_format($data->luas_tanah)." meter persegi
Harga per meter = Rp ".number_format($data->harga)."
Total = Rp ".number_format($data->gross)."
Dibayarkan = ".$data->status_bayar."x";
                $this->data->insertwa($pesan);

                $arr = array('msg' =>"Data Berhasil disimpan!!", 'status'=>true);
                return response()->json($arr);
            }else{
                $arr = array('msg' =>"Data Gagal disimpan!!", 'status'=>false);
                return response()->json($arr);
            }


        }
    }

    public function update(Request $request)
    {

        $rules = array(
            'id'    => 'required',
            'nama'    => 'required',
            'id_properti'    => 'required|numeric',
            'harga'         => 'required|numeric',
            'luas_tanah'  => 'required',
            'tanggal'     => 'required',
            'gross'    => 'required',
            'tahapan_um'  => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

			$arr = array('msg' =>"Data Gagal disimpan!!", 'status'=>false);
            return response()->json($arr);

        } else {
            if(is_array($request->input('tag_um')) && count($request->input('tag_um')) > 0){

                $luas_tanah = str_replace(",","",$request->input('luas_tanah'));
                $harga = str_replace(",","",$request->input('harga'));
                $gross = str_replace(",","",$request->input('gross'));

                $data = Bebaslahan::findOrFail($request->input('id'));;
                $data->id_properti  = $request->input('id_properti');
                $data->tanggal      = $request->input('tanggal');
                $data->tanggal_jth_tempo      = $request->input('tanggal_jth_tempo');
                $data->nama_pemilik = $request->input('nama');
                $data->alamat      	= $request->input('alamat');
                $data->ktp          = $request->input('ktp');
                $data->hp           = $request->input('hp');
                $data->luas_tanah   = $luas_tanah;
                $data->harga    	= $harga;
                $data->gross    	= $gross;
                $data->status_bebas_lahan    	= 0;
                $data->status_bayar    	=$request->input('tahapan_um');

                $data->created_by           = Auth::user()->name;
                $data->save();


                $no = 1;
                foreach($request->input('tag_um') as $r)
                {
                    $this->data->updatetermin($data->id,$no,$r);
                    $no++;
                }
                $this->data->deltermin($data->id,$no);

                $pesan = "*Update MOU Pembebasan lahan:*
Nama Pemilik = ".$data->nama_pemilik."
No KTP = ".$data->ktp."
Alamat = ".$data->alamat."
No HP = ".$data->hp."
Luas Tanah = ".number_format($data->luas_tanah)." meter persegi
Harga per meter = Rp ".number_format($data->harga)."
Total = Rp ".number_format($data->gross)."
Termin = ".$data->status_bayar."x";
                $this->data->insertwa($pesan);

                $arr = array('msg' =>"Data Berhasil disimpan!!", 'status'=>true);
                return response()->json($arr);
            }else{
                $arr = array('msg' =>"Data Gagal disimpan!!", 'status'=>false);
                return response()->json($arr);
            }


        }
    }

    public function detail($id)
    {
        $properti = $this->data->dataproperti();
        $data = $this->data->detail($id);
        $termin = $this->data->gettermin($id);
        return view('Bebaslahan::detail', ['properti' => $properti, 'data'=> $data, 'id' => $id, 'termin' => $termin]);
    }

    public function doc($id)
    {
        $data = $this->data->listdoc($id);
        return view('Bebaslahan::doc', ['listdoc' => $data, 'id'=>$id]);
    }

    public function uploaddoc(Request $request)
    {
        $rules = array(
            'id' => 'required|max:255',
            'namafile' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('bebaslahan')->withErrors($validator)->withInput();
        }
        else
        {

            $path ='image/legalformal';
                $file_name = "";

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $max =  count($request->file('namafile'));

                if ($request->hasFile('namafile')) {
                    for($i=0;$i<$max;$i++){

                        $file = $request->file('namafile')[$i];

                        $file_name = uniqid() . '_' . $request->input('id').date("YmdHis").$file;

                        $file->move($path, $file_name);
                        $nama_dokumen = "File Dokumen ".($i+1);
                        $this->data->simpandoc( $request->input('id'),$nama_dokumen , $file_name);
                    }
                }

            Session::flash('flash_message', 'Data has ben successful Added!');
            return redirect('bebaslahan');

        }
    }


}
