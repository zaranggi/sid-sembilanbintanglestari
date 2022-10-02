<?php

namespace App\Modules\Bookingkeu\Models;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

/**

 * @property array|null|string name

 */

class Bookingkeu extends Model {

    protected $table = 'booking_marketing';

    public $timestamps = true;



	public function listall()
	{
		$db = DB::connection('mysql');

        $listuser = $db->select("select a.*, b.nama as nama_konsumen, c.nama as nama_properti,
		d.nama as nama_kav, d.tipe as tipe_unit, e.kode as kode_spr,f.id as id_note,f.keterangan as ket_keu
		from booking_marketing a
		left join konsumen b on a.id_konsumen = b.id
		left join properti c on a.id_properti = c.id
		left join properti_kav d on a.id_kav = d.id
		left join mtran_konsumen_note f on a.id = f.id_spr
		left join konsumen_spr e on a.id_properti = e.id_properti and a.id_kav = e.id_kav and e.status_spr = 1
		where a.status = 1
		order by a.id desc;");

        return $listuser;

    }


    public function listbank(){

		$db = DB::connection('mysql');
		$data = $db->table('bank')->OrderBy('nama', 'ASC')->get();
        return $data;

	}
    public function listproperti()

	{

        $iduser = Auth::user()->id;

		$db = DB::connection('mysql');

        $listuser = $db->select("SELECT a.nama as nama_properti, a.id  FROM properti a

                                LEFT JOIN properti_marketing b on a.id = b.id_properti

                                where b.id_users = '$iduser'

                                ");

        return $listuser;

    }

    public function updatekonsumen($kode,$nama,$alamat,$tlp,$idcard)

	{



		$db = DB::connection('mysql');

		$db->table('konsumen')

		->where('kode',$kode)

		->update(

			[

				'nama' => $nama,

				'alamat' => $alamat,

				'telp' => $tlp,

				'idcard' => $idcard

			]

		);

		return "sukses";

	}



	public function listunit($id)

	{

		$db = DB::connection('mysql');

		$data = $db->table('properti_kav')

				->select(db::raw("id,nama,keterangan"))

				->where('id_properti','=', $id)

				->where('status','=', 1)

				->OrderBy('id', 'ASC')

				->get();

		return $data;

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



	public function datacetak($kode)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("select a.*,e.kode as kode_mou,c.nama as nama_properti,
		d.nama as nama_kav,e.kode as kode_konsumen,e.kode as kode_pembayaran,d.tipe as tipe_unit
		from mtran_konsumen_note a
		left join booking_marketing b on a.id_spr = b.id
		left join properti c on b.id_properti = c.id
		left join properti_kav d on b.id_kav = d.id
		left join konsumen e on b.id_konsumen = e.id
		where a.id='$kode'; ");
		return $listuser;
	}



}

