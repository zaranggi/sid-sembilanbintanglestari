<?php
namespace App\Modules\Ajp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Ajpd extends Model {
    protected $table = 'jurnalid';
    public $timestamps = true;
  
}
