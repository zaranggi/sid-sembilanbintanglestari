<?php
namespace App\Modules\Dafjobproyek\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Dafjobproyek extends Model {
    protected $table = 'jenis_progres_proyek';
    public $timestamps = true; 
}
