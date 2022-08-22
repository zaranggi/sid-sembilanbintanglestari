<?php
namespace App\Modules\Realisasi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Realisasi2 extends Model {
    protected $table = 'realisasi';
    public $timestamps = true; 
 
}
