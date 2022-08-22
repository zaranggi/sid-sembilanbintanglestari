<?php
namespace App\Modules\Setkatpekerjaan\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Setkatpekerjaan extends Model {
    protected $table = 'jenis_progres_kategori';
    public $timestamps = true; 
}
