<?php
namespace App\Modules\Pmodal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Pmodal extends Model {
    protected $table = 'daftar_akun';
    public $timestamps = true;


    public function listuser()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('users')->OrderBy('name', 'ASC')->get();	    return $listuser;
    }	
    public function perumahan()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('properti')->OrderBy('nama', 'ASC')->get();	    
		return $listuser;
    }	

     
	public function komponen()
	{	
		$db = DB::connection('mysql');
		
		$listuser = $db->select("SELECT * FROM daftar_akun where id='3' ");
		 return $listuser;
	}
	
    
	public function klasifikasi()
	{	
		$db = DB::connection('mysql');
		
		$listuser = $db->select("SELECT * FROM daftar_akun where kat='NERACA'  and id_komponen='3' and id_klasifikasi=0;");
		 return $listuser;
	}
	public function akun($id_komponen,$id_klasifikasi)
	{	
		$db = DB::connection('mysql');
		
		$listuser = $db->select("SELECT * FROM daftar_akun where kat='NERACA'  and id_komponen='$id_komponen' and id_klasifikasi=$id_klasifikasi;");
		 return $listuser;
	}
		
	public function dtakun_kredit($id_properti,$tanggal1,$tanggal2,$kode)
	{	
		$db = DB::connection('mysql');
		if($id_properti == "all"){
			$listuser = $db->select("
				SELECT a.kode,a.nama_akun,a.posting,sum(debit) as d, sum(kredit) as k, sum(kredit) - sum(debit) as saldo
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='NERACA' and a.kode ='$kode'
				AND	b.tanggal BETWEEN '$tanggal1' AND '$tanggal2'
				group by a.id 
				order by a.id;
			");
		}else{
			$listuser = $db->select("
				SELECT a.kode,a.nama_akun,a.posting,sum(debit) as d, sum(kredit) as k, sum(kredit) - sum(debit) as saldo
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='NERACA' and a.kode ='$kode'
				AND	b.tanggal BETWEEN '$tanggal1' AND '$tanggal2'
				and c.id_properti = '$id_properti'
				group by a.id 
				order by a.id;
			");
		}
		
		 return $listuser;
	}
	
	public function dtakun_debit($id_properti,$tanggal1,$tanggal2,$kode)
	{	
		$db = DB::connection('mysql');
		if($id_properti == "all"){
			$listuser = $db->select("
			SELECT a.kode,a.nama_akun,a.posting,sum(debit) as d, sum(kredit) as k, sum(debit) - sum(kredit) as saldo
			FROM daftar_akun a
			left join jurnalid b on a.kode=b.id_akun
			left join jurnal c on b.id_jurnal=c.id		
			where a.kat='NERACA' and a.kode ='$kode'
			AND	b.tanggal BETWEEN '$tanggal1' AND '$tanggal2'
			group by a.id 
			order by a.id;
			");
		}else{
			$listuser = $db->select("
			SELECT a.kode,a.nama_akun,a.posting,sum(debit) as d, sum(kredit) as k, sum(debit) - sum(kredit) as saldo
			FROM daftar_akun a
			left join jurnalid b on a.kode=b.id_akun
			left join jurnal c on b.id_jurnal=c.id		
			where a.kat='NERACA' and a.kode ='$kode'
			AND	b.tanggal BETWEEN '$tanggal1' AND '$tanggal2'
			and c.id_properti = '$id_properti'
			group by a.id 
			order by a.id;
			");
		}
		 return $listuser;
	}


	public function labakotor_ditahan($id_properti,$periode)
	{
		$th = substr($periode,0,4);
		$bl = substr($periode,5,2);
		$db = DB::connection('mysql');
		if($id_properti == "all"){
			$listuser = $db->select("SELECT a.kode,a.nama_akun,
				a.posting,sum(kredit) - sum(debit) as labakotor
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='LR' 
				and a.id_komponen=4
				AND b.tanggal < '$periode';
				;");
				 
		}else{
			$listuser = $db->select("SELECT a.kode,a.nama_akun,
				a.posting,sum(kredit) - sum(debit) as labakotor
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='LR' 
				and a.id_komponen=4
				AND b.tanggal < '$periode'
				and c.id_properti = '$id_properti'
				;");
				
		}
		return $listuser;
	}
	
	public function beban_ditahan($id_properti,$periode)
	{
		$th = substr($periode,0,4);
		$bl = substr($periode,5,2);
		$db = DB::connection('mysql');
		if($id_properti == "all"){
			$listuser = $db->select("SELECT a.kode,a.nama_akun,
				a.posting,sum(debit) - sum(kredit) as beban
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='LR' and a.id_komponen=5
				AND b.tanggal < '$periode'
				;");
		}else{
			$listuser = $db->select("SELECT a.kode,a.nama_akun,
				a.posting,sum(debit) - sum(kredit) as beban
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='LR' and a.id_komponen=5
				AND b.tanggal < '$periode'
				and c.id_properti = '$id_properti'
				;");
		}
			return $listuser;
	}
	
	public function pajak_ditahan($id_properti,$periode)
	{
		$th = substr($periode,0,4);
		$bl = substr($periode,5,2);
		$db = DB::connection('mysql');
		if($id_properti == "all"){
			$listuser = $db->select("SELECT a.kode,a.nama_akun,
				a.posting,sum(debit) - sum(kredit) as pajak
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='LR' and a.id_komponen=6
				AND b.tanggal < '$periode'
				");
		}else{
			$listuser = $db->select("SELECT a.kode,a.nama_akun,
				a.posting,sum(debit) - sum(kredit) as pajak
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='LR' and a.id_komponen=6
				AND b.tanggal < '$periode'
				and c.id_properti = '$id_properti'
				");
		}
		return $listuser;
	}
	


	/// Laba berjalan
	public function labakotor($id_properti,$tanggal1,$tanggal2)
	{ 
		$db = DB::connection('mysql');
		if($id_properti == "all"){
			$listuser = $db->select("SELECT a.kode,a.nama_akun,
				a.posting,sum(kredit) - sum(debit) as labakotor
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='LR' 
				and a.id_komponen=4
				AND b.tanggal between '$tanggal1' and '$tanggal2'
				;");
				 
		}else{
			$listuser = $db->select("SELECT a.kode,a.nama_akun,
				a.posting,sum(kredit) - sum(debit) as labakotor
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='LR' 
				and a.id_komponen=4
				AND b.tanggal between '$tanggal1' and '$tanggal2'
				and c.id_properti = '$id_properti'
				;");
				
		}
		return $listuser;
	}
	
	public function beban($id_properti,$tanggal1,$tanggal2)
	{ 
		$db = DB::connection('mysql');
		if($id_properti == "all"){
			$listuser = $db->select("SELECT a.kode,a.nama_akun,
				a.posting,sum(debit) - sum(kredit) as beban
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='LR' and a.id_komponen=5
				AND b.tanggal between '$tanggal1' and '$tanggal2'
				;");
		}else{
			$listuser = $db->select("SELECT a.kode,a.nama_akun,
				a.posting,sum(debit) - sum(kredit) as beban
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='LR' and a.id_komponen=5
				AND b.tanggal between '$tanggal1' and '$tanggal2'
				and c.id_properti = '$id_properti'
				;");
		}
			return $listuser;
	}
	
	public function pajak($id_properti,$tanggal1,$tanggal2)
	{ 
		$db = DB::connection('mysql');
		if($id_properti == "all"){
			$listuser = $db->select("SELECT a.kode,a.nama_akun,
				a.posting,sum(debit) - sum(kredit) as pajak
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='LR' and a.id_komponen=6
				AND b.tanggal between '$tanggal1' and '$tanggal2'
				");
		}else{
			$listuser = $db->select("SELECT a.kode,a.nama_akun,
			a.posting,sum(debit) - sum(kredit) as pajak
				FROM daftar_akun a
				left join jurnalid b on a.kode=b.id_akun
				left join jurnal c on b.id_jurnal=c.id
				where a.kat='LR' and a.id_komponen=6
				AND b.tanggal between '$tanggal1' and '$tanggal2'
				and c.id_properti = '$id_properti'
				");
		}
		return $listuser;
	}
	 
		
}
