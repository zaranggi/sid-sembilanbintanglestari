<?php
namespace App\Modules\Mrab\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Mrabjob extends Model {
    protected $table = 'mrab_job';
    public $timestamps = true;
  
}
