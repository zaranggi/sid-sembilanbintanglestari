<?php

namespace App\Modules\Legalformal\Models; 
use Illuminate\Database\Eloquent\Model;
 
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Auth;

class Legalformal extends Model
{
    protected $table = 'legalformal';
    public $timestamps = true;

    public function dataproperti()
	{
        $db = DB::connection('mysql');
        //if(Auth::user()->id_jabatan == 9){
		 
            $data = $db->table('properti') 
            ->get();
             
		return $data;
	}	
    public function datalegalitas($id)
	{
        $db = DB::connection('mysql');
        //if(Auth::user()->id_jabatan == 9){
		 
            $data = $db->table('legalformal')
            ->select(db::raw("properti.nama as nama_properti,properti_kav.nama as nama_kav, 
            m_jenis_legalformal.jenis_legalformal,
             legalformal.*"))
            ->leftJoin('properti', 'legalformal.id_properti','=','properti.id')
            ->leftJoin('properti_kav', 'legalformal.id_kav','=','properti_kav.id')
            ->leftJoin('m_jenis_legalformal', 'legalformal.id_jenis','=','m_jenis_legalformal.id')
            ->where("legalformal.id_properti","=",$id)
            ->get();
             
		return $data;
	}	
    public function jenis_legalformal()
	{
        $db = DB::connection('mysql');
        //if(Auth::user()->id_jabatan == 9){
		 
            $data = $db->table('m_jenis_legalformal') 
            ->get();
             
		return $data;
	}	
    public function properti_kav($id)
	{
        $db = DB::connection('mysql');
        //if(Auth::user()->id_jabatan == 9){
		 
            $data = $db->table('properti_kav') 
            ->where("id_properti","=",$id)
            ->get();
             
		return $data;
	}
}
