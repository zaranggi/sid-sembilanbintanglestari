<?php
namespace App\Modules\Materialmasuk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Modules\Materialmasuk\Models\Stmast;
use App\Modules\Materialmasuk\Models\Prodmast;
/**
 * @property array|null|string name
 */
class Materialmasuk extends Model {
	
    protected $table = 'prodmast';
    public $timestamps = true;
	
	public function dataall(){
		$db = DB::connection('mysql');
		
		$data = $db->select("SELECT docno,dari, nama_rekanan, alamat, kontak, tanggal, 
			`status`,
			if(cash>0,'Cash','Tempo') as cara_bayar, if(cash>0,cash,tempo) as total_bayar
			from
			(
			select a.docno,a.prdcd,a.dari,b.nama as nama_rekanan, b.alamat,b.kontak,a.tanggal,a.status,sum(if(a.pembayaran = 'Cash',gross,0)) as cash,
			sum(if(a.pembayaran = 'Tempo',gross,0)) as tempo
			from
			(select * from po where status in(4)) a
			left join rekanan b on a.dari =b.id
			left join prodmast c on a.prdcd =c.prdcd
			group by a.dari,a.pembayaran,docno
			) x;
			");
		return $data;
	}
			
	public function namaproperti($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti')
				->select(db::raw("properti.nama as nama_properti ")) 
				->where("id","=",$id)
				->get();	    
		return $data;
	}	
	
	public function detail($docno,$pembayaran)
	{
		$db = DB::connection('mysql');
		
			$listuser = $db->select("select a.id_properti,c.satuan,a.pembayaran, c.nama as desc2, a.docno,a.prdcd,a.dari,b.nama as nama_rekanan, b.alamat,b.kontak,a.tanggal,a.status,a.qty,
				a.gross as total,
				a.price as harga, a.tanggal
				from
				(select * from po where docno = $docno and pembayaran='$pembayaran') a
				left join rekanan b on a.dari =b.id
				left join prodmast c on a.prdcd =c.prdcd;
			"); 
			return $listuser;
    }	
	
	public function rekap($docno,$pembayaran)
	{
		$db = DB::connection('mysql');
		
			$listuser = $db->select("select c.satuan,a.pembayaran, c.nama as desc2, a.docno,a.prdcd,a.dari,b.nama as nama_rekanan, b.alamat,b.kontak,a.tanggal,a.status,a.qty,
				a.gross as total,
				a.price as harga
				from
				(select * from po where docno = $docno and pembayaran='$pembayaran') a
				left join rekanan b on a.dari =b.id
				left join prodmast c on a.prdcd =c.prdcd
				group by a.docno
			"); 
			return $listuser;
    }	
	
	
	public function cekplu($cprdcd, $cqty , $id_properti, $id_kav, $tipe_unit)
	{
		$status = 0;
		$db = DB::connection('mysql');
		$data = $db->select("SELECT A.prdcd,a.qty_max,(ifnull(B.QTY_USE,0) +  $cqty)  as qty_use FROM (
			SELECT id_properti,tipe_unit,prdcd,qty as qty_max
			FROM mrab_material
			where id_properti = $id_properti and tipe_unit='$tipe_unit' and prdcd= '$cprdcd'
			) A
			LEFT JOIN
			(
			  SELECT prdcd,sum(qty) as qty_use FROM mstran where id_properti= $id_properti and id_kav = $id_kav and prdcd= '$cprdcd'
			) B ON A.PRDCD = B.PRDCD;");
		
		foreach($data as $r){
			if($r->qty_use > $r->qty_max){
				$status = 0;
			}elseif($r->qty_max == ""){
				$status = 0;
			}else{
				$status = 1;
			}
		} 
		
		return $status;
	}
	
	public function insert_mstran($id_properti,$price, $prdcd , $qty, $gross, $docno, $nama_rekanan,$dari, $tanggal, $tanggal_po, $keterangan,$po_price, $po_qty, $cb){
		
		$user = Auth::user()->name;
		
		$ac = Stmast::findOrFail($prdcd);
		
		if($ac->acost == 0){
			$acost = $price;
		}else{
			$acost = ($price + $ac->acost) / 2;	
		}
		
		
		$ac->lcost = $acost;
		$ac->acost = $acost;
		$ac->qty = $ac->qty + $qty;
		$ac->save();
		
		$db = DB::connection('mysql');
		
		$db->statement("INSERT INTO  mstran set  
		rtype='B', tanggal='$tanggal', docno='$docno' , 
		prdcd='$prdcd', qty='$qty', price='$price', gross = '$gross',
		id_properti='$id_properti',
		dari='$nama_rekanan', keterangan='$keterangan', created_by='$user',
		created_at = now(), updated_at = now()");
		
		$db->statement("UPDATE stmast set  QTY = QTY + $qty where prdcd='$prdcd'");
		
		$db->statement("INSERT INTO  po_real set  
		docno='$docno',id_properti='$id_properti', tanggal='$tanggal_po', tanggal_real='$tanggal',
		prdcd ='$prdcd', qty ='$po_qty', price ='$po_price', gross = $po_qty * $po_price, 
		qty_real ='$qty', price_real ='$price', gross_real = $qty * $price, 
		pembayaran ='$cb', 
		dari ='$dari', 
		keterangan  ='$keterangan', created_by='$user',
		created_at = now(), updated_at = now()");
		 
		return true;
		
	}


}
