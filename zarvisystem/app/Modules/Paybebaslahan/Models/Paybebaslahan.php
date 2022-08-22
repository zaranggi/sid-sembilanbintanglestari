<?php
namespace App\Modules\Paybebaslahan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Paybebaslahan extends Model {
    protected $table = 'm_bebas_lahan_termin';
    public $timestamps = true;


    public function listbank(){

		$db = DB::connection('mysql');
		$data = $db->table('bank')->OrderBy('nama', 'ASC')->get();
        return $data;

	}
	public function listall()
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("
		SELECT a.*,b.nama AS nama_properti FROM m_bebas_lahan a
		LEFT JOIN properti b ON a.id_properti = b.id
		ORDER BY id DESC;");
		return $listuser;
	}


	public function detail($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("
		SELECT a.*,b.nama AS nama_properti FROM m_bebas_lahan a
		LEFT JOIN properti b ON a.id_properti = b.id
		where a.id='$id';");
		return $listuser;
	}

	public function detail_termin($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("
		SELECT a.*, c.nama AS nama_properti, if(status = 0,'Belum Pengajuan', if(a.status=1,'Diajukan',if(a.status='2','Disetujui','Ditolak'))) as status_pembayaran,b.tanggal_jth_tempo
		FROM m_bebas_lahan_termin a
		left join m_bebas_lahan b on a.id_bebas_lahan = b.id
		LEFT JOIN properti c ON b.id_properti = c.id
		where a.id_bebas_lahan = '$id'
		ORDER BY a.id DESC;");
		return $listuser;
	}


	public function detail_termin_his($id)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("
		SELECT a.*, c.nama AS nama_properti, if(a.status = 0,0,nilai)  as bayar,if(status = 0,'Belum Pengajuan', if(a.status=1,'Diajukan',if(a.status='2','Disetujui','Ditolak'))) as status_pembayaran,b.tanggal_jth_tempo
		FROM m_bebas_lahan_termin a
		left join m_bebas_lahan b on a.id_bebas_lahan = b.id
		LEFT JOIN properti c ON b.id_properti = c.id
		where a.id_bebas_lahan = '$id' and status = 2
		ORDER BY a.id DESC;");
		return $listuser;
	}


	public function datacetak($kode)
	{
		$db = DB::connection('mysql');
		$listuser = $db->select("
        select * from m_bebas_lahan_termin
		where id='$kode'; ");
		return $listuser;
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



}
