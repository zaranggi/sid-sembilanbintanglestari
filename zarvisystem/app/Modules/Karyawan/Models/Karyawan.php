<?php
namespace App\Modules\Karyawan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Karyawan extends Model {
    protected $table = 'users';
    public $timestamps = true;


    public function listuser()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('users')->OrderBy('name', 'ASC')->get();	    return $listuser;
	}	
	public function listjabatan()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('jabatan')->where("id_jabatan","<>",1)->OrderBy('name_jabatan', 'ASC')->get();
		return $listuser;
	}

	public function listdepartment()
	{		$db = DB::connection('mysql');
			$listuser = $db->table('department')->OrderBy('name_department', 'ASC')->get();
			return $listuser;
	}

	public function cabang()
	{
		$db = DB::connection('mysql');
		$list= $db->table('cabang')->OrderBy('kode', 'ASC')->get();
		return $list;	
	}
		public function provinces()
        {		$db = DB::connection('mysql');
                $list= $db->table('provinces')->OrderBy('name', 'ASC')->get();
                return $list;
        }

    public function regencies($id)
	{
	    $list= DB::table("regencies")
            ->select("name","id")
            ->where('province_id','=',
                DB::raw("(SELECT id FROM provinces WHERE name = '".$id."')"))->orderBy("name","asc")
			->get();
	        return $list;
	}

	public function districts($id)	{
        $db = DB::connection('mysql');
        $list= $db->table('districts')
            ->select("name","id")
            ->where('regency_id','=',
                DB::raw("(SELECT id FROM `regencies` WHERE `name` = '".$id."')"))->orderBy("name","asc")
			->get();
        return $list;
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
