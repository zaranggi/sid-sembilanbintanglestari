<?php
namespace App\Modules\Konsumen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Konsumen extends Model {
    protected $table = 'konsumen';
    public $timestamps = true;

    public function dataall()
	{
        $db = DB::connection('mysql');
        if(Auth::user()->id_jabatan == 9){
		$data = $db->table('properti')
        ->select(db::raw("properti.*, gambar,count(distinct properti_kav.id) as tunit"))
				->leftJoin('properti_img', 'properti.id','=','properti_img.id_properti')
				->leftJoin('properti_kav', 'properti.id','=','properti_kav.id_properti')
                ->leftJoin('properti_marketing', 'properti.id','=','properti_marketing.id_properti')
                ->where('properti_marketing.id_users','=',Auth::user()->id)
				->groupBy('properti.id')
				->OrderBy('properti.id', 'ASC')
                ->get();
        }else{
            $data = $db->table('properti')
            ->select(db::raw("properti.*, gambar,count(distinct properti_kav.id) as tunit"))
            ->leftJoin('properti_img', 'properti.id','=','properti_img.id_properti')
            ->leftJoin('properti_kav', 'properti.id','=','properti_kav.id_properti') 
            ->groupBy('properti.id')
            ->OrderBy('properti.id', 'ASC')
            ->get();
        }	    
		return $data;
	}	

    public function listkonsumen($id)
	{
        $db = DB::connection('mysql');
        if(Auth::user()->id_jabatan == 9){
            $listuser = $db->table('konsumen')
            ->select(db::raw("konsumen.*, properti_kav.nama as nama_kav, properti_kav.tipe as tipe_unit
                , konsumen_spr.gross_total"))
            ->leftjoin("konsumen_spr","konsumen.id","=","konsumen_spr.id_konsumen")
            ->leftjoin("properti_kav","konsumen_spr.id_kav","=","properti_kav.id")
            ->where('iskonsumen','=','1')
            ->where('status_spr','=','1')
            ->where('konsumen_spr.id_marketing','=',Auth::user()->id)
            ->where('konsumen_spr.id_properti','=',$id)                    
            ->OrderBy('nama', 'ASC')->get();
        }else{
            $listuser = $db->table('konsumen')
            ->select(db::raw("konsumen.*, properti_kav.nama as nama_kav, properti_kav.tipe as tipe_unit
                , konsumen_spr.gross_total"))
            ->leftjoin("konsumen_spr","konsumen.id","=","konsumen_spr.id_konsumen")
            ->leftjoin("properti_kav","konsumen_spr.id_kav","=","properti_kav.id")
            ->where('iskonsumen','=','1')
            ->where('status_spr','=','1') 
            ->where('konsumen_spr.id_properti','=',$id)                    
            ->OrderBy('nama', 'ASC')->get();
        } 
        
        return $listuser;
    }	 

    
    public function listdoc($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->table('konsumen_doc')
                    ->select(DB::raw('konsumen_doc.*, jenis_doc_konsumen.nama as nama_dokumen'))
                    ->RightJoin('jenis_doc_konsumen','konsumen_doc.id_jenis','=','jenis_doc_konsumen.id')
                    ->where('id_konsumen','=',$id)             
                    ->OrderBy('id_jenis', 'ASC')->get();
        
        return $listuser;
    }

    public function listdoc2()
	{
		$db = DB::connection('mysql');
        $listuser = $db->table('jenis_doc_konsumen') 
                    ->select(DB::raw("id as id_jenis,nama as nama_dokumen, '' as photo  "))            
                    ->OrderBy('id', 'ASC')->get();
        
        return $listuser;
    }
    
    public function mykonsumen($id)
	{
        $db = DB::connection('mysql');
        $listuser = $db->table('konsumen')
        ->select(db::raw("konsumen.*, properti_kav.nama as nama_kav, properti_kav.tipe as tipe_unit
            , konsumen_spr.gross_total"))
        ->leftjoin("konsumen_spr","konsumen.id","=","konsumen_spr.id_konsumen")
        ->leftjoin("properti_kav","konsumen_spr.id_kav","=","properti_kav.id")
        ->where('iskonsumen','=','1')
        ->where('status_spr','=','1')
        ->where('konsumen_spr.id_marketing','=',Auth::user()->id)
        ->where('konsumen.kode','=',$id)                    
        ->OrderBy('nama', 'ASC')->get();
 
        
        return $listuser;
    }	
	
}
