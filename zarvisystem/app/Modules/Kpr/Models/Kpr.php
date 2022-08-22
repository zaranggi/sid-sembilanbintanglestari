<?php
namespace App\Modules\Kpr\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Kpr extends Model {
    protected $table = 'konsumen_kpr';
    public $timestamps = true;

    public function dataall()
	{
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

    public function datakpr($id)
	{
		$db = DB::connection('mysql');
        $data = $db->table('konsumen_spr')
                ->select(db::raw("konsumen_spr.id,konsumen_spr.kode,konsumen_spr.sp3k_nominal, konsumen_spr.log_kpr,
							konsumen_spr.gross_rev_kpr, konsumen.nama,konsumen.alamat, properti.nama as nama_properti,
							properti_kav.nama as nama_kavling,users.name as marketing")) 
                ->leftJoin('konsumen', 'konsumen_spr.id_konsumen','=','konsumen.id')
				->leftJoin('properti', 'konsumen_spr.id_properti','=','properti.id')
				->leftJoin('properti_kav', 'konsumen_spr.id_kav','=','properti_kav.id')
                ->leftJoin('users', 'konsumen_spr.id_marketing','=','users.id')
                ->where('konsumen_spr.cara_bayar_unit','=','kpr')
                ->where('konsumen_spr.id_properti','=',$id)
				->OrderBy('konsumen_spr.id', 'DESC')
				->get();	    
		return $data;
	}	

    public function listkonsumen($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->table('konsumen')
                    ->where('iskonsumen','=','1')
                    ->where('id_properti','=',$id)                    
                    ->OrderBy('nama', 'ASC')->get();
        
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
                    ->select(DB::raw('id,nama as nama_dokumen, 0 as status '))            
                    ->OrderBy('id', 'ASC')->get();
        
        return $listuser;
    }
    
    public function mykonsumen($id)
	{
        $db = DB::connection('mysql');
         $data = $db->table('konsumen_spr')
                ->select(db::raw("konsumen_spr.id,konsumen_spr.kode, konsumen_spr.sp3k_nominal, konsumen_spr.log_kpr,
							konsumen_spr.gross_rev_kpr, konsumen.nama,konsumen.alamat, properti.nama as nama_properti,
							properti_kav.nama as nama_kavling,users.name as marketing")) 
                ->leftJoin('konsumen', 'konsumen_spr.id_konsumen','=','konsumen.id')
				->leftJoin('properti', 'konsumen_spr.id_properti','=','properti.id')
				->leftJoin('properti_kav', 'konsumen_spr.id_kav','=','properti_kav.id')
                ->leftJoin('users', 'konsumen_spr.id_marketing','=','users.id')
                ->where('konsumen_spr.cara_bayar_unit','=','kpr')
                ->where('konsumen_spr.log_kpr','=',0)
                ->where('konsumen.kode','=',$id)
				->OrderBy('konsumen_spr.id', 'ASC')
				->get();	    
		return $data;
    }	
	
}
