<?php

namespace App\Modules\Berkaskonsumen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Berkaskonsumen\Models\Berkaskonsumen;
use App\Modules\Konsumen\Models\Konsumen;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\Tanggal;

class BerkaskonsumenController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @param Berkaskonsumen $data
     */

    public function __construct(Berkaskonsumen $data)
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
       return view('Berkaskonsumen::index',['data' => $data]);
    }

      /**
     * Display a listing of the resource.
     * @return Response
     */
    public function datakonsumen($id)
    {
        $data = $this->data->listkonsumen($id);

        return view("Berkaskonsumen::datakonsumen",
                            [
                                'data' => $data,
                                'id_properti' => $id

                            ]);

    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function mykonsumen(Request $request)
    {
        $kode = substr($request->kode,0,7);
        $data = $this->data->mykonsumen($kode);

        return view("Berkaskonsumen::datakonsumen",
                            [
                                'data' => $data,

                            ]);

    }


    public function suratnya(Request $request)
    {
        $id = $request->input("id");

        $db = DB::connection('mysql');
        $data = $db->select("SELECT * FROM surat_konsumen WHERE id_konsumen='$id' Order by id Desc");
        $a = '<thead>
        <tr class="text-center bg-info">
            <th >Tanggal</th>
            <th >Kode</th>
            <th >Perihal</th>
            <th >File</th>
            <th >Pengirim</th>
        </tr>
    </thead><tbody>';
        foreach($data  as $r){
            $tanggal = Tanggal::tgl_indo($r->tanggal);
            $kode = $r->kode;
            $perihal = $r->perihal;
            $pengirim = $r->pengirim;

            $file = $r->file;
			$url = url("image/surat/".$file);
            $a = $a."
            <tr><td class='text-center'>".$tanggal."</td><td class='text-center'>".$kode."</td><td><h6 class='mb-0'>  <a href='#'>".$perihal."</a> </h6></td><td class='text-center'><a href='".$url."' target='_blank'> <i class='fa fa-file'></i> </a></td><td class='text-center'>".$pengirim."</td></tr>
            ";
        }
        $a = $a."</tbody>";

       return $a;

    }

    public function doc($id)
    {
        $data = Konsumen::findOrFail($id);

        $listdoc = $this->data->listdoc($id);

        if(count($listdoc) == 0){
            $listdoc = $this->data->listdoc2();
        }

        return view("Berkaskonsumen::detaildoc", [ 'listdoc' => $listdoc])->with('data', $data);

    }



}
