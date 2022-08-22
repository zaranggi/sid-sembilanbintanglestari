<?php
namespace App\Modules\Bayarproyek\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Termin extends Model {
    protected $table = 'termin_proyek';
    public $timestamps = true;


}
