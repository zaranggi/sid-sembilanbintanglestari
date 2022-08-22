<?php namespace App\Modules;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model {

	protected $table = 'menu';

	public static function cekmenu($user,$link)
	{
		$mainmenu = MenuModel::SELECT("id_main")
			->where('active','=',  'Y')
            ->where('auth_access', 'like', '%#'.$user.'#%') 
            ->where('link', '=', $link)
			->orderBy('urut', 'ASC')
			->get();
		return $mainmenu;
	}

	public static function mainmenu($user)
	{
		$mainmenu = MenuModel::where('active','=',  'Y')
				 ->where('auth_access', 'like', '%#'.$user.'#%') 
				->where('id_main','=',  0)
               ->orderBy('urut', 'ASC')
               ->get();
		return $mainmenu;
	}


	public static function submenu($user)
	{
		$submenu = MenuModel::where('active','=',  'Y')
			->where('auth_access', 'like', '%#'.$user.'#%') 
			->where('id_main', '<>', 0)
			->orderBy('urut', 'ASC')
			->get();
		return $submenu;

	}




}

