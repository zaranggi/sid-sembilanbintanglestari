<?php

namespace App\Modules\Hisjurnal\Http\Controllers;


use App\Modules\Jurnalumum\Models\Jurnalumum; 
use App\Modules\Mproperti\Models\Mproperti;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Helpers\Tanggal;
class HisjurnalController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @param Jurnalumum $data
     */

    public function __construct(Jurnalumum $data)
    {
        $this->data = $data;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $properti = Mproperti::OrderBy('created_at','desc')->get();
        return view('Hisjurnal::index', ['properti' => $properti] );
    }

   /**
     * Display a listing of the resource.
     * @return Response
     */
    public function preview(Request $request)
    {
        $tanggal1 = $request->input("tanggal1");
        $tanggal2 = $request->input("tanggal2");
        $id_properti = $request->input("id_properti");

        $db = DB::connection('mysql');
     
            
        if($id_properti == "all"){
            $data = $db->select("SELECT a.id,a.tanggal,a.keterangan, a.created_by, sum(debit) d, sum(kredit) k 
            FROM jurnal a
            LEFT JOIN jurnalid b ON a.id = b.id_jurnal
            WHERE a.tanggal BETWEEN '$tanggal1' AND '$tanggal2'
            GROUP BY a.id
            ORDER BY a.id");
        }else{
            $data = $db->select("SELECT a.id,a.tanggal,a.keterangan,a.created_by, sum(debit) d, sum(kredit) k 
            FROM jurnal a
            LEFT JOIN jurnalid b ON a.id = b.id_jurnal
            WHERE a.tanggal BETWEEN '$tanggal1' AND '$tanggal2'
            AND a.id_properti = '$id_properti'
            GROUP BY a.id
            ORDER BY a.id");
        } 

        return view('Hisjurnal::preview',['data' => $data, 'tanggal1' => $tanggal1, 'tanggal2' => $tanggal2]);
         
    }

    public function datanya(Request $request)
    {
        $id = $request->input("id");

        $db = DB::connection('mysql');
        $data = $db->select("SELECT a.id,b.kode,b.nama_akun,a.tanggal,a.keterangan, a.created_by, debit as d, kredit as k 
        FROM jurnalid a
        LEFT JOIN daftar_akun b on a.id_akun = b.kode
        WHERE a.id_jurnal = $id
        GROUP BY a.id
        ORDER BY a.id");
        $a = '<thead>
        <tr class="text-center bg-info">
            <th >Tanggal</th>
            <th >Kode</th>
            <th >Keterangan</th>
            <th >Debit</th>
            <th >Kredit</th>  
        </tr>
    </thead><tbody>';
            $td = 0;
            $tk = 0;
        foreach($data  as $r){
            $tanggal = Tanggal::tgl_indo($r->tanggal);
            $kode = $r->kode;
            $nama_akun = $r->nama_akun;
            $keterangan = $r->keterangan;
            $d = number_format($r->d);
            $k = number_format($r->k);
            $a = $a."
            <tr><td class='text-center'>".$tanggal."</td><td class='text-center'>".$kode."</td><td><h6 class='mb-0'>  <a href='#'>".$nama_akun."</a>  <span class='d-block font-size-sm text-muted'>".$keterangan."</span>  </h6></td><td class='text-right'>".$d."</td><td class='text-right'>".$k."</td></tr>
            ";
            $td += $r->d;
            $tk += $r->k;
        }
        $td = number_format($td);
        $tk = number_format($tk);
        $a = $a."</tbody><tfoot><tr class='bg-lime'><th colspan='3' class='text-center'>Grand Total</th><th class='text-right'>$td</th><th class='text-right'>$tk</th></tr></tfoot>";

       return $a;

    }
     
}
