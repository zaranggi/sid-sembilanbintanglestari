<?php
namespace App\Modules\Gaji;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Gaji extends Model {
    protected $table = 'gaji';
    public $timestamps = true; 

    public function insertwa($data)
	{
        
        DB::table('wa')
        ->insert(
                    [
                        'pesan' => $data,
                        'status_wa'=> 0,
                    ]
                );
         
		return "Sukses";
	}	
}
