<?php
namespace App\Modules\Notulen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Notulen extends Model {
    protected $table = 'notulen';
    public $timestamps = true; 
}
