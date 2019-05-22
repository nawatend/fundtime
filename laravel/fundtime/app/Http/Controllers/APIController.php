<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ConvertCurrencyTrait;

class APIController extends Controller
{
    public function postConvert(Request $r)
    {
        $cost = $this->convertWithEnvRate($r->credits)*100;
        $credits = $r->credits;

        return [ 'cost' => $cost];
    }
}
