<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HomeController extends ConstructController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $getDb=DB::connection('mongodb')->collection('mongo_keyword')->where('_id','5cad8cdcd1d2aa14005e5a52')->first();
        //dd($this->_keywordPrimary);
        return view('welcome');
    }
}
