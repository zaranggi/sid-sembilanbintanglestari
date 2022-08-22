<?php
namespace App\Modules\Bastsubkon\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Bastsubkon extends Model {
    protected $table = 'bast_subkon';
    public $timestamps = true;


    public function listbank(){

		$db = DB::connection('mysql');
		$data = $db->table('bank')->OrderBy('nama', 'ASC')->get();
        return $data;

	}
    public function listall($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("SELECT d.id as id_bast,
        d.created_at,
        a.id as id_spk,
        a.tanggal_bast,
        d.file,d.file3,d.file2,
        a.kode,
        b.nama as nama_subkon, c.nama AS nama_kav,c.tipe as tipe_kav FROM SPK a
        LEFT JOIN subkon b ON a.id_subkon = b.id
        LEFT JOIN properti_kav c ON a.id_kav = c.id
        LEFT JOIN bast_subkon d ON a.id = d.id_spk
        WHERE
        a.status= 4
        AND a.id_properti = '$id';");
		return $listuser;
	}

	public function dataall()
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti')
				->select(db::raw("properti.*, count(distinct bast_subkon.id) as tunit"))
				->leftJoin('bast_subkon', 'properti.id','=','bast_subkon.id_properti')
				->groupBy('properti.id')
				->OrderBy('properti.id', 'ASC')
				->get();
		return $data;
	}




}
