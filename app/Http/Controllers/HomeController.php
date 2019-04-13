<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Cache;

class HomeController extends ConstructController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        if(config('app.domain')=='adoc.xyz'){
            $keywordNewUpdate=Cache::store('memcached')->remember('newKeyword', 1, function()
            {
                return DB::connection('mongodb')->collection('mongo_keyword')
                    ->where('lang',config('app.locale'))
                    ->where('craw_next','exists',true)
                    ->orderBy('updated_at','desc')
                    ->limit(120)->get();
            });
        }else{
            $keywordNewUpdate=Cache::store('memcached')->remember('newKeyword', 1, function()
            {
                return DB::connection('mongodb')->collection('mongo_keyword')
                    ->where('app_domain',config('app.domain'))
                    ->where('lang',config('app.locale'))
                    ->where('craw_next','exists',true)
                    ->orderBy('updated_at','desc')
                    ->limit(120)->get();
            });
        }
        $data=array(
            'newKeyword'=>$keywordNewUpdate
        );
        return view('welcome',$data);
    }
}
