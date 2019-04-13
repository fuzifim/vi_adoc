<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Mongokeyword;
use Carbon\Carbon;
use Cache;
use AppHelper;
class DomainController extends ConstructController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function show(){
        if(!empty($this->_parame['domain'])){
            $domain = Cache::store('memcached')->remember('infoDomain_'.base64_encode($this->_parame['domain']), 1, function()
            {
                return DB::connection('mongodb')->collection('mongo_domain')
                    ->where('base_64',base64_encode($this->_parame['domain']))->first();
            });
            if(!empty($domain['domain'])){
                DB::connection('mongodb')->collection('mongo_domain')
                    ->where('base_64',base64_encode($this->_parame['domain']))
                    ->increment('view', 1);
                $siteRelate=Cache::store('memcached')->remember('site_relate_'.base64_encode($domain['domain']), 1, function() use($domain)
                {
                    return DB::connection('mongodb')->collection('mongo_site')
                        ->where('domain',$domain['domain'])
                        ->limit(10)->get();
                });
                $return=array(
                    'domain'=>$domain,
                    'siteRelate'=>$siteRelate
                );
                return view('domain.show', $return);
            }else{
                echo 'domain not found';
            }
        }
    }
}
