<?php
namespace App\Modules\Wacontact\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Wacontact extends Model {
    protected $table = 'wa_contact';
    public $timestamps = true;
 
	 
    
}
