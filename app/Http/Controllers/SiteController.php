<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Cache;
use AppHelper;
class SiteController extends ConstructController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function showById(){
        if(!empty($this->_parame['id'])){
            $site = Cache::store('memcached')->remember('site_info_'.$this->_parame['id'], 1, function()
            {
                return DB::connection('mongodb')->collection('mongo_site')
                    ->where('_id',$this->_parame['id'])->first();
            });
            if(!empty($site['title'])){
                $siteRelate=Cache::store('memcached')->remember('site_relate_'.base64_encode($site['domain']), 1, function() use($site)
                {
                    return DB::connection('mongodb')->collection('mongo_site')
                        ->where('domain',$site['domain'])
                        ->limit(10)->get();
                });
                $return=array(
                    'site'=>$site,
                    'siteRelate'=>$siteRelate
                );
                return view('site.show', $return);
            }
        }
    }
}
