<?php
namespace App\Modules\Spkrevisi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Progresbangun extends Model {
    protected $table = 'progres_proyek';
    public $timestamps = true; 
 

}
