<?php

namespace App\Modules\Pindahkav\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
 
use App\Modules\Pindahkav\Models\Pindahkav;
use App\Modules\Konsumen\Models\Konsumen;
use App\Modules\Mproperti\Models\Mproperti;
use App\Modules\Munit\Models\Munit;
use App\Modules\Pindahkav\Models\Tagihan;
use App\Modules\Pindahkav\Models\Konsumenlog;
use App\Helpers\Tanggal;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PindahkavController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param Users $data
     */

    public function __construct(Pindahkav $data)
    {
        $this->data = $data;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
	public function index()
    {
         $data = Pindahkav::select(db::raw("konsumen_spr.id,konsumen.nama as nama_konsumen,konsumen_spr.tgl_transaksi as tanggal, 
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

        return view('Pindahkav::index', 
                        [
                            'data' => $data
                        ]
                    );
    }
    
    public function setpindah($id)
    {
        $listproperti = Mproperti::all(); 
        $tagihan_nya = array(); 

        $data = $this->data->preview($id);

        $tagihan = Tagihan::select(db::raw("tagihan.*, jenis_tagihan.nama as nama_tagihan"))
						->leftjoin("jenis_tagihan","tagihan.id_jenis","=","jenis_tagihan.id")
						->where("id_spr","=",$id)
						->wherein("id_jenis",[2,5])
                        ->OrderBy("tagihan.id","ASC")->get();
        foreach($tagihan as $r){
            $tagihan_nya[$r->id_jenis][$r->urutan] = $r->tagihan;
        }

        return view('Pindahkav::tambah', 
                        [ 
                            'data' => $data,
                            'id' => $id, 'tagihannya' => $tagihan_nya,
                            'listproperti' => $listproperti
                        ]
                    );
    }

    
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array( 
            'id_properti'    => 'required|numeric',
            'id_kav'         => 'required|numeric', 
            'tgl_transaksi'  => 'required', 
            'gross_unit'     => 'required', 
            'gross_total'    => 'required', 
            'gross_booking'  => 'required',
            'cara_bayar_unit'  => 'required'
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
			
            $id_spr = $request->input('id_spr');
            
            DB::statement("INSERT INTO konsumen_spr_bck(kode, id_marketing, id_konsumen, id_properti, id_kav, status_spr, tgl_transaksi, luas_penambahan_tanah, harga_penambahan_tanah, penambahan_lain, harga_penambahan_lain, gross_booking, gross_um, gross_penambahan_tanah, gross_penambahan_lain, gross_unit, gross_rev_kpr, gross_total, gross, ppn, cara_bayar_um, cara_bayar_penambahan, cara_bayar_unit, tahapan_um, tahapan_penambahan, tahapan_unit, tanggal_jt_booking, tanggal_jt_um, tanggal_jt_penambahan, tanggal_jt_unit, realisasi, realisasi_rp, sp3k_status, sp3k_nominal, ismanajer, iscancel, isbangun, krg_byr_um, krg_byr_penambahan, krg_byr_unit, krg_byr_total, notif, bonus, log_kpr, log_kpr_bank, keterangan, created_by, created_at, updated_at)
            select kode, id_marketing, id_konsumen, id_properti, id_kav, status_spr, tgl_transaksi, luas_penambahan_tanah, harga_penambahan_tanah, penambahan_lain, harga_penambahan_lain, gross_booking, gross_um, gross_penambahan_tanah, gross_penambahan_lain, gross_unit, gross_rev_kpr, gross_total, gross, ppn, cara_bayar_um, cara_bayar_penambahan, cara_bayar_unit, tahapan_um, tahapan_penambahan, tahapan_unit, tanggal_jt_booking, tanggal_jt_um, tanggal_jt_penambahan, tanggal_jt_unit, realisasi, realisasi_rp, sp3k_status, sp3k_nominal, ismanajer, iscancel, isbangun, krg_byr_um, krg_byr_penambahan, krg_byr_unit, krg_byr_total, notif, bonus, log_kpr, log_kpr_bank, keterangan, created_by, created_at, updated_at
            from konsumen_spr where  id = '$id_spr'"); 

            
            $u1 = Pindahkav::findOrFail($id_spr); 
                //Update Kavling Lama
                $munitedit = Munit::findOrFail( $u1->id_kav);
                $munitedit->status = 1;
                $munitedit->save();   
                //
            $data = Pindahkav::findOrFail($id_spr); 
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
            
			$data->gross              	= ($gross_total - $gross_booking - $gross_umnya + $ppn );
            $data->cara_bayar_unit  	= $request->input('cara_bayar_unit');
            $data->tahapan_um        	= $request->input('tahapan_um');
            $data->tahapan_unit     	= $request->input('tahapan_unit');
            $data->tanggal_jt_booking 	= $request->input('tanggal_jt_booking');
            $data->tanggal_jt_um    	= $request->input('tanggal_jt_um');
            $data->tanggal_jt_penambahan = $request->input('tanggal_jt_penambahan');
            $data->tanggal_jt_unit  	= $request->input('tanggal_jt_unit'); 
            $data->created_by           = Auth::user()->name;
            $data->save();
			
			 
			
             //=================Insert Log Konsumen===================================
            $k = new Konsumenlog;
            $k->id_konsumen = $data->id_konsumen;
            $k->id_marketing = $data->id_marketing; 
            $k->id_properti = $data->id_properti; 
            $k->id_kav = $data->id_kav;
            $k->id_spr = $data->id; 
            $k->tanggal = date("Y-m-d"); 
            $k->status = "Pindah Kavling"; 
            $k->keterangan = "Pindah Kavling : nomor - ".$data->kode." , Nama Petugas : ". Auth::user()->name; 
            $k->created_by = Auth::user()->name; 
            $k->save();
             //=================Insert Log Konsumen===================================

            //======================= Insert Tagihan DP =============================
            DB::statement("INSERT INTO tagihan_bck(id_spr, id_jenis, status_spr, urutan, nilai_mou, tagihan, bayar, kurang, tgl_bayar, tgl_jatuhtempo, keterangan, `status`, approval1, approval2, approval3, approval4, created_by, created_at, updated_at)
            select id_spr, id_jenis, status_spr, urutan, nilai_mou, tagihan, bayar, kurang, tgl_bayar, tgl_jatuhtempo, keterangan, `status`, approval1, approval2, approval3, approval4, created_by, created_at, updated_at from tagihan where  id_spr = '$id_spr'"); 

            DB::statement("update tagihan set nilai_mou='$gross_total', 
                            tagihan = '$gross_booking',
                            tgl_jatuhtempo = '".$request->input('tanggal_jt_booking')."',
                            kurang = $gross_booking - bayar,
                            `status` = if(kurang <= 0,'Lunas','Belum Lunas'),
                            created_by = '".Auth::user()->name."'
                            where id_spr = '$id_spr' and id_jenis = 1;          
            ");
            
            if(is_array($request->input('tag_um')) && count($request->input('tag_um')) > 0){ 
                $no = 1;
                foreach($request->input('tag_um') as $r)
                {
                    if($no == 1){
                        $jtum = $request->input('tanggal_jt_um');    
                    }else{
                        $jtum  = Tanggal::bulan_depan_plus($request->input('tanggal_jt_um'),$no-1);
                    }    
                    $ucek = $this->data->cektagihan($id_spr,2,$no);
                    if(count($ucek) > 0){
                        DB::statement("update tagihan set 
                                        nilai_mou='$gross_total', 
                                        tagihan = '$r',
                                        tgl_jatuhtempo = '$jtum',
                                        kurang = $gross_booking - bayar,
                                        `status` = if(kurang <= 0,'Lunas','Belum Lunas'),
                                        created_by = '".Auth::user()->name."'
                                        where id_spr = '$id_spr' and id_jenis = 2 and urutan='$no';          
                        ");
                    }else{
                        $dbtag_um = new Tagihan;
                        $dbtag_um->id_spr       = $data->id;
                        $dbtag_um->id_jenis     = 2;
                        $dbtag_um->urutan       = $no;
                        $dbtag_um->nilai_mou    =  str_replace(",","",$request->input('gross_total'));
                        $dbtag_um->tagihan      = str_replace(",","",$r);
                        $dbtag_um->bayar        = 0;
                        $dbtag_um->status       = "Belum Lunas";
                        $dbtag_um->kurang       = str_replace(",","",$r); 
                        $dbtag_um->tgl_jatuhtempo  = $request->input('tanggal_jt_um');    
                        $dbtag_um->created_by  = Auth::user()->name;
                        $dbtag_um->save();
                    }
                   

                   
                    $no++;
                    
                }
                DB::statement("DELETE FROM tagihan where id_spr = '$id_spr' and id_jenis = 2 and urutan >= $no");
                
            }else{
                DB::statement("DELETE FROM tagihan where id_spr = '$id_spr' and id_jenis = 2");
            } 

            if(is_array($request->input('tag_unit')) && count($request->input('tag_unit')) > 0 && $request->input('cara_bayar_unit') == "bertahap"){ 
				$no = 1;
                foreach($request->input('tag_unit') as $r)
                {
                    if($no == 1){
                        $jtunit = $request->input('tanggal_jt_unit');    
                    }else{
                        $jtunit  = Tanggal::bulan_depan_plus($request->input('tanggal_jt_unit'),$no-1);
                    }    
                    
                    $ucek = $this->data->cektagihan($id_spr,5,$no);
                    if(count($ucek) > 0){
                        DB::statement("update tagihan set 
                                        nilai_mou='$gross_total', 
                                        tagihan = '".str_replace(",","",$r)."',
                                        tgl_jatuhtempo = '$jtunit',
                                        kurang = ".str_replace(",","",$r)." - bayar,
                                        `status` = if(kurang <= 0,'Lunas','Belum Lunas'),
                                        created_by = '".Auth::user()->name."'
                                        where id_spr = '$id_spr' and id_jenis = 5 and urutan='$no';          
                        ");
                    }else{
                        $dbtag_um = new Tagihan;
                        $dbtag_um->id_spr       = $data->id;
                        $dbtag_um->id_jenis     = 5;
                        $dbtag_um->urutan       = $no;
                        $dbtag_um->nilai_mou    =  str_replace(",","",$request->input('gross_total'));
                        $dbtag_um->tagihan      = str_replace(",","",$r); 
                        $dbtag_um->bayar        = 0;
                        $dbtag_um->status       = "Belum Lunas";
                        $dbtag_um->kurang       = str_replace(",","",$r); 
                        $dbtag_um->tgl_jatuhtempo  = $jtunit;    
                        $dbtag_um->created_by  = Auth::user()->name;
                        $dbtag_um->save();
                    }

                    $no++;
                     
                }
                DB::statement("DELETE FROM tagihan where id_spr = '$id_spr' and id_jenis = 5 and urutan >= $no");
            }else{
                DB::statement("DELETE FROM tagihan where id_spr = '$id_spr' and id_jenis = 5");
            } 
			 
			if($gross_penambahan_tanah > 0 && $request->input('cara_bayar_unit') == "kpr"){
                $ucek = $this->data->cektagihan($id_spr,3,1);
                if(count($ucek) > 0){
                    DB::statement("update tagihan set 
                                    nilai_mou='$gross_total', 
                                    tagihan = '$gross_penambahan_tanah',
                                    tgl_jatuhtempo = '".$request->input('tanggal_jt_penambahan')."',
                                    kurang = $gross_penambahan_tanah - bayar,
                                    `status` = if(kurang <= 0,'Lunas','Belum Lunas'),
                                    created_by = '".Auth::user()->name."'
                                    where id_spr = '$id_spr' and id_jenis = 3 and urutan='1';          
                    ");
                }else{
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
            }else{
                DB::statement("DELETE FROM tagihan where id_spr = '$id_spr' and id_jenis = 3");
            } 
            
			if($gross_penambahan_lain > 0 && $request->input('cara_bayar_unit') == "kpr"){
                $ucek = $this->data->cektagihan($id_spr,4,1);
                if(count($ucek) > 0){
                    DB::statement("update tagihan set 
                                    nilai_mou='$gross_total', 
                                    tagihan = '$gross_penambahan_lain',
                                    tgl_jatuhtempo = '".$request->input('tanggal_jt_penambahan')."',
                                    kurang = $gross_penambahan_lain - bayar,
                                    `status` = if(kurang <= 0,'Lunas','Belum Lunas'),
                                    created_by = '".Auth::user()->name."'
                                    where id_spr = '$id_spr' and id_jenis = 4 and urutan='1';          
                    ");
                }else{
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
            }else{
                DB::statement("DELETE FROM tagihan where id_spr = '$id_spr' and id_jenis = 4");
            } 
			
			
			/* if($ppn > 0){
                $ucek = $this->data->cektagihan($id_spr,6,1);
                if(count($ucek) > 0){
                    DB::statement("update tagihan set 
                                    nilai_mou='$gross_total', 
                                    tagihan = '$ppn',
                                    tgl_jatuhtempo = '".$request->input('tanggal_jt_penambahan')."',
                                    kurang = $ppn - bayar,
                                    `status` = if(kurang <= 0,'Lunas','Belum Lunas'),
                                    created_by = '".Auth::user()->name."'
                                    where id_spr = '$id_spr' and id_jenis = 6 and urutan='1';          
                    ");
                }else{
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
                }
            }else{
                DB::statement("DELETE FROM tagihan where id_spr = '$id_spr' and id_jenis = 6");
            }  */
			 
			//update Status Unit jadi Sold
            $data = Munit::findOrFail($request->input('id_kav'));
            $data->status = 4;
            $data->save();   
            
			//update Status Konsumen jadi Konsumen
            $data = Konsumen::findOrFail($u1->id_konsumen);
            $data->iskonsumen  = 1;
            $data->id_properti = $request->input('id_properti');
            $data->save();
 
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
        return view('Pindahkav::preview',['data' => $data, 'tagihan' => $tagihan]);
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

        return response()->json($data); 
    }

}
