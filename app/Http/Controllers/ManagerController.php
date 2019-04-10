<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function myKeyword()
    {
        $getMyKeyword=DB::connection('mongodb')->collection('mongo_keyword')
            ->where('lang',env('LANG'))
            ->simplePaginate(10);
        dd($getMyKeyword);
        return view('manager.mykeyword');
    }
}
