<?php

namespace App\Modules\Menu;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Menu extends Model {

	protected $table = 'menu';
	 public $timestamps = false;

	public function menuku()
	{
		$menuku = Menu::where('id_main', '=',0)->orderBy("name_menu","ASC")
               ->get();
		return $menuku;
	}

	public function listuser()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('users')->OrderBy('name', 'ASC')->get();
	    return $listuser;
    }

	public function listjabatan()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('jabatan')->OrderBy('name_jabatan', 'ASC')->get();
		return $listuser;
	}
	public function listdepartment()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('department')->OrderBy('name_department', 'ASC')->get();
		return $listuser;
	}

}

