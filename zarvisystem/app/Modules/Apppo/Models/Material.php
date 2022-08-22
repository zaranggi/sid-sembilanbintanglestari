<?php
namespace App\Modules\Apppo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Material extends Model {
    protected $table = 'prodmast';
    public $timestamps = true;


}
