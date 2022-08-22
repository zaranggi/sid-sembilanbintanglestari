<?php
namespace App\Modules\Mundur\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Mundur extends Model {
    protected $table = 'mundur';
    public $timestamps = true;
 
    
    public function listall()
	{
		$db = DB::connection('mysql');
        $data = $db->select("select
        a.id as id,
        a.id_spr as id_spr,
        b.nama as nama_konsumen,
        g.name as nama_marketing,
        c.nama as nama_properti,
        d.nama as nama_kav,
        d.tipe as tipe_unit,
        f.gross_total as nilai_mou,
        a.total_tagihan as total_tagihan,
        a.terbayar as terbayar,
        a.pengembalian  as pengembalian,
        a.tanggal as tanggal_mundur,
        a.status
        from mundur a
        left join konsumen_spr f on a.id_spr = f.id
        left join konsumen b on f.id_konsumen = b.id
        left join properti c on f.id_properti = c.id
        left join properti_kav d on f.id_kav = d.id
        left join users g on f.id_marketing = g.id 
        ");
		return $data;
	}	
      
    
    public function mou()
	{
		$db = DB::connection('mysql');
        $data = $db->select("SELECT a.id, a.kode,b.nama from konsumen_spr a
        left join konsumen b on a.id_konsumen = b.id 
		where a.status_spr = 1
        and realisasi = 'Belum'
        order by b.nama");
		return $data;
    }	

    public function datanya($id_spr)
	{
		$db = DB::connection('mysql');
        $data = $db->select("select *, (total_tagihan - terbayar) as kekurangan from
        (
            select
            b.nama as nama_konsumen,
            b.kode,b.idcard,b.alamat,b.telp,
            g.name as nama_marketing,
            c.nama as nama_properti,
            d.nama as nama_kav,
            d.tipe as tipe_unit,
            a.gross_total as nilai_mou,
            (tagihan1 + tagihan2 + tagihan3 + tagihan4 + tagihan5 + tagihan6 + tagihan7) as total_tagihan,
            (bayar1 + bayar2 + bayar3 + bayar4 + bayar5 + bayar6 + bayar7) as terbayar,
            f.pengembalian  as pengembalian,
            f.tanggal as tanggal_mundur,
            h.*
            from konsumen_spr a
            left join konsumen b on a.id_konsumen = b.id
            left join properti c on a.id_properti = c.id
            left join properti_kav d on a.id_kav = d.id
            left join mundur f on a.id = f.id_spr
            left join users g on a.id_marketing = g.id
            left join (
            select id_spr,
            sum(if(id_jenis=1,tagihan,0)) as tagihan1, sum(if(id_jenis=1,bayar,0)) as bayar1,
            sum(if(id_jenis=2,tagihan,0)) as tagihan2, sum(if(id_jenis=2,bayar,0)) as bayar2,
            sum(if(id_jenis=3,tagihan,0)) as tagihan3, sum(if(id_jenis=3,bayar,0)) as bayar3,
            sum(if(id_jenis=4,tagihan,0)) as tagihan4, sum(if(id_jenis=4,bayar,0)) as bayar4,
            sum(if(id_jenis=5,tagihan,0)) as tagihan5, sum(if(id_jenis=5,bayar,0)) as bayar5,
            sum(if(id_jenis=6,tagihan,0)) as tagihan6, sum(if(id_jenis=6,bayar,0)) as bayar6,
            sum(if(id_jenis=7,tagihan,0)) as tagihan7, sum(if(id_jenis=7,bayar,0)) as bayar7
            from tagihan where id_spr = $id_spr
            ) h on a.id = h.id_spr
            where a.id = $id_spr
        ) x
        ");
		return $data;
	}	
    
    public function preview($id_spr)
	{
		$db = DB::connection('mysql');
        $data = $db->select("select *, (total_tagihan - terbayar) as kekurangan from
        (
            select
            b.nama as nama_konsumen,
            b.kode,b.idcard,b.alamat,b.telp,
            g.name as nama_marketing,
            c.nama as nama_properti,
            d.nama as nama_kav,
            d.tipe as tipe_unit,
            a.gross_total as nilai_mou,
            (tagihan1 + tagihan2 + tagihan3 + tagihan4 + tagihan5 + tagihan6 + tagihan7) as total_tagihan,
            (bayar1 + bayar2 + bayar3 + bayar4 + bayar5 + bayar6 + bayar7) as terbayar,
            f.pengembalian  as pengembalian,
            f.tanggal as tanggal_mundur,
            h.*
            from konsumen_spr a
            left join konsumen b on a.id_konsumen = b.id
            left join properti c on a.id_properti = c.id
            left join properti_kav d on a.id_kav = d.id
            left join mundur f on a.id = f.id_spr
            left join users g on a.id_marketing = g.id
            left join (
            select id_spr,
            sum(if(id_jenis=1,tagihan,0)) as tagihan1, sum(if(id_jenis=1,bayar,0)) as bayar1,
            sum(if(id_jenis=2,tagihan,0)) as tagihan2, sum(if(id_jenis=2,bayar,0)) as bayar2,
            sum(if(id_jenis=3,tagihan,0)) as tagihan3, sum(if(id_jenis=3,bayar,0)) as bayar3,
            sum(if(id_jenis=4,tagihan,0)) as tagihan4, sum(if(id_jenis=4,bayar,0)) as bayar4,
            sum(if(id_jenis=5,tagihan,0)) as tagihan5, sum(if(id_jenis=5,bayar,0)) as bayar5,
            sum(if(id_jenis=6,tagihan,0)) as tagihan6, sum(if(id_jenis=6,bayar,0)) as bayar6,
            sum(if(id_jenis=7,tagihan,0)) as tagihan7, sum(if(id_jenis=7,bayar,0)) as bayar7
            from tagihan where id_spr = $id_spr
            ) h on a.id = h.id_spr
            where a.id = $id_spr
        ) x
        ");
		return $data;
	}	
	
}
