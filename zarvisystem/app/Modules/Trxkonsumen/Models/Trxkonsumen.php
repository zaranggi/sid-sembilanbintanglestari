<?php
namespace App\Modules\Trxkonsumen\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Trxkonsumen extends Model {
    protected $table = 'konsumen_spr';
    public $timestamps = true;


    public function listuser()
	{
		$db = DB::connection('mysql');
		$listuser = $db->table('users')->OrderBy('name', 'ASC')->get();	    return $listuser;
    }


	public function listunit($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti_kav')
				->select(db::raw("id,nama,keterangan"))
				->where('id_properti','=', $id)
				->wherenotin('status', [2,3,4])
				->OrderBy('id', 'ASC')
				->get();
		return $data;
	}
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

	public function unitdetail($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti_kav')
				->select(db::raw("tipe,luas_tanah,luas_bangunan,harga"))
				->where('id','=', $id)
				->get();
		return $data;
	}

	public function preview($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->table('konsumen_spr')
                    ->select(db::raw("konsumen_spr.id,
                        konsumen_spr.kode,
                        konsumen.nama as nama_konsumen,konsumen.alamat, konsumen.idcard, konsumen.telp,
                        properti.nama as nama_properti,
                        properti_kav.nama as nama_kav,properti_kav.tipe,properti_kav.luas_tanah,properti_kav.luas_bangunan,
                        properti_kav.harga,konsumen_spr.bonus,
                        users.name as nama_marketing,
                        konsumen_spr.tgl_transaksi,konsumen_spr.gross_unit,konsumen_spr.gross_total,konsumen_spr.gross,konsumen_spr.gross_um,
                        konsumen_spr.luas_penambahan_tanah,konsumen_spr.harga_penambahan_tanah,konsumen_spr.gross_penambahan_tanah,
                        konsumen_spr.penambahan_lain,konsumen_spr.harga_penambahan_lain,
                        konsumen_spr.gross_penambahan_lain,konsumen_spr.ppn,
                        konsumen_spr.gross_booking,konsumen_spr.cara_bayar_unit,konsumen_spr.tahapan_unit,
                        konsumen_spr.tahapan_um,
                        konsumen_spr.tahapan_unit,
                        tanggal_jt_booking,tanggal_jt_um,tanggal_jt_penambahan,tanggal_jt_unit
                        "))
                    ->leftjoin("konsumen","konsumen_spr.id_konsumen","=","konsumen.id")
                    ->leftjoin("properti","konsumen_spr.id_properti","=","properti.id")
                    ->leftjoin("properti_kav","konsumen_spr.id_kav","=","properti_kav.id")
                    ->leftjoin("users","konsumen_spr.id_marketing","=","users.id")
                    ->where('konsumen_spr.id','=', $id)
                    ->get();
        return $listuser;
    }


}
