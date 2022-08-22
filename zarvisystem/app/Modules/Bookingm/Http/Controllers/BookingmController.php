<?php

namespace App\Modules\Bookingm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Bookingm\Models\Bookingm;
use App\Modules\Konsumen\Models\Konsumen;
use App\Modules\Munit\Models\Munit;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class BookingmController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @param Bookingm $data
     */

    public function __construct(Bookingm $data)
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

        return view("Bookingm::index", ['data' => $data]);

    }
	public function create()
    {
        $properti = $this->data->listproperti();

        return view("Bookingm::create", ['properti' => $properti]);

    }
	public function batal(Request $request)
    {
		$data = Bookingm::findOrFail($request->input('id_booking'));
		$data->status = 0;
		$data->keterangan_batal = $request->input('keterangan_batal');
		$data->tanggal_batal = date("Y-m-d");
		$data->save();

		$u = Munit::findOrFail($data->id_kav);
		$u->status=1;
		$u->save();

		return redirect('bookingm');

	}



    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function fu(Request $request)
    {

        $kode = substr($request->input('kode'),0,7);
        $aa = Konsumen::where('kode',$kode)->count();

            if($aa > 0){

                $aa = Konsumen::where('kode',$kode)->take(1)->get();
                foreach($aa as $kon){

                    $this->data->updatekonsumen($kode,$request->input('nama'),$request->input('alamat'),$request->input('telp'),str_replace(" ","",$request->input('idcard')));

                    $datau = new Bookingm;
                    $datau->id_konsumen = $kon->id;
                    $datau->id_properti = $request->input('id_properti');
                    $datau->id_kav = $request->input('id_kav');
                    $datau->id_marketing = Auth::user()->id;
                    $datau->nominal = str_replace(",","",$request->input('nominal'));
                    $datau->tanggal = $request->input('tanggal');
                    $datau->keterangan = $request->input('keterangan');
                    $datau->created_by = Auth::user()->name;
                    $datau->save();

                    $u = Munit::findOrFail($request->input('id_kav'));
                    $u->status=3;
                    $u->save();

                }

            }else{

                $noUrutAkhir = Konsumen::max('id');
                $kode = "KO-".sprintf("%04s", $noUrutAkhir + 1);

                $data = new Konsumen;
                $data->id_properti = $request->input("id_properti");
                $data->id_marketing = Auth::user()->id;
                $data->kode             = $kode;
                $data->nama         	= $request->input('nama');
                $data->alamat 	        = $request->input('alamat');
                $data->telp          	= $request->input('telp');
                $data->idcard          	= str_replace(" ","",$request->input('idcard'));
                $data->save();

                $datau = new Bookingm;
                $datau->id_konsumen = $data->id;
                $datau->id_properti = $request->input('id_properti');
                $datau->id_kav = $request->input('id_kav');
                $datau->id_marketing = Auth::user()->id;
                $datau->nominal = str_replace(",","",$request->input('nominal'));
                $datau->tanggal = $request->input('tanggal');
                $datau->keterangan = $request->input('keterangan');
                $datau->created_by = Auth::user()->name;
                $datau->save();

                $u = Munit::findOrFail($request->input('id_kav'));
                $u->status=3;
                $u->save();

            }

        Session::flash('flash_message', 'Data has been successful Added!');
        return redirect('bookingm');
    }




    public function autocomplete(Request $request)
    {
        if($request->get('query'))
        {

                $data = Konsumen::select(DB::raw("nama,idcard,kode"))
                ->where('id_marketing','=',Auth::user()->id)
                ->where('iskonsumen','=',0)
                ->where("nama","LIKE","%{$request->input('query')}%")
                ->orwhere("idcard","LIKE","%{$request->input('query')}%")
                ->orwhere("kode","LIKE","%{$request->input('query')}%")
                ->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= '
                    <li><a href="#">'.$row->kode.'-'.$row->nama.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function listunit(Request $request)
    {
        $data = $this->data->listunit($request->id);
        return response()->json($data);

    }
    public function unitdetail(Request $request)
    {
        $id = $request->input("query");

        $data = $this->data->unitdetail($id);
        return response()->json($data);

    }


}
