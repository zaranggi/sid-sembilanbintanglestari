<?php
namespace App\Modules\Lapprogbangun\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Lapprogbangun extends Model {
    protected $table = 'progres_bangun';
    public $timestamps = true;

	public function perumahan()
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


    public function dataall($id)
	{
		$id_marketing = Auth::user()->id;
		$db = DB::connection('mysql');
		if(Auth::user()->id_jabatan == 9){
			$listuser = $db->select("
            select
            id_prog,
            c.nama as nama_properti,
            d.nama as nama_kav,
            d.tipe as tipe_unit,
            a.ach
            from (
                select a.*, b.id_prog, if(t = ach, tbobot, (tbobot/t) * ach) as ach from
                (
                    select id_properti,id_kav,id_jenis,sum(if(bobot = 0,100,bobot)) as tbobot from spk where status = 4 group by id_properti,id_kav
                ) a
                left join
                (
                    select
                    id_properti,id_kav,id as id_prog,
                    count(*) as t,
                    sum(if(status=1,1,0)) as ach
                    from progres_bangun group by id_properti,id_kav
                ) b on a.id_properti = b.id_properti and a.id_kav = b.id_kav
            ) a
						left join properti c on a.id_properti = c.id
						left join properti_kav d on a.id_kav = d.id
						left join konsumen_spr e on a.id_properti = e.id_properti and a.id_kav = e.id_kav and e.status_spr = 1
						where a.id_properti = $id and e.id_marketing= $id_marketing
						ORDER BY a.id_kav;
						");
		}else{
				$listuser = $db->select("
                select
				id_prog,
				c.nama as nama_properti,
				d.nama as nama_kav,
				d.tipe as tipe_unit,
				a.ach
				from (
					select a.*, b.id_prog, if(t = ach, tbobot, (tbobot/t) * ach) as ach from
					(
						select id_properti,id_kav,id_jenis,sum(if(bobot = 0,100,bobot)) as tbobot from spk where status = 4 group by id_properti,id_kav
					) a
					left join
					(
						select
						id_properti,id_kav,id as id_prog,
						count(*) as t,
						sum(if(status=1,1,0)) as ach
						from progres_bangun group by id_properti,id_kav
					) b on a.id_properti = b.id_properti and a.id_kav = b.id_kav
				) a
						left join properti c on a.id_properti = c.id
						left join properti_kav d on a.id_kav = d.id
						where a.id_properti = $id
						ORDER BY a.id_kav;
						");


		}

        return $listuser;
    }

	public function detail($id)
	{


		$db = DB::connection('mysql');
        $listuser = $db->select("
				select progres_bangun.*,jenis_spk.nama_spk, jenis_progres_kategori.nama as nama_pekerjaan
				from `progres_bangun`
				left join `jenis_spk` on `progres_bangun`.`jenis_spk` = `jenis_spk`.`id`
				left join `jenis_progres_kategori` on `progres_bangun`.`id_pekerjaan` = `jenis_progres_kategori`.`id`
				where progres_bangun.id = '$id'");

        return $listuser;
    }

	public function spk($id)
	{

		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT a.*,b.nama_spk, ((bobot/t) * c.ach) as achiev
							FROM spk a
							left join jenis_spk b on a.id_jenis=b.id
							left join
							( select jenis_spk, count(*) as t, sum(if(`status` = 1,1,0)) as ach
								from progres_bangun where id_properti ='$id_properti' and id_kav = '$id_kav' group by jenis_spk
							)c on a.id_jenis = c.jenis_spk
							WHERE id_properti ='$id_properti' and id_kav = '$id_kav' and a.status = '4'
							group by a.id_jenis;");

        return $listuser;
    }


    public function progres($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT A.ID, C.NAMA ,B.TERMIN, A.TANGGAL,A.KETERANGAN,A.PHOTO,A.STATUS, B.NILAI,B.KET_TERMIN
        FROM PROGRES_BANGUN A
        LEFT JOIN TERMIN B ON A.ID_TERMIN=B.ID
        LEFT JOIN JENIS_PROGRES_BANGUNAN C ON A.ID_JENIS = C.ID
        WHERE B.ID_SPK= $id");

        return $listuser;
    }

    public function cekspk($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT KODE FROM SPK WHERE ID= $id");

        return $listuser;
    }

	public function nama_perumahan($id)
	{
		$db = DB::connection('mysql');
        $listuser = $db->select("SELECT nama FROM properti WHERE id= $id");

        return $listuser;
    }

    public function listuser()
	{
		$db = DB::connection('mysql');
        $listuser = $db->table('users')->OrderBy('name', 'ASC')->get();

        return $listuser;
    }
}
