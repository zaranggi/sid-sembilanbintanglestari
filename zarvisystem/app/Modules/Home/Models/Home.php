<?php
namespace App\Modules\Home\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Home extends Model {
    protected $table = 'konsumen_spr';
    public $timestamps = true;


    public function listuser()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('users')->OrderBy('name', 'ASC')->get();	    return $listuser;
	}
	public function perumahan()
	{
		$db = DB::connection('mysql');
		$listuser = $db->select('SELECT id,nama FROM properti');

		return $listuser;
	}
	public function jual($id,$tanggal)
	{
		$y =  substr($tanggal,0,4);
		$m =  substr($tanggal,5,2);

		for($i=1; $i <= $m; $i++){
			$sc[] = "sum(if(bulan = $i ,total_unit,0)) as jual_$i";
			$con[] = "jual_$i";
		}

		$script = implode(",",$sc);
		$concat = implode(",',',",$con);

		$db = DB::connection('mysql');
		$listuser = $db->select("SELECT
					group_concat($concat) as jual
					FROM
					(SELECT
						$script
						FROM (
							SELECT month(tgl_transaksi) as bulan,count(*) as total_unit FROM konsumen_spr
							WHERE id_properti= $id and year(tgl_transaksi) = '$y' and status_spr = 1
							GROUP BY bulan
							ORDER BY bulan
						) xx
					) AA");

		return $listuser;
	}

	public function kprall($tanggal)
	{
		$y =  substr($tanggal,0,4);
		$db = DB::connection('mysql');
		$listuser = $db->select("select sum(sp3k_nominal) as gross_total,count(*) as qty
		from konsumen_spr
		where cara_bayar_unit='kpr'
		and year(tgl_transaksi) ='$y'
		and status_spr = 1;");

		return $listuser;
	}

	public function kpr($tanggal)
	{
		$y =  substr($tanggal,0,4);
		$db = DB::connection('mysql');
		$listuser = $db->select("select log_kpr,
			sum(if(`log_kpr` = 'ACC',1,0)) as acc,
			sum(if(`log_kpr` = 'Proses',1,0)) as proses,
			sum(if(`log_kpr` = 'Tolak',1,0)) as tolak,
			sum(if(`log_kpr` = 'Realisasi KPR',1,0)) as realisasi,
			sum(if(`log_kpr` = 'Belum Pengajuan',1,0)) as belum
			from konsumen_spr
			where cara_bayar_unit = 'kpr' and status_spr = 1 and year(tgl_transaksi) ='$y' ;
		");

		return $listuser;
	}


	public function line1($id,$tanggal)
	{
		$y =  substr($tanggal,0,4);
		$m =  substr($tanggal,5,2);

		for($i=1; $i <= $m; $i++){

			if(strlen($i) == 1){
				$a = "0".$i;
			}else{
				$a = $i;
			}

			$sc[] = "SELECT
			bulan, ifnull(masuk,0) as masuk, ifnull(proses,0) as proses, ifnull(acc,0) as acc, ifnull(tolak,0) as tolak
			from
			(
			SELECT '$i' as bulan,
			sum(if(left(a.tgl_transaksi,7)='$y-$a',1,0)) as masuk,
			sum(if(left(b.tanggal,7)='$y-$a',1,0)) as proses,
			sum(if(left(a.tanggal_sp3k,7)='$y-$a',1,0)) as acc,
			sum(if(b.`status` = 'Tolak' and left(b.updated_at,7)='$y-$a',1,0)) as tolak
			FROM konsumen_spr a
			left join konsumen_kpr b on a.id = b.id_spr
			WHERE a.id_properti= $id and year(a.tgl_transaksi) = '$y'
			and a.status_spr = 1
			and month(a.tgl_transaksi) = $i and a.cara_bayar_unit='kpr'
			) a";
		}
		$implode = implode(" union all ", $sc);

		$db = DB::connection('mysql');

			$listuser = $db->select("$implode");

		return $listuser;
	}


	public function donat($id)
	{
		$y =  date("Y");

		$sc = "SELECT nama,SUM(total) AS total FROM (
            SELECT a.id, IF(a.nama = 'Available','Tersedia',(IF(a.nama = 'Not Available','Tidak Tersedia','Terjual'))) AS nama,
            IFNULL(b.total,0) AS total FROM jenis_status_kav a
            LEFT JOIN (
            SELECT `status`, COUNT(*) AS total FROM properti_kav WHERE id_properti = $id GROUP BY `status`
            ) b ON a.id = b.`status`
            ) a GROUP BY nama";

		$db = DB::connection('mysql');

		$listuser = $db->select("$sc");

		return $listuser;
	}


	public function hitung()
	{
		$db = DB::connection('mysql');
		$listuser = $db->select('select a.nama,
						count(*) as total_unit,
						sum(if(b.`status` in(3,4), 1,0)) as terjual
						from properti a
						left join properti_kav b on a.id=b.id_properti
						group by a.id;');

		return $listuser;
	}



	public function villages($id)
	{
	        $db = DB::connection('mysql');
	        $list= $db->table('villages')
                    ->select("name","id")
                    ->where('district_id','=', DB::raw("(SELECT id FROM `districts`WHERE `name` = '".$id."')"))
			        ->orderBy("name","asc")
			        ->get();
	        return $list;
	}
}
