<?php

namespace App\Modules\Bookingm\Models;



use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

/**

 * @property array|null|string name

 */

class Bookingm extends Model {

    protected $table = 'booking_marketing';

    public $timestamps = true;



	public function listall()

	{

        $iduser = Auth::user()->id;

		$db = DB::connection('mysql');

		if( Auth::user()->id_jabatan == 1){

			$listuser = $db->select("select a.*, b.nama as nama_konsumen, c.nama as nama_properti,
			d.nama as nama_kav, d.tipe as tipe_unit, e.kode as kode_spr
			from booking_marketing a
			left join konsumen b on a.id_konsumen = b.id
			left join properti c on a.id_properti = c.id
			left join properti_kav d on a.id_kav = d.id
			left join konsumen_spr e on a.id_properti = e.id_properti and a.id_kav = e.id_kav and e.status_spr = 1
			where a.status = 1 order by a.id desc");

		}else{

			$listuser = $db->select("select a.*, b.nama as nama_konsumen, c.nama as nama_properti,
			d.nama as nama_kav, d.tipe as tipe_unit, e.kode as kode_spr
			from booking_marketing a
			left join konsumen b on a.id_konsumen = b.id
			left join properti c on a.id_properti = c.id
			left join properti_kav d on a.id_kav = d.id
			left join konsumen_spr e on a.id_properti = e.id_properti and a.id_kav = e.id_kav and e.status_spr = 1
			where a.id_marketing ='$iduser' and a.status = 1 order by a.id desc");

		}



        return $listuser;

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





}

