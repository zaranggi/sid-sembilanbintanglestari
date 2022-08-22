<?php
namespace App\Modules\Mrabp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Mrabpjob extends Model {
    protected $table = 'mrab_job_proyek';
    public $timestamps = true;
  
}
