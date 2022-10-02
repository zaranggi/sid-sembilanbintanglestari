<?php

namespace App\Modules\Fee\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeeController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("Fee::welcome");
    }
}
