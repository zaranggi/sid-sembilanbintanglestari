<?php
namespace App\Modules\Konsumen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Dokumen extends Model {
    protected $table = 'konsumen_doc';
    protected $fillable = ['id_konsumen','id_jenis','status','cek'];
    protected $primaryKey = ['id', 'id_konsumen','id_jenis'];
    public $timestamps = true;



     
}
