<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Keyword_mongo;
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
                $return=array(
                    'domain'=>$domain
                );
                return view('domain.show', $return);
            }else{
                echo 'domain not found';
            }
        }
    }
}
