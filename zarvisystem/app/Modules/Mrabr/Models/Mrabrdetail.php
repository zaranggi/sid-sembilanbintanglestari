<?php
namespace App\Modules\Mrabr\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Mrabrdetail extends Model {
    protected $table = 'mrab_detail';
    public $timestamps = true;


    public function listuser($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('mrab_detail')
					->where("id_mrab","=",$id)
					->OrderBy('id', 'ASC')->get();	    
		return $listuser;
    }	 
}
