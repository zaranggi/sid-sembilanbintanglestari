<?php
namespace App\Modules\Materialkeluar\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Modules\Materialkeluar\Models\Stmast;
/**
 * @property array|null|string name
 */
class Materialkeluar extends Model {
	protected $table = 'prodmast';
	protected $primaryKey = 'prdcd'; // or null	
	public $timestamps = true;

    public function data()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('prodmast')
		->select(db::raw("prodmast.*, stmast.qty"))
		->leftjoin("stmast", "prodmast.prdcd","=","stmast.prdcd")
		->OrderBy('prodmast.prdcd', 'ASC')
		->get();	    
		return $listuser;
	}	
	public function data2($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('prodmast')
		->leftjoin("stmast", "prodmast.prdcd","=","stmast.prdcd")
		->where("prodmast.prdcd", "=",$id)
		->OrderBy('prodmast.prdcd', 'ASC')
		->get();	    
		return $listuser;
	}	
	
	public function listunittemp()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('mstran_unit_temp')
		->select(db::raw("mstran_unit_temp.prdcd,mstran_unit_temp.qty,prodmast.nama,prodmast.satuan"))
		->leftjoin("prodmast","mstran_unit_temp.prdcd", "=","prodmast.prdcd")
		->OrderBy('mstran_unit_temp.prdcd', 'ASC')
		->get();	    
		return $listuser;
	}	
	
	public function unittambah($prdcd,$qty)
	{
		$db = DB::connection('mysql');
		$db->table('mstran_unit_temp')->where('prdcd', '=',$prdcd)->delete();
		$db->table('mstran_unit_temp')->insert(
					['prdcd' => $prdcd, 'qty' => $qty]
		);
	}
	public function unitdelete($prdcd)
	{
		$db = DB::connection('mysql');
		$db->table('mstran_unit_temp')->where('prdcd', '=',$prdcd)->delete();
		
	}
	 
	 
	public function listproperti()
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti')
				->select(db::raw("id,nama"))
				->OrderBy('id', 'ASC')
				->get();	    
		return $data;
	}	
	
	public function listunit($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti_kav')
				->where('id_properti','=', $id) 
				->OrderBy('properti_kav.id', 'ASC')
				->get();	    
		return $data;
	}	

	public function cekplu($cprdcd, $cqty , $id_properti, $id_kav, $tipe_unit)
	{
		$status = 0;
		$db = DB::connection('mysql');
		$data = $db->select("SELECT A.prdcd,a.qty_max,(ifnull(B.QTY_USE,0) +  $cqty)  as qty_use, (C.qty - $cqty) as ci FROM (
			SELECT id_properti,tipe_unit,prdcd,qty as qty_max
			FROM mrab_material
			where id_properti = $id_properti and tipe_unit='$tipe_unit' and prdcd= '$cprdcd'
			) A
			LEFT JOIN
			(
			  SELECT prdcd,sum(qty) as qty_use FROM mstran where id_properti= $id_properti and id_kav = $id_kav and prdcd= '$cprdcd' AND rtype='J'
			) B ON A.PRDCD = B.PRDCD
			LEFT JOIN (select prdcd, qty from stmast where prdcd = '$cprdcd') C ON A.prdcd = C.prdcd;");
		
		foreach($data as $r){
			if($r->qty_use > $r->qty_max){
				$status = 0;
			}elseif($r->ci < 0){
				$status = 1;
			}elseif($r->qty_max == ""){
				$status = 2;
			}else{
				$status = 3;
			}
		} 
		
		return $status;
	}
	
	
	
	public function insert_mstran($prdcd , $qty, $id_properti, $id_kav, $tipe, $docno, $tanggal, $keterangan){
		
		$user = Auth::user()->name;
		$ac = Stmast::findOrFail($prdcd);
		$price = $ac->acost;
		$gross = $qty * $ac->acost;
		$db = DB::connection('mysql');		
		$db->statement("INSERT INTO  mstran set  rtype='J', 
				created_by='$user', tanggal='$tanggal', docno='$docno' , prdcd='$prdcd', 
				qty = '$qty', price='$price',gross = '$gross',
				id_properti='$id_properti', id_kav='$id_kav', 
				keterangan='$keterangan', created_at = now(), updated_at = now()");
		$db->statement("UPDATE stmast set  QTY = QTY - $qty where prdcd='$prdcd'");
		return true;
		
	}
	
	public function listproyek()
	{
		$db = DB::connection('mysql');
		 $data = $db->table('spk_proyek')
        ->select(db::raw("spk_proyek.*, mrab_proyek.judul,properti.nama as nama_properti"))            
        ->leftjoin("mrab_proyek","spk_proyek.id_mrabp","=","mrab_proyek.id")          
        ->leftjoin("properti","spk_proyek.id_properti","=","properti.id")
		->where("spk_proyek.kategori","=","Proyek")
		->where("spk_proyek.status","=","4")
        ->OrderBy('spk_proyek.id', 'DESC')->get();	
		
		return $data;		
	}
	
	
	public function listproyekrev()
	{
		$db = DB::connection('mysql');
		 $data = $db->table('spk_proyek')
        ->select(db::raw("spk_proyek.*, mrab_proyek.judul,properti.nama as nama_properti,
		properti_kav.nama as nama_kav,
		properti_kav.tipe as tipe_unit"))            
        ->leftjoin("mrab_proyek","spk_proyek.id_mrabp","=","mrab_proyek.id")          
        ->leftjoin("properti","spk_proyek.id_properti","=","properti.id")
        ->leftjoin("properti_kav","spk_proyek.id_kav","=","properti_kav.id")
		->where("spk_proyek.kategori","=","Revisi")
		->where("spk_proyek.status","=","4")
        ->OrderBy('spk_proyek.id', 'DESC')->get();	
		
		return $data;		
	}

	public function cekplufasum($cprdcd, $cqty , $id_mrabp, $id_spk)
	{
		$status = 0;
		$db = DB::connection('mysql');
		$data = $db->select("SELECT A.prdcd,a.qty_max,(ifnull(B.QTY_USE,0) +  $cqty)  as qty_use, (C.qty - $cqty) as ci FROM (
			SELECT id_mrabp,prdcd,qty as qty_max
			FROM mrab_material_proyek
			where id_mrabp = $id_mrabp  and prdcd= '$cprdcd'
			) A
			LEFT JOIN
			(
			  SELECT prdcd,sum(qty) as qty_use FROM mstran where id_spk= $id_spk AND prdcd= '$cprdcd' AND rtype='J'
			) B ON A.PRDCD = B.PRDCD
			LEFT JOIN (select prdcd, qty from stmast where prdcd = '$cprdcd') C ON A.prdcd = C.prdcd;");
		
		foreach($data as $r){
			if($r->qty_use > $r->qty_max){
				$status = 0;
			}elseif($r->ci < 0){
				$status = 1;
			}elseif($r->qty_max == ""){
				$status = 2;
			}else{
				$status = 3;
			}
		} 
		
		return $status;
	}
	
	public function insert_mstran_fasum( $prdcd , $qty, $id_properti, $id_spk, $docno, $tanggal, $keterangan)
	{
		
		$user = Auth::user()->name;
		
		$ac = Stmast::findOrFail($prdcd);
		$price = $ac->acost;
		$gross = $qty * $ac->acost;
		
		$db = DB::connection('mysql');
		
		$db->statement("INSERT INTO  mstran set  rtype='J', created_by='$user', tanggal='$tanggal', docno='$docno' , 
		prdcd='$prdcd', qty='$qty', price='$price',gross = '$gross',
		id_properti='$id_properti', id_spk='$id_spk', keterangan='$keterangan', created_at = now(), updated_at = now()");
		$db->statement("UPDATE stmast set  QTY = QTY - $qty where prdcd='$prdcd'");
		return true;
		
	}

	public function cekplurevisi($cprdcd, $cqty , $id_mrabp, $id_spk)
	{
		$status = 0;
		$db = DB::connection('mysql');
		$data = $db->select("SELECT A.prdcd,a.qty_max,(ifnull(B.QTY_USE,0) +  $cqty)  as qty_use, (C.qty - $cqty) as ci FROM (
			SELECT id_mrabp,prdcd,qty as qty_max
			FROM mrab_material_proyek
			where id_mrabp = $id_mrabp  and prdcd= '$cprdcd'
			) A
			LEFT JOIN
			(
			  SELECT prdcd,sum(qty) as qty_use FROM mstran where id_spk= $id_spk AND prdcd= '$cprdcd' AND rtype='J'
			) B ON A.PRDCD = B.PRDCD
			LEFT JOIN (select prdcd, qty from stmast where prdcd = '$cprdcd') C ON A.prdcd = C.prdcd;");
		
		foreach($data as $r){
			if($r->qty_use > $r->qty_max){
				$status = 0;
			}elseif($r->ci < 0){
				$status = 1;
			}elseif($r->qty_max == ""){
				$status = 2;
			}else{
				$status = 3;
			}
		} 
		
		return $status;
	}
	
	public function insert_mstran_revisi( $prdcd , $qty, $id_properti, $id_kav, $id_spk, $docno, $tanggal, $keterangan)
	{
		
		$user = Auth::user()->name;
		
		$ac = Stmast::findOrFail($prdcd);
		$price = $ac->acost;
		$gross = $qty * $price;
		
		$db = DB::connection('mysql');
		
		$db->statement("INSERT INTO  mstran set  rtype='J', created_by='$user', tanggal='$tanggal', docno='$docno' , prdcd='$prdcd', 
		qty = '$qty', price = '$price', gross = '$gross',
		id_kav = '$id_kav', id_properti='$id_properti', id_spk='$id_spk', keterangan='$keterangan', created_at = now(), updated_at = now()");
		$db->statement("UPDATE stmast set  QTY = QTY - $qty where prdcd='$prdcd'");
		return true;
		
	}
	
 
}
