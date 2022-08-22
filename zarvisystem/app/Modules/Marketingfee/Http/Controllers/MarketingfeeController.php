<?php

namespace App\Modules\Marketingfee\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Marketingfee\Models\Marketingfee;
use App\Modules\Trxkonsumen\Models\Trxkonsumen;
use App\Modules\Users\Models\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

class MarketingfeeController extends Controller
{

    /* Display a listing of the resource.
     *
     * @param Gl $data
     */

    public function __construct(Marketingfee $data)
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
        return view('Marketingfee::index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data_user = Users::All();
        $data_konsumen = $this->data->listkonsumen();
        return view('Marketingfee::create', [
            'data_user' => $data_user,
            'data_konsumen' => $data_konsumen
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function simpan(Request $request)
    {
        $rules = array(
            'id_marketing' => 'required',
            'id_konsumen' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $arr = array('msg' =>"Gagal !!", 'status'=>false);
            return response()->json($arr);

        } else {

            $id_marketing  = $request->input("id_marketing");
            $id_konsumen  = $request->input("id_konsumen");
            $total_fee  = $request->input("total_fee");
            $tanggal  = date("Y-m-d");
            $keterangan  = $request->input("keterangan");
            $id_fee = $id_marketing.date("YmdHis").$id_konsumen;
            $index2 = 0;
            foreach($id_konsumen as $r){

                $r_total_fee = $total_fee[$index2];

                $data = new Marketingfee;
                $data->id_fee = $id_fee;
                $data->id_marketing = $id_marketing;
                $data->id_trx_konsumen = $r;
                $data->keterangan = $keterangan;
                $data->tanggal = date("Y-m-d");
                $data->gross = $r_total_fee;
                $data->approve = 1;
                $data->created_at = date("Y-m-d H:i:s");
                $data->save();

                $index2++;
            }

            $arr = array('msg' =>"Data Berhasil disimpan!!", 'status'=>true);
            $pesan = "Anda memiliki Pending Approval atas Pengajuan Marketing Fee
Diajukan Oleh:". Auth::user()->name."
Periode Marketingfee: ". $tanggal."
Keterangan : ". $keterangan;

            $this->data->insertwa($pesan);

            /* Mail::send('email', ['data' => $data,'pesan' =>$pesan, 'tanggal'=> $tanggal ], function ($message) use ($request)
            {
                $message->subject("New Approval :: Pengajuan Marketingfee Karyawan Periode ". $request->input("tanggal"));
                $message->from('admin@sembilanbintanglestari.com', 'PT Sembilan Bintang Lestari');
                $message->to("harishfauzan@gmail.com");
            }); */

            return response()->json($arr);


        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function detail($id)
    {
        $db = DB::connection('mysql');

		$data = $db->select("select c.`name` as nama_marketing, id_fee, tanggal,
        a.gross as total_fee,
        d.nama as nama_properti, e.nama as nama_kav,f.nama as nama_konsumen
        from marketing_fee a
        left join konsumen_spr b on a.id_trx_konsumen = b .id
        left join users c on a.id_marketing = c.id
                    left join properti d on b.id_properti = d.id
                    left join properti_kav e on b.id_kav = e.id
                    left join konsumen f on b.id_konsumen = f.id
                    where a.id_fee='$id'
       ");

        return view('Marketingfee::detail', ['data' => $data] );
    }


}
