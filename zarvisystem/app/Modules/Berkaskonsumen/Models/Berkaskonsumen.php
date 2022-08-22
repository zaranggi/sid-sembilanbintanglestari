<?php
namespace App\Modules\Berkaskonsumen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Berkaskonsumen extends Model {
    protected $table = 'konsumen';
    public $timestamps = true;

    public function dataall()
	{
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

    public function listkonsumen($id)
	{
		$db = DB::connection('mysql');
		if(Auth::user()->id_jabatan == 9){
			  $listuser = $db->table('konsumen_spr')
                   ->select(db::raw("
                    konsumen_spr.id,konsumen_spr.id_konsumen,konsumen_spr.tanggal_jt_booking,
                    konsumen.nama,properti.nama as nama_properti,properti_kav.nama as nama_kavling,
                        konsumen_spr.cara_bayar_unit,konsumen.berkas,konsumen.berkas_lengkap,konsumen_kpr.status as sp3k_status,konsumen_spr.sp3k_nominal,
                        konsumen_spr.realisasi,konsumen_spr.log_kpr_bank,konsumen_spr.keterangan,konsumen_kpr.tanggal as tanggal_kprx
                    "))
                    ->leftJoin('konsumen_kpr', 'konsumen_spr.id','=','konsumen_kpr.id_spr')
                    ->leftJoin('konsumen', 'konsumen_spr.id_konsumen','=','konsumen.id')
                    ->leftjoin("properti","konsumen_spr.id_properti","=","properti.id")
                    ->leftJoin('properti_kav', 'konsumen_spr.id_kav','=','properti_kav.id')
					->where('konsumen_spr.id_marketing','=',Auth::user()->id)
                    ->where('konsumen_spr.id_properti','=',$id)
                    ->OrderBy('konsumen.nama', 'ASC')
                    ->groupBy('konsumen_spr.id')->get();
		}else{
			  $listuser = $db->table('konsumen_spr')
                    ->select(db::raw("
                    konsumen_spr.id,konsumen_spr.id_konsumen,konsumen_spr.tanggal_jt_booking,konsumen.nama,properti.nama as nama_properti,properti_kav.nama as nama_kavling,
                        konsumen_spr.cara_bayar_unit,konsumen.berkas,konsumen.berkas_lengkap,konsumen_kpr.status as sp3k_status,konsumen_spr.sp3k_nominal,
                        konsumen_spr.realisasi,konsumen_spr.log_kpr_bank,konsumen_spr.keterangan,konsumen_kpr.tanggal as tanggal_kprx
                    "))
                    ->leftJoin('konsumen_kpr', 'konsumen_spr.id','=','konsumen_kpr.id_spr')
                    ->leftJoin('konsumen', 'konsumen_spr.id_konsumen','=','konsumen.id')
                    ->leftjoin("properti","konsumen_spr.id_properti","=","properti.id")
                    ->leftJoin('properti_kav', 'konsumen_spr.id_kav','=','properti_kav.id')
                    ->where('konsumen_spr.id_properti','=',$id)
                    ->groupBy('konsumen_spr.id')->get();
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
        $listuser = $db->table('konsumen_spr')
                    ->select(db::raw("
                    konsumen_spr.id,konsumen_spr.id_konsumen,konsumen_spr.tanggal_jt_booking,konsumen.nama,properti.nama as nama_properti,properti_kav.nama as nama_kavling,
                        konsumen_spr.cara_bayar_unit,konsumen.berkas,konsumen.berkas_lengkap,konsumen_kpr.keterangan_sp3k as sp3k_status,konsumen_spr.sp3k_nominal,
                        konsumen_spr.realisasi,konsumen_spr.log_kpr_bank,konsumen_spr.keterangan,konsumen_kpr.tanggal as tanggal_kprx
                    "))
                    ->leftJoin('konsumen_kpr', 'konsumen_spr.id','=','konsumen_kpr.id_spr')
                    ->leftJoin('konsumen', 'konsumen_spr.id_konsumen','=','konsumen.id')
                    ->leftjoin("properti","konsumen_spr.id_properti","=","properti.id")
                    ->leftJoin('properti_kav', 'konsumen_spr.id_kav','=','properti_kav.id')
                    ->where('konsumen.kode','=',$id)
                    ->OrderBy('konsumen.nama', 'ASC')->get();



        return $listuser;
    }





}
