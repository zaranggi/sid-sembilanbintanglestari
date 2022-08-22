<?php
namespace App\Modules\Thr\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Thr extends Model {
    protected $table = 'thr';
    public $timestamps = true; 

       
}
