<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Cache;
use AppHelper;
class PagesController extends ConstructController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function gotoUrl(){
        if(!empty($this->_parame['url'])){
            $parsedUrl=parse_url($this->_parame['url']);
            $ads='true';
            if(!empty($parsedUrl['host'])){
                $domain = Cache::store('memcached')->remember('infoDomain_'.base64_encode($parsedUrl['host']), 1, function() use($parsedUrl)
                {
                    return DB::connection('mongodb')->collection('mongo_domain')
                        ->where('base_64',base64_encode($parsedUrl['host']))->first();
                });
                if(!empty($domain['attribute']['ads']) && $domain['attribute']['ads']=='disable'){
                    $ads='false';
                }else if($domain['status']=='blacklist' && $domain['status']=='disable' && $domain['status']=='delete'){
                    $ads='false';
                }
            }
            $return=array(
                'url'=>$this->_parame['url'],
                'ads'=>$ads
            );
            return view('page.goto',$return);
        }
    }
}
