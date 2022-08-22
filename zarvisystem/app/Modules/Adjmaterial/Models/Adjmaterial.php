<?php
namespace App\Modules\Adjmaterial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Adjmaterial extends Model {
    protected $table = 'adj';
    public $timestamps = true;

	public function dataall()
	{
		$db = DB::connection('mysql');
		$data = $db->table('adj')
				->select(db::raw("docno, tanggal, count(prdcd) as total, 
								sum(qty) as qty,
								keterangan, status, app_mgr, app_dir"))
				->groupBy("docno")
				->orderby("docno","DESC")
				->get();	    
		return $data;
	}
	
	public function dataone($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('adj')
				->select(db::raw("docno, tanggal, count(prdcd) as total, 
								sum(qty) as qty, 
								keterangan, adj.status, app_mgr, app_dir")) 
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

	public function insert_adj($prdcd , $qty, $price, $docno, $tanggal, $keterangan){
		
		$user = Auth::user()->name;
		$gross = $qty * $price;
		$db = DB::connection('mysql');
		
		$db->statement("INSERT INTO  adj set created_by='$user', 
						tanggal='$tanggal', 
						docno='$docno' , 
						prdcd='$prdcd', 
						qty='$qty', 
						price ='$price', 
						gross = '$gross', 
						keterangan='$keterangan', 
						created_at = now(), 
						updated_at = now()");

		$db->statement("INSERT INTO  mstran set  
		rtype='X', tanggal='$tanggal', docno='$docno' , 
		prdcd='$prdcd', qty='$qty', price='$price', gross = '$gross',
		keterangan='Ajustment : $keterangan', created_by='$user',
		created_at = now(), updated_at = now()");

		$db->statement("UPDATE stmast set  QTY = QTY + $qty where prdcd='$prdcd'");
	 
		return true;
		
	}



	
	 
	 


}
