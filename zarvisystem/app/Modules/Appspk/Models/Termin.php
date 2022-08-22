<?php
namespace App\Modules\Appspk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Termin extends Model {
    protected $table = 'termin';
    public $timestamps = true; 
 

}
