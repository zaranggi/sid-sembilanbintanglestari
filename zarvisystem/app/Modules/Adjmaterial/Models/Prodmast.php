<?php
namespace App\Modules\Adjmaterial\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Prodmast extends Model {
    protected $table = 'prodmast';
    protected $primaryKey = 'prdcd';
    public $timestamps = true;
	public $incrementing = false;

}
