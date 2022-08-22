<?php

namespace App\Modules\Trxkonsumen\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
 
use App\Modules\Trxkonsumen\Models\Trxkonsumen;
use App\Modules\Konsumen\Models\Konsumen;
use App\Modules\Mproperti\Models\Mproperti;
use App\Modules\Munit\Models\Munit;
use App\Modules\Trxkonsumen\Models\Tagihan;
use App\Modules\Trxkonsumen\Models\Konsumenlog;
use App\Modules\Bookingm\Models\Bookingm;
use App\Helpers\Tanggal;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrxkonsumenController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param Users $data
     */

    public function __construct(Trxkonsumen $data)
    {
        $this->data = $data;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
	public function index()
    {
         $data = Trxkonsumen::select(db::raw("konsumen_spr.id,konsumen.nama as nama_konsumen,konsumen_spr.tgl_transaksi as tanggal, 
                                                properti.nama as nama_properti, 
                                                properti_kav.nama as nama_kav, 
                                                konsumen_spr.cara_bayar_unit,
                                                properti_kav.tipe as tipe_unit,
                                                gross_total"))
                                                ->leftjoin("properti","konsumen_spr.id_properti","=","properti.id")
                                                ->leftjoin("properti_kav","konsumen_spr.id_kav","=","properti_kav.id")
                                                ->leftjoin("konsumen","konsumen_spr.id_konsumen","=","konsumen.id")
                                                ->where("status_spr","=","1")
                                             ->get();

        return view('Trxkonsumen::index', 
                        [
                            'data' => $data
                        ]
                    );
	}
    public function tambah()
    {
        $listproperti = Mproperti::all();
        $konsumen = Konsumen::where("iskonsumen","=","0")->get();

        return view('Trxkonsumen::tambah', 
                        ['konsumen' =>$konsumen,
                            'listproperti' => $listproperti
                        ]
                    );
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $listdepartment =  $this->data->listdepartment();
        $listjabatan =  $this->data->listjabatan();
       // $listcabang =  $this->data->cabang();
        
        return view("users::create", ['listjabatan' => $listjabatan,
                            'listdepartment' => $listdepartment,
                        // 'listcabang' => $listcabang,
                            ]);

        return view('Trxkonsumen::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'id_konsumen'           => 'required|numeric',
            'id_properti'    => 'required|numeric',
            'id_kav'         => 'required|numeric', 
            'tgl_transaksi'  => 'required', 
            'gross_unit'     => 'required', 
            'gross_total'    => 'required', 
            'gross_booking'  => 'required',
            'cara_bayar_unit'  => 'required', 
            'nama'  => 'required', 
            //'alamat'  => 'required', 
            //'telp'  => 'required',  
            //'idcard'  => 'required', 
        ); 

        $validator = Validator::make($request->all(), $rules); 

        if ($validator->fails()) {

			$arr = array('msg' =>"Data Gagal disimpan!!", 'status'=>false);
            return response()->json($arr); 

        } else {
            
			$gross_penambahan_tanah = str_replace(",","",$request->input('gross_penambahan_tanah'));
			$gross_penambahan_lain = str_replace(",","",$request->input('gross_penambahan_lain'));
            $ppn = str_replace(",","",$request->input('ppn'));
            $gross_total= str_replace(",","",$request->input('gross_total'));
            $gross_booking= str_replace(",","",$request->input('gross_booking'));
            $gross_umnya= str_replace(",","",$request->input('gross_umnya'));
            $gross_unit= str_replace(",","",$request->input('gross_unit'));
			
            $noUrutAkhir = Trxkonsumen::max('id');
            $kode = "SPR-".sprintf("%04s", $noUrutAkhir + 1);

            
            $data = new Trxkonsumen;
            $data->kode = $kode;
            $data->id_marketing     	= $request->input('id_marketing');
            $data->id_konsumen      	= $request->input('id_konsumen');
            $data->id_properti      	= $request->input('id_properti');
            $data->id_kav           	= $request->input('id_kav');
            $data->bonus            	= $request->input('bonus');
            $data->tgl_transaksi    	= $request->input('tgl_transaksi');
            
            $data->luas_penambahan_tanah     = str_replace(" ","",$request->input('luas_penambahan_tanah'));
            $data->harga_penambahan_tanah    = str_replace(",","",$request->input('harga_penambahan_tanah'));
            $data->gross_penambahan_tanah    = $gross_penambahan_tanah;
            $data->penambahan_lain       = $request->input('penambahan_lain');
            $data->harga_penambahan_lain       = str_replace(",","",$request->input('harga_penambahan_lain'));
            $data->gross_penambahan_lain = $gross_penambahan_lain;
            $data->gross_unit       	= $gross_unit;
            $data->ppn 			      	= $ppn;
            $data->gross_total      	= $gross_total;
            $data->gross_booking    	= $gross_booking;
            $data->gross_um           	=  $gross_umnya;            
            $data->gross_rev_kpr        = ($gross_unit - $gross_booking - $gross_umnya);
            
			$data->gross              	= str_replace(",","",$request->input('gross_akh'));
            $data->cara_bayar_unit  	= $request->input('cara_bayar_unit');
            $data->tahapan_um        	= $request->input('tahapan_um');
            $data->tahapan_unit     	= $request->input('tahapan_unit');
            $data->tanggal_jt_booking 	= $request->input('tanggal_jt_booking');
            $data->tanggal_jt_um    	= $request->input('tanggal_jt_um');
            $data->tanggal_jt_penambahan = $request->input('tanggal_jt_penambahan');
            $data->tanggal_jt_unit  	= $request->input('tanggal_jt_unit'); 
            $data->created_by           = Auth::user()->name;
            $data->save();
			
			 //================= Update Data Konsumen===================================
			$ko = Konsumen::findOrFail($request->input('id_konsumen'));
			$ko->nama = $request->input("nama");
			$ko->alamat = $request->input("alamat");
			$ko->telp = $request->input("telp");
			$ko->idcard = $request->input("idcard");
			$ko->save();
			
             //=================Insert Log Konsumen===================================
            $k = new Konsumenlog;
            $k->id_konsumen = $data->id_konsumen;
            $k->id_marketing = $data->id_marketing; 
            $k->id_properti = $data->id_properti; 
            $k->id_kav = $data->id_kav;
            $k->id_spr = $data->id; 
            $k->tanggal = date("Y-m-d"); 
            $k->status = "MOU Konsumen"; 
            $k->keterangan = "MOU Konsumen : nomor - ".$kode." , Nama Petugas : ". Auth::user()->name; 
            $k->created_by = Auth::user()->name; 
            $k->save();
             //=================Insert Log Konsumen===================================

            //======================= Insert Tagihan DP =============================
            $dbtag_um = new Tagihan;
            $dbtag_um->id_spr       = $data->id;
            $dbtag_um->id_jenis     = 1;
            $dbtag_um->urutan       = 1;
            $dbtag_um->nilai_mou    = str_replace(",","",$request->input('gross_total'));
            $dbtag_um->tagihan      = str_replace(",","",$request->input('gross_booking'));
            $dbtag_um->tgl_jatuhtempo  = $request->input('tanggal_jt_booking');    
            $dbtag_um->bayar        = 0;
            $dbtag_um->status        = "Belum Lunas";
            $dbtag_um->kurang       = str_replace(",","",$request->input('gross_booking'));
            $dbtag_um->created_by   = Auth::user()->name;
            $dbtag_um->save(); 

 
            if(is_array($request->input('tag_um')) && count($request->input('tag_um')) > 0){ 
                $no = 1;
                foreach($request->input('tag_um') as $r)
                {
                    $dbtag_um = new Tagihan;
                    $dbtag_um->id_spr       = $data->id;
                    $dbtag_um->id_jenis     = 2;
                    $dbtag_um->urutan       = $no;
                    $dbtag_um->nilai_mou    =  str_replace(",","",$request->input('gross_total'));
                    $dbtag_um->tagihan      = $r;
                    $dbtag_um->bayar        = 0;
                    $dbtag_um->status        = "Belum Lunas";
                    $dbtag_um->kurang       = $r; 
                    if($no == 0){
                        $dbtag_um->tgl_jatuhtempo  = $request->input('tanggal_jt_um');    
                    }else{
                        $dbtag_um->tgl_jatuhtempo  = Tanggal::bulan_depan_plus($request->input('tanggal_jt_um'),$no);
                    }                    

                    $dbtag_um->created_by  = Auth::user()->name;
                    $dbtag_um->save();
                    $no++;
                }
            } 

            //tanah
			if($gross_penambahan_tanah > 0 && $request->input('cara_bayar_unit') == "kpr"){
				$tn = new Tagihan;
				$tn->id_spr       = $data->id;
				$tn->id_jenis     = 3;
				$tn->urutan    	= 1;
				$tn->nilai_mou    =  str_replace(",","",$request->input('gross_total'));
				$tn->tagihan      = $gross_penambahan_tanah;
				$tn->bayar        = 0;
				$tn->kurang       = $gross_penambahan_tanah;
				$tn->tgl_jatuhtempo  = $request->input('tanggal_jt_penambahan');          
				$tn->created_by  = Auth::user()->name;
				$tn->save();
			}
			//talin lain
			if($gross_penambahan_lain > 0 && $request->input('cara_bayar_unit') == "kpr"){
				$tl = new Tagihan;
				$tl->id_spr       = $data->id;
				$tl->id_jenis     = 4;
				$tl->urutan    	= 1;
				$tl->nilai_mou    =  str_replace(",","",$request->input('gross_total'));
				$tl->tagihan      = $gross_penambahan_lain;
				$tl->bayar        = 0;
				$tl->kurang       = $gross_penambahan_lain;
				$tl->tgl_jatuhtempo  = $request->input('tanggal_jt_penambahan');          
				$tl->created_by 	= Auth::user()->name;
				$tl->save();
			}
			
			// ppn
			/* if($ppn > 0){
				$p = new Tagihan;
				$p->id_spr       = $data->id;
				$p->id_jenis     = 6;
				$p->urutan    	= 1;
				$p->nilai_mou    =  str_replace(",","",$request->input('gross_total'));
				$p->tagihan      = $ppn;
				$p->bayar        = 0;
				$p->kurang       = $ppn;
				$p->tgl_jatuhtempo  = $request->input('tanggal_jt_unit');  
				$p->created_by 	= Auth::user()->name;
				$p->save();
			} */
            // cicilan unit
            if(is_array($request->input('tag_unit')) && count($request->input('tag_unit')) > 0 && $request->input('cara_bayar_unit') == "bertahap"){ 
				$no = 1;
                foreach($request->input('tag_unit') as $r)
                {
                    $dbtag_um = new Tagihan;
                    $dbtag_um->id_spr       = $data->id;
                    $dbtag_um->id_jenis     = 5;
                    $dbtag_um->urutan     = $no;
                    $dbtag_um->nilai_mou    =  str_replace(",","",$request->input('gross_total'));
                    $dbtag_um->tagihan      = $r;
                    $dbtag_um->bayar        = 0;
                    $dbtag_um->kurang       = $r;
                    if($no == 0){
                        $dbtag_um->tgl_jatuhtempo  = $request->input('tanggal_jt_unit');    
                    }else{
                        $dbtag_um->tgl_jatuhtempo  = Tanggal::bulan_depan_plus($request->input('tanggal_jt_unit'),$no);
                    }          
                    $dbtag_um->created_by  = Auth::user()->name;
                    $dbtag_um->save();
                    $no++;
                     
                }
            }

			 
			 
			//update Status Unit jadi Sold
            $data = Munit::findOrFail($request->input('id_kav'));
            $data->status = 4;
            $data->save();   
            
			//update Status Konsumen jadi Konsumen
            $data = Konsumen::findOrFail($request->input('id_konsumen'));
            $data->iskonsumen  = 1;
            $data->id_properti = $request->input('id_properti');
            $data->save();
			
			//Update Status Booking jadi  batal 
			$data_booking = Bookingm::where("id_kav","=",$request->input('id_kav'))->get();
			foreach($data_booking as $r){
				if($r->id_konsumen == $request->input('id_konsumen')){
					$x = Bookingm::findOrFail($r->id);
					$x->status = 1;
					$x->keterangan_batal = "MOU Penjualan Sudah Dilakukan";
					$x->tanggal_batal = date("Y-m-d");
					$x->save();						
				}else{
					$x = Bookingm::findOrFail($r->id);
					$x->status = 0;
					$x->keterangan_batal = "MOU Penjualan Sudah Dilakukan Oleh Konsumen Lain";
					$x->tanggal_batal = date("Y-m-d");
					$x->save();		
				}
				
			}
			
            $pesan = "Pemberitahuan MOU Pembelian Unit 
Mou Oleh:". Auth::user()->name."
Nama Konsumen:". $request->input("nama");		
            $this->data->insertwa($pesan);
 
			$arr = array('msg' =>"Data Berhasil disimpan!!", 'status'=>true);
            return response()->json($arr); 

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

    
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function preview($id)
    {
        $data = $this->data->preview($id);
        $tagihan = Tagihan::select(db::raw("tagihan.*, jenis_tagihan.nama as nama_tagihan"))
						->leftjoin("jenis_tagihan","tagihan.id_jenis","=","jenis_tagihan.id")
						->where("id_spr","=",$id)
						->OrderBy("tagihan.id","ASC")->get();
        return view('Trxkonsumen::preview',['data' => $data, 'tagihan' => $tagihan]);
    }
	
	 /**
     * Display a listing of the resource.
     * @return Response
     */
    public function isikan(Request $request)
    {
        $kode = $request->input("query");
        
        $data = Konsumen::select(DB::raw("konsumen.id,properti.nama as nama_properti,
                konsumen.kode,konsumen.nama,idcard,konsumen.alamat,telp,id_properti,id_marketing")) 
        ->leftjoin("properti","konsumen.id_properti","=","properti.id")
        ->where("konsumen.id","=",$kode)
        ->where("konsumen.iskonsumen","=",0)
        ->get();
        $a = response()->json($data);
        return $a; 
    }

}
