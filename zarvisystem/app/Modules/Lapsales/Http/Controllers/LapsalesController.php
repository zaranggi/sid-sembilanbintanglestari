<?php

namespace App\Modules\Lapsales\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Konsumen\Models\Konsumen;
use App\Modules\Mproperti\Models\Mproperti;
use App\Modules\Lapsales\Models\Lapsales;
use App\Modules\Users\Models\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;
use App\Modules\Trxkonsumen\Models\Trxkonsumen;

class LapsalesController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @param Lapsales $data
     */

    public function __construct(Lapsales $data)
    {
        $this->data = $data;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Mproperti::OrderBy('created_at','desc')->get();
        $marketing = Users::where('id_jabatan','=','9')->get();
        return view('Lapsales::index',['data' => $data, 'marketing' => $marketing]);
    }
 
    public function preview(Request $request)
    {
        $tanggal1 = $request->input("tanggal1");
        $tanggal2 = $request->input("tanggal2");
        $id_properti = $request->input("id_properti");
        $id_marketing = $request->input("id_marketing");

        $data = $this->data->listall($tanggal1,$tanggal2,$id_properti,$id_marketing); 
        $data2 = $this->data->listrekap($tanggal1,$tanggal2,$id_properti,$id_marketing); 
        
        return view('Lapsales::preview',['data' => $data,'data2' => $data2,'tanggal1' => $tanggal1 ,'tanggal2' => $tanggal2]);
    }

    public function ckonsumen($id, $tanggal1, $tanggal2)
    {
        $data = $this->data->listckonsumen($id, $tanggal1, $tanggal2);

        
        return view('Lapsales::ckonsumen',['data' => $data]);
    }

    public function spr($id, $tanggal1, $tanggal2)
    {
        $data = $this->data->penjualan($id,$tanggal1, $tanggal2);
        
        
        return view('Lapsales::penjualan',['data' => $data, 'tanggal1' => $tanggal1 ,'tanggal2' => $tanggal2]);
    }
}
