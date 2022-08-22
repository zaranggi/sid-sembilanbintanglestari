<?php
namespace App\Modules\Spk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Spk extends Model {
    protected $table = 'spk';
    public $timestamps = true;

    public function dataall()
	{
		$db = DB::connection('mysql');
        $listuser = $db->table('spk')
        ->select(db::raw("spk.*,
        properti.nama as nama_properti,
        properti_kav.nama as nama_kav,properti_kav.tipe as tipe_unit,nama_spk"))
        ->leftjoin("properti","spk.id_properti","=","properti.id")
        ->leftjoin("properti_kav","spk.id_kav","=","properti_kav.id")
        ->leftjoin("jenis_spk","spk.id_jenis","=","jenis_spk.id")
        ->OrderBy('spk.id', 'DESC')->get();
        return $listuser;
    }

    public function dirman(){

		$db = DB::connection('mysql');
        $data = $db->table('users')
                    ->wherein("id_jabatan",[2,3,4])
                    ->OrderBy('name', 'ASC')->get();
        return $data;

    }

    public function jenis_spk(){

		$db = DB::connection('mysql');
        $spk = $db->select("select a.id,a.nama_spk from jenis_spk a left join mrab b on a.id=b.jenis_spk
        where b.status='2'");

        return $spk;

    }
    public function job(){

		$db = DB::connection('mysql');
        $spk = $db->table('jenis_progres_bangunan')->get();

        return $spk;

	}

    public function subkon(){

		$db = DB::connection('mysql');
        $data = $db->table('subkon')
                    ->OrderBy('nama', 'ASC')->get();
        return $data;

    }


    public function update_termin($idspk){

		$db = DB::connection('mysql');
        $data = $db->table('termin')
                    ->where('id_spk', $idspk)
                    ->update(['diajukanoleh' => Auth::user()->name, 'diajukantgl' => date("Y-m-d"), 'status' => 1]);
        return $data;

    }

    public function spkdetail($idspk){

		$db = DB::connection('mysql');
        $data = $db->select("select
                                a.*,
                                b.name as nama_pihak1,
                                c.nama as nama_subkon,
                                e.nama as nama_properti,
                                f.nama as nama_kav,
                                f.tipe as tipe_unit,
                                h.nama_spk
                                from spk a
                                left join users b on a.pihak1 = b.id
                                left join subkon c on a.id_subkon = c.id
                                left join properti e on a.id_properti = e.id
                                left join properti_kav f on a.id_kav = f.id
                                left join jenis_spk h on a.id_jenis = h.id
						where a.id = $idspk");

        return $data;

	}

	public function termindetail($idspk){

		$db = DB::connection('mysql');
        $data = $db->select("select * from termin where id_spk = $idspk");

        return $data;

	}

	public function jobdetail($idspk){

		$db = DB::connection('mysql');
        $data = $db->select("
                    select a.*,b.bobot, c.nama_spk, d.nama as nama_pekerjaan
                    from progres_bangun a
					left join spk b on a.id_spk = b.id
					left join jenis_spk c on a.jenis_spk = c.id
					left join jenis_progres_kategori d on a.id_pekerjaan = d.id
					where b.id = $idspk;");

        return $data;

    }


    public function properti(){

		$db = DB::connection('mysql');
        $data = $db->select("SELECT * FROM properti");

        return $data;

    }


    public function unit_kav($id_properti){

		$db = DB::connection('mysql');
        $data = $db->select("SELECT * FROM properti_kav where id_properti='$id_properti'");

        return $data;

    }


	public function listunit($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti_kav')
				->select(db::raw("id,nama,keterangan"))
				->where('id_properti','=', $id)
				->wherein('status', [2,4])
				->OrderBy('id', 'ASC')
				->get();
		return $data;
    }

	public function listspknya($id_properti,$tipe_unit)
	{
		$db = DB::connection('mysql');
		$data = $db->select("select * from mrab_new
								where status='2'
								and id_properti = $id_properti");
		return $data;
    }

	public function unitdetail($id)
	{
		$db = DB::connection('mysql');
		$data = $db->table('properti_kav')
				->select(db::raw("id_properti,tipe,luas_tanah,luas_bangunan,harga"))
				->where('id','=', $id)
				->get();
		return $data;
	}




}
