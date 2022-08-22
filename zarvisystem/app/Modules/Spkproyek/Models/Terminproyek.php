<?php
namespace App\Modules\Spkproyek\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Terminproyek extends Model {
    protected $table = 'termin_proyek';
    public $timestamps = true; 
 

}
