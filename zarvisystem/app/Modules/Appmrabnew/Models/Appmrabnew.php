<?php
namespace App\Modules\Appmrabnew\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Appmrabnew extends Model {
    protected $table = 'mrab_new';
    public $timestamps = true;

    public function dataall()
	{
		$db = DB::connection('mysql');
        $data = $db->select("SELECT
        a.id,b.nama as nama_properti,a.judul, a.hari,
        a.id_properti,
        a.`status`,gross, a.created_by
        FROM mrab_new a
        LEFT JOIN properti b on a.id_properti=b.id
        where a.status in(1,2,3)
        Order by a.id ");

        return $data;

    }

    public function approve($id){

		$db = DB::connection('mysql');
        $data = $db->table('mrab_new')
                    ->where('id', $id)
                    ->update([
                        'status' => "2",
                        'approved_by' => Auth::user()->name,
                        'approved_date' => date("Y-m-d"),
                                 ]);

        return $data;

    }

    public function reject($id){

		$db = DB::connection('mysql');
        $data = $db->table('mrab_new')
                    ->where('id', $id)
                    ->update([
                        'status' => "3",
                        'approved_by' => Auth::user()->name,
                        'approved_date' => date("Y-m-d"),
                                 ]);


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

}
