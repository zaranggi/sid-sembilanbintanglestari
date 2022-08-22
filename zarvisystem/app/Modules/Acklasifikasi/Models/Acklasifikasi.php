<?php
namespace App\Modules\Acklasifikasi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Acklasifikasi extends Model {
    protected $table = 'daftar_akun';
    public $timestamps = true;


    public function dataall(){ 

      $db = DB::connection('mysql');
      $data = $db->select("select a.*,b.nama_akun as nama_komponen from
      (
      SELECT * FROM daftar_akun where id_komponen<>0 and id_klasifikasi = 0
      
      ) a
      left join
      (
      SELECT * FROM daftar_akun where id_komponen=0
      ) b on a.id_komponen = b.id");
          return $data;
          
    }
 

}
