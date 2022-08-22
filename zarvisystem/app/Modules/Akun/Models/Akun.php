<?php
namespace App\Modules\Akun\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Akun extends Model {
    protected $table = 'daftar_akun';
    public $timestamps = true;


    public function komponen(){ 

        $db = DB::connection('mysql');
        $data = $db->table('daftar_akun')->where("id_komponen","=",0)->OrderBy('id', 'ASC')->get();
            return $data;
            
      }
      public function klasifikasi($id){ 
  
        $db = DB::connection('mysql');
        $data = $db->table('daftar_akun')
                    ->where("id_komponen", "=",$id) 
                    ->where("id_klasifikasi","=",0)
                    ->OrderBy('id', 'ASC')->get();
            return $data;
            
      }

      
      public function akun($id,$id_klasifikasi){ 
  
        $db = DB::connection('mysql');
        $data = $db->table('daftar_akun')
                    ->where("id_komponen", "=",$id) 
                    ->where("id_klasifikasi","=",$id_klasifikasi)
                    ->where("id_sub","=",0)
                    ->OrderBy('kode', 'ASC')->get();
        return $data;
            
      }
      
      public function subakun($id){ 
  
        $db = DB::connection('mysql');
        $data = $db->table('daftar_akun')
                    ->where("id_sub", "=",$id) 
                    ->OrderBy('kode', 'ASC')->get();
        return $data;
            
      }


}
