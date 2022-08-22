<?php
namespace App\Modules\Lppmaterial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Lppmaterial extends Model {
    protected $table = 'stmast';
    public $timestamps = true;

    public function listitem()
	{
        $db = DB::connection('mysql');
        
		$data = $db->select("SELECT a.prdcd,b.nama FROM stmast a 
		left join prodmast b on a.prdcd = b.prdcd;");
        
		return $data;
	}	
	
    public function mutasi($tanggal1,$tanggal2,$prdcd)
	{
        $db = DB::connection('mysql');
        
		$data = $db->select("
			SELECT
			a.prdcd,b.nama,b.price,b.satuan,
			sum(if(rtype = 'B',qty,0)) as B,
			sum(if(rtype = 'B',gross,0)) as B_GROSS,
			sum(if(rtype = 'D',qty,0)) as D,
			sum(if(rtype = 'D',gross,0)) as D_GROSS,
			sum(if(rtype = 'J',qty,0)) as J,
			sum(if(rtype = 'J',gross,0)) as J_GROSS,
			sum(if(rtype = 'K',qty,0)) as K,
			sum(if(rtype = 'K',gross,0)) as K_GROSS,
			sum(if(rtype = 'X',qty,0)) as X,
			sum(if(rtype = 'X',gross,0)) as X_GROSS
			from mstran a
			left join prodmast b on a.prdcd = b.prdcd
			where tanggal between '$tanggal1' and '$tanggal2'
			and a.prdcd = '$prdcd'
			order by a.prdcd;
		");
        
		return $data;
	}
	
	 public function mutasiall($tanggal1,$tanggal2)
	{
        $db = DB::connection('mysql');
        
		$data = $db->select("
		SELECT
			a.prdcd,b.nama,b.price,b.satuan,
			sum(if(rtype = 'B',qty,0)) as B,
			sum(if(rtype = 'B',gross,0)) as B_GROSS,
			sum(if(rtype = 'D',qty,0)) as D,
			sum(if(rtype = 'D',gross,0)) as D_GROSS,
			sum(if(rtype = 'J',qty,0)) as J,
			sum(if(rtype = 'J',gross,0)) as J_GROSS,
			sum(if(rtype = 'K',qty,0)) as K,
			sum(if(rtype = 'K',gross,0)) as K_GROSS,
			sum(if(rtype = 'X',qty,0)) as X,
			sum(if(rtype = 'X',gross,0)) as X_GROSS
			from mstran a
			left join prodmast b on a.prdcd = b.prdcd
		where tanggal between '$tanggal1' and '$tanggal2'
		group by a.prdcd
		order by a.prdcd;
		");
        
		return $data;
	}
	
}
