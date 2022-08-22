<?php
namespace App\Modules\Apppaymaterial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Apppaymaterial extends Model {
    protected $table = 'po_bayar';
    public $timestamps = true; 
 
    public function dataall()
	{
		$db = DB::connection('mysql');
		if(Auth::user()->id_jabatan == 5 OR Auth::user()->id_jabatan == 1 ){
			$listuser = $db->select("SELECT docno,dari, nama_rekanan, alamat, kontak, tanggal, tanggal_real,
			`status`,
			if(cash>0,'Cash','Tempo') as cara_bayar, if(cash>0,cash,tempo) as total_bayar
			from
			(
			select a.docno,a.prdcd,a.dari,b.nama as nama_rekanan, b.alamat,b.kontak,a.tanggal,a.tanggal_real,a.status,sum(if(a.pembayaran = 'Cash',gross_real,0)) as cash,
			sum(if(a.pembayaran = 'Tempo',gross_real,0)) as tempo
			from
			(select * from po_real where status <> 0) a
			left join rekanan b on a.dari =b.id
			left join prodmast c on a.prdcd =c.prdcd
			group by a.dari,a.pembayaran,docno
			) x;
			");
		}elseif(Auth::user()->id_jabatan == 4 OR Auth::user()->id_jabatan == 3 ){
			$listuser = $db->select("SELECT docno,dari, nama_rekanan, alamat, kontak, tanggal, 
			`status`,
			if(cash>0,'Cash','Tempo') as cara_bayar, if(cash>0,cash,tempo) as total_bayar
			from
			(
			select a.docno,a.prdcd,a.dari,b.nama as nama_rekanan, b.alamat,b.kontak,a.tanggal,a.status,sum(if(a.pembayaran = 'Cash',gross_real,0)) as cash,
			sum(if(a.pembayaran = 'Tempo',gross_real,0)) as tempo
			from
			(select * from po_real where status in(2,4,5)) a
			left join rekanan b on a.dari =b.id
			left join prodmast c on a.prdcd =c.prdcd
			group by a.dari,a.pembayaran,docno
			) x;
			");
		}	    
        return $listuser;
    }
	
	public function detail($docno,$pembayaran)
	{
		$db = DB::connection('mysql');
		
			$listuser = $db->select("select c.satuan,a.pembayaran, c.nama as desc2, a.docno,a.prdcd,a.dari,b.nama as nama_rekanan, b.alamat,b.kontak,
				a.tanggal,a.tanggal_real,
				a.status,
				a.qty,
				a.price as harga,
				a.gross as total,
				a.qty_real,
				a.price_real,
				a.gross_real
				from
				(select * from po_real where docno = $docno and pembayaran='$pembayaran') a
				left join rekanan b on a.dari =b.id
				left join prodmast c on a.prdcd =c.prdcd;
			"); 
			return $listuser;
    }	

    

}
