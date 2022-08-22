<?php
namespace App\Modules\Spkrevisi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Terminrevisi extends Model {
    protected $table = 'termin_proyek';
    public $timestamps = true; 
 

}
