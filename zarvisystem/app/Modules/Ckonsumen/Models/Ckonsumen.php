<?php
namespace App\Modules\Ckonsumen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Ckonsumen extends Model {
    protected $table = 'konsumen';
    public $timestamps = true;

    public function dataall()
	{
		$id_users = Auth::user()->id;
		$db = DB::connection('mysql');

			$data = $db->table('properti')
			->select(db::raw("properti.*, gambar,count(distinct properti_kav.id) as tunit"))
				->leftJoin('properti_img', 'properti.id','=','properti_img.id_properti')
				->leftJoin('properti_kav', 'properti.id','=','properti_kav.id_properti')
				->groupBy('properti.id')
				->OrderBy('properti.id', 'ASC')
				->get();

		return $data;
	}

    public function listkonsumen($id)
	{
		$id_users = Auth::user()->id;
		$db = DB::connection('mysql');
		if(Auth::user()->id_jabatan == 9){
            $listuser = $db->table('konsumen')
            ->where('iskonsumen','=','0')
            ->where('id_marketing','=',Auth::user()->id)
            ->where('id_properti','=',$id)
            ->OrderBy('nama', 'ASC')->get();
        }else{
            $listuser = $db->table('konsumen')
			->select(db::raw("konsumen.*, users.name as nama_marketing"))
					->leftjoin('users', 'konsumen.id_marketing','=','users.id')
                    ->where('iskonsumen','=','0')
                    ->where('id_properti','=',$id)
                    ->OrderBy('nama', 'ASC')->get();
        }


        return $listuser;
    }

}
