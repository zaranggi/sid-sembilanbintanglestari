<?php

namespace App\Modules\Legal\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LegalController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Legal::welcome");
    }
}
