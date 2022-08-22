<?php
namespace App\Modules\Tipe\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Tipe extends Model {
    protected $table = 'jenis_tipe';
    protected $primaryKey = 'nama';
    public $incrementing = false;
    public $timestamps = true;


}

