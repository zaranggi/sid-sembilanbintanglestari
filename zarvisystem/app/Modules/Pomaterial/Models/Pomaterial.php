<?php
namespace App\Modules\Pomaterial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Pomaterial extends Model {
    protected $table = 'po';
    public $timestamps = true;

	public function dataall()
	{
		$db = DB::connection('mysql');
		$data = $db->table('po')
				->select(db::raw("docno, properti.nama as nama_properti, tanggal, count(prdcd) as total, 
								sum(qty) as qty, rekanan.nama as dari, 
								keterangan, po.status, app_mgr, app_dir"))
				->leftJoin("rekanan","po.dari","=","rekanan.id")
				->leftJoin("properti","po.id_properti","=","properti.id")
				->groupBy("docno")
				->orderby("prdcd","ASC")
				->get();	    
		return $data;
	}
	
	public function dataone($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('po')
				->select(db::raw("docno, tanggal, count(prdcd) as total, 
								sum(qty) as qty, rekanan.nama as nama_rekanan, 
								keterangan, po.status, app_mgr, app_dir"))
				->leftJoin("rekanan","po.dari","=","rekanan.id")
				->Where("docno","=",$id)
				->get();	    
		return $data;
	}
	
	public function prodmast()
	{
		$db = DB::connection('mysql');
		$data = $db->table('prodmast')
				->orderby("prdcd","ASC")
				->get();	    
		return $data;
	}
	
	public function listprodmast($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('prodmast')
				->where("id_vendor","=",$id)
				->where("price",">",0)
				->orderby("prdcd","ASC")
				->get();	    
		return $data;
	}
	
	public function perumahan()
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti')
				->get();	    
		return $data;
	}	
	
	public function insert_po($id_properti, $prdcd , $qty, $price, $pembayaran, $dari, $docno, $tanggal, $keterangan){
		
		$user = Auth::user()->name;
		$gross = $qty * $price;
		$db = DB::connection('mysql');
		
		$db->statement("INSERT INTO  po set created_by='$user', 
						tanggal='$tanggal', 
						id_properti='$id_properti' ,  
						docno='$docno' , 
						prdcd='$prdcd', 
						qty='$qty', 
						price ='$price', 
						gross = '$gross', 
						pembayaran='$pembayaran',
						dari='$dari', 
						keterangan='$keterangan', 
						created_at = now(), 
						updated_at = now()");
		
		return true;
		
	}



	
	 
	 


}
