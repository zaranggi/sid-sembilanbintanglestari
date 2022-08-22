<?php
namespace App\Modules\Munit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Kavimg extends Model {
    protected $table = 'properti_kav_img';
    public $timestamps = true;
 
}
