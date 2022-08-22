<?php

namespace App\Modules\Gl\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Gl\Models\Gl; 
use App\Modules\Mproperti\Models\Mproperti;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use App\Helpers\Tanggal;

class GlController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @param Gl $data
     */

    public function __construct(Gl $data)
    {
        $this->data = $data;
    }
	
	public function index()
    {
        $properti = Mproperti::OrderBy('created_at','desc')->get();
        return view('Gl::index', ['properti' => $properti] );
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
		
		$nilai = array();
        $db = DB::connection('mysql'); 
		
		$listakun = $db->select("SELECT kode,nama_akun,posting,kat 
								FROM daftar_akun 
								WHERE length(kode) >='4' ORDER BY id;");
		
        if($id_properti == "all"){
			//All Perumahan
			foreach($listakun as $r){
				$kode = $r->kode;
				$kat = $r->kat;
				$posting = $r->posting;
				$nilai[$kode] = 0;
				$nilai_d[$kode] = 0;
				$nilai_k[$kode] = 0;
				if($posting == "D"){
					$hit_saldo = "sum(debit) - sum(kredit)";
				}else{
					$hit_saldo = "sum(kredit) - sum(debit)";
				}
				if($kat == "NERACA"){
					$s = $db->select("SELECT  
									id_akun, sum(debit) as d, sum(kredit) as k, $hit_saldo as saldo
									FROM jurnalid 
									WHERE 
									id_akun = '$kode' 
									AND tanggal <= '$tanggal2' 
									group by id_akun");
					foreach($s as $rs){
						$nilai[$kode] = $rs->saldo; 
						$nilai_d[$kode] = $rs->d;
						$nilai_k[$kode] = $rs->k; 
					}
				}else{
					$s = $db->select("SELECT  
									id_akun, sum(debit) as d, sum(kredit) as k,$hit_saldo as saldo
									FROM jurnalid 
									WHERE 
									id_akun = '$kode'
									AND	tanggal BETWEEN '$tanggal1' AND '$tanggal2'
									group by id_akun");
					foreach($s as $rs){
						$nilai[$kode] = $rs->saldo; 
						$nilai_d[$kode] = $rs->d;
						$nilai_k[$kode] = $rs->k; 
					}
				}
			} 
        }else{
			//Per Perumahan
			foreach($listakun as $r){
				$kode = $r->kode;
				$kat = $r->kat;
				$posting = $r->posting;
				$nilai[$kode] = 0;
				$nilai_d[$kode] = 0;
				$nilai_k[$kode] = 0;
				if($posting == "D"){
					$hit_saldo = "sum(debit) - sum(kredit)";
				}else{
					$hit_saldo = "sum(kredit) - sum(debit)";
				}
				
				if($kat == "NERACA"){
					$s = $db->select("SELECT  
									id_akun, sum(debit) as d, sum(kredit) as k, $hit_saldo as saldo
									FROM jurnalid 
									WHERE 
									id_akun = '$kode' 
									AND id_properti = $id_properti
									AND tanggal <= '$tanggal2' 
									group by id_akun");
					foreach($s as $rs){
						$nilai[$kode] = $rs->saldo; 
						$nilai_d[$kode] = $rs->d;
						$nilai_k[$kode] = $rs->k; 
					}
				}else{
					$s = $db->select("SELECT  
									id_akun, sum(debit) as d, sum(kredit) as k, $hit_saldo as saldo
									FROM jurnalid 
									WHERE 
									id_akun = '$kode'									
									AND id_properti = $id_properti
									AND	tanggal BETWEEN '$tanggal1' AND '$tanggal2'
									group by id_akun");
					foreach($s as $rs){
						$nilai[$kode] = $rs->saldo; 
						$nilai_d[$kode] = $rs->d;
						$nilai_k[$kode] = $rs->k; 
					}
				}
			} 
		}  

        return view('Gl::preview',['listakun' => $listakun, 'nilai' => $nilai,'nilai_d' => $nilai_d,'nilai_k' => $nilai_k,
											'tanggal1' => $tanggal1, 'tanggal2' => $tanggal2, 'id_properti' => $id_properti]);
         
    }
	
	public function datanya(Request $request)
    {
        $kode = $request->id;
        $tanggal1 = $request->tanggal1;
        $tanggal2 = $request->tanggal2;
        $id_properti = $request->id_properti;
		
		$db = DB::connection('mysql');
        
		$listakun = $db->select("SELECT kode,nama_akun,posting,kat 
								FROM daftar_akun 
								WHERE kode='$kode' group by kode");
		foreach($listakun as $r){ 
			$kat = $r->kat; 
			if($id_properti == "all"){
				if($kat == "NERACA"){
					$data = $db->select("SELECT a.id,b.kode,b.nama_akun,a.tanggal,a.keterangan, a.created_by, debit as d, kredit as k 
					FROM jurnalid a
					LEFT JOIN daftar_akun b on a.id_akun = b.kode
					WHERE a.id_akun = $kode 
					AND tanggal <= '$tanggal2' 
					ORDER BY a.tanggal");	
				}else{
					$data = $db->select("SELECT a.id,b.kode,b.nama_akun,a.tanggal,a.keterangan, a.created_by, debit as d, kredit as k 
					FROM jurnalid a
					LEFT JOIN daftar_akun b on a.id_akun = b.kode
					WHERE a.id_akun = $kode
					and tanggal BETWEEN '$tanggal1' AND '$tanggal2' 
					ORDER BY a.tanggal");
				}
			}else{
				if($kat == "NERACA"){
					$data = $db->select("SELECT a.id,b.kode,b.nama_akun,a.tanggal,a.keterangan, a.created_by, debit as d, kredit as k 
					FROM jurnalid a
					LEFT JOIN daftar_akun b on a.id_akun = b.kode
					WHERE a.id_akun = $kode and id_properti = '$id_properti'
					 AND tanggal <= '$tanggal2' 
					ORDER BY a.tanggal");	
				}else{
					$data = $db->select("SELECT a.id,b.kode,b.nama_akun,a.tanggal,a.keterangan, a.created_by, debit as d, kredit as k 
					FROM jurnalid a
					LEFT JOIN daftar_akun b on a.id_akun = b.kode
					WHERE a.id_akun = $kode and id_properti = '$id_properti'
					and tanggal BETWEEN '$tanggal1' AND '$tanggal2' 
					ORDER BY a.tanggal");
				}
			}
		
		}  
        return view('Gl::preview2',['data' => $data, 
											'tanggal1' => $tanggal1, 
											'tanggal2' => $tanggal2]);

    } 
     
}
