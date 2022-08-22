<?php
namespace App\Modules\Fukonsumen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Fukonsumen extends Model {
    protected $table = 'marketing_aktifitas';
    public $timestamps = true;


    public function listprogres()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('jenis_progres_konsumen')->OrderBy('id', 'ASC')->get();	    
		return $listuser;
    }	 
    
    public function list() 
	{

		$id_users = Auth::user()->id;

		$db = DB::connection('mysql');

		$listuser = $db->select("SELECT A.id,A.nama FROM properti A 
			right JOIN properti_marketing B ON A.id = B.id_properti
			WHERE B.id_users='$id_users' GROUP BY A.id");	    

		return $listuser;

    }
	public function updatekonsumen($kode,$nama,$alamat,$tlp,$idcard) 
	{
		
		$db = DB::connection('mysql');
		$db->table('konsumen')
		->where('kode',$kode)
		->update(
			[
				'nama' => $nama,
				'alamat' => $alamat,
				'telp' => $tlp,
				'idcard' => $idcard
			]
		);
		return "sukses";
	}		
}
