<?php
namespace App\Modules\Mutasimaterial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Mutasimaterial extends Model {
    protected $table = 'stmast';
    public $timestamps = true;

    public function listitem()
	{
        $db = DB::connection('mysql');
        
		$data = $db->select("SELECT a.prdcd,b.nama FROM stmast a left join prodmast b on a.prdcd = b.prdcd;");
        
		return $data;
	}	
	
    public function mutasi($tanggal1,$tanggal2,$prdcd)
	{
        $db = DB::connection('mysql');
        
		$data = $db->select("
		SELECT
		a.*,b.nama,b.satuan,b.merk,b.price,c.nama as nama_properti,d.nama as nama_kav,d.tipe as tipe_unit
		from mstran a
		left join prodmast b on a.prdcd = b.prdcd
		left join properti c on a.id_properti = c.id
		left join properti_kav d on a.id_kav = d.id
		where tanggal between '$tanggal1' and '$tanggal2'
		and a.prdcd = '$prdcd'
		order by a.created_at , a.prdcd;
		");
        
		return $data;
	}
	
	 public function mutasiall($tanggal1,$tanggal2)
	{
        $db = DB::connection('mysql');
        
		$data = $db->select("
		SELECT
		a.*,b.nama,b.satuan,b.merk,b.price,c.nama as nama_properti,d.nama as nama_kav,d.tipe as tipe_unit
		from mstran a
		left join prodmast b on a.prdcd = b.prdcd
		left join properti c on a.id_properti = c.id
		left join properti_kav d on a.id_kav = d.id
		where tanggal between '$tanggal1' and '$tanggal2'
		order by a.created_at , a.prdcd;
		");
        
		return $data;
	}
	
}
