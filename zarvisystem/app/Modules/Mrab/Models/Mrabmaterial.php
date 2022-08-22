<?php
namespace App\Modules\Mrab\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Mrabmaterial extends Model {
    protected $table = 'mrab_material';
    public $timestamps = true;
 
}
