<?php
namespace App\Modules\Bonus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Bonus extends Model {
    protected $table = 'bonus';
    public $timestamps = true; 

       
}
