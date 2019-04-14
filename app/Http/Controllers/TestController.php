<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Cache;
use AppHelper;
class TestController extends ConstructController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function test(){
       $get= DB::connection('mongodb')->collection('mongo_keyword')
            ->where('base_64',base64_encode('quảng cáo facebook'))->first();
dd($get);
    }
}
