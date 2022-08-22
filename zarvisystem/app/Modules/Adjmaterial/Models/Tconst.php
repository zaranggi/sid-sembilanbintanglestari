<?php
namespace App\Modules\Adjmaterial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Tconst extends Model {
    protected $table = 'const';
    public $timestamps = true;

}
