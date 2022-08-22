<?php
namespace App\Modules\Sldawal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Sldawal extends Model {
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

    public function listall(){

      $db = DB::connection('mysql');
      $list = $db->table('jurnal_temp')
          ->select(DB::raw("jurnal_temp.id,jurnal_temp.keterangan, jurnal_temp.debit, jurnal_temp.kredit, daftar_akun.kode,daftar_akun.nama_akun"))
          ->leftjoin("daftar_akun","jurnal_temp.id_akun","=","daftar_akun.id") 
          ->get();
      return $list;
  }
  
    public function akun(){ 

        $db = DB::connection('mysql');
        $data = $db->table('daftar_akun')->OrderBy('kode', 'ASC')->get();
        return $data;
        
  }
  
  public function cekbalance(){

    $db = DB::connection('mysql');
    $cek = $db->table('jurnal_temp')
        ->select(DB::raw("sum(debit) as tdebit, sum(kredit) as tkredit, count(*) as total"))
        ->get();
    return $cek;
  }

public function inputjurnal($id_jurnal){

  $db = DB::connection('mysql');
  $data = $db->table('jurnal_temp')
          ->get();

  foreach($data as $r){ 
      $data = DB::table('jurnalid')
      ->insert(
                  [
                      'id_jurnal'     => $id_jurnal,
                      'id_akun'       => $r->id_akun,
                      'keterangan'    => $r->keterangan,
                      'posting'       => "Y",
                      'debit'         => $r->debit,
                      'kredit'        => $r->kredit,
                  ]
              );

  }
  
  DB::table('jurnal_temp')->delete(); 

  return "sukses";
} 



}
