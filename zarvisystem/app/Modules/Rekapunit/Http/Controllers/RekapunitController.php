<?php

namespace App\Modules\Rekapunit\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Rekapunit\Models\Rekapunit; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Helpers\Tanggal;
class RekapunitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Rekapunit $data
     */

    public function __construct(Rekapunit $data)
    {
        $this->data = $data;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
	 public function index()
    {
        $data = $this->data->perumahan();
        return view('Rekapunit::index',['data' => $data]);
    }


    public function listall($id_properti)
    {
        $data = $this->data->listall($id_properti);
        return view('Rekapunit::data',['data' => $data]);
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->data->datanya($id);

        return view('Rekapunit::edit',['data' => $data]);

         
    }  
	
	
    public function bast(Request $request)
    {
        
        $id = $request->input("id"); 
		
        $db = DB::connection('mysql');
        $data = $db->select("SELECT a.* FROM bast a left join konsumen_spr b on a.id_spr =b.id 
								WHERE b.id_konsumen='$id' Order by a.id Desc");
        $a = '<thead>
        <tr class="text-center bg-info">
            <th >Tanggal</th>
            <th >Nomor</th>
            <th >File 1</th>
            <th >File 2</th>
            <th >File 3</th>
            <th >Created By</th>
        </tr>
    </thead><tbody>';
        foreach($data  as $r){
            $tanggal = Tanggal::tgl_indo($r->tanggal);
            $keterangan = $r->keterangan;
            $created_by = $r->created_by;
            $file1 = url("image/surat/".$r->file);
            $file2 = url("image/surat/".$r->file2);
            $file3 = url("image/surat/".$r->file3);
			 
            $a = $a."
            <tr><td class='text-center'>".$tanggal."</td><td class='text-center'>".$keterangan."</td><td class='text-center'><a href='".$file1."' target='_blank'> <i class='fa fa-file'></i> </a></td><td class='text-center'><a href='".$file2."' target='_blank'> <i class='fa fa-file'></i> </a></td><td class='text-center'><a href='".$file3."' target='_blank'> <i class='fa fa-file'></i> </a></td><td class='text-center'>".$created_by."</td></tr>
            ";
        }
        $a = $a."</tbody>";

       return $a;

    }
 
    
}
