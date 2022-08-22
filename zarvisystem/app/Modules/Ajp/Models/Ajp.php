<?php
namespace App\Modules\Ajp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Ajp extends Model {
    protected $table = 'jurnal';
    public $timestamps = true;

    public function dataall(){
      $db = DB::connection('mysql'); 
      $data = $db->table('properti')
          ->select(db::raw("properti.*, gambar,count(distinct properti_kav.id) as tunit"))
          ->leftJoin('properti_img', 'properti.id','=','properti_img.id_properti')
          ->leftJoin('properti_kav', 'properti.id','=','properti_kav.id_properti')
                  ->leftJoin('properti_marketing', 'properti.id','=','properti_marketing.id_properti') 
          ->groupBy('properti.id')
          ->OrderBy('properti.id', 'ASC')
          ->get();
          return $data;
    }
  
}
