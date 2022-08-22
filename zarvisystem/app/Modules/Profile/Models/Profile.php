<?php
namespace App\Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Profile extends Model {
    protected $table = 'users';
    public $timestamps = true;

    public function karyawan($nik)
    {
        $db = DB::connection('mysql');
        $listuser = $db->table('users')
            ->select(DB::raw("users.*,name_jabatan,name_department"))
            ->leftjoin("jabatan","users.id_jabatan","=","jabatan.id_jabatan")
            ->leftjoin("department","users.id_dep","=","department.id")
            ->where("users.nik","=",$nik)
            ->OrderBy('name', 'ASC')->get();
        return $listuser;
    }
    public function uhuy($id_dep)
    {
        if(Auth::user()->id_jabatan == 35 OR Auth::user()->id_jabatan == 43 ){
            $jab = "34";
        }
        elseif(Auth::user()->id_jabatan == 34){
            $jab = "33";
        }else{
            $jab = "35,43";
        }
        $db = DB::connection('mysql');
        $listuser = $db->table('users')
            ->select(DB::raw("users.*,name_jabatan,name_department"))
            ->leftjoin("jabatan","users.id_jabatan","=","jabatan.id_jabatan")
            ->leftjoin("department","users.id_dep","=","department.id")
            //->where("users.id_dep","=",$id_dep)
            ->wherein("users.id_jabatan",[$jab])
            ->OrderBy('name', 'ASC')->get();
        return $listuser;
    }
    public function updateatasan($id_atasan)
    {
        $db = DB::connection('mysql');
        $db->table('users')
            ->where('NIK', Auth::user()->nik)
            ->update([
                'id_atasan' => $id_atasan ,
            ]) ;
    }
    public function updateatasan2($id_atasan, $password)
    {
        $db = DB::connection('mysql');
        $db->table('users')
            ->where('NIK', Auth::user()->nik)
            ->update([
                'id_atasan' => $id_atasan ,
                'password' => $password ,
            ]) ;
    }

    public function updatefoto($filename)
    {
        $db = DB::connection('mysql');
        $db->table('users')
            ->where('NIK', Auth::user()->nik)
            ->update([
                'photo' => $filename
            ]) ;
    }

    public function updatequotes($a)
    {
        $db = DB::connection('mysql');
        $update = $db->table('users')
            ->where('NIK', Auth::user()->nik)
            ->update([
                'note' => $a,
                'updated_at' => now()
            ]) ;
        return $update;
    }

}
