<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use DB;
use Cache;
use Route;
class ConstructController extends Controller
{
    public $_siteConfig;
    public $_parame;
    public $_keywordPrimary;
    public $_rulesDomain;
    public function __construct(){
        $this->_parame=Route::current()->parameters();
        $this->_rulesDomain = Cache::store('file')->rememberForever('rulesDomain', function()
        {
            $pdp_url = public_path('data/public_suffix_list.dat.txt');
            $rules = \Pdp\Rules::createFromPath($pdp_url);
            return $rules;
        });
        $this->_siteConfig = Cache::store('memcached')->remember('site_config', 1, function()
        {
            return DB::table('site_config')->where('config_type','site_config')->first();
        });
        $this->_keywordPrimary = Cache::store('memcached')->remember('keyword_primary', 1, function()
        {
            return DB::connection('mongodb')->collection('mongo_keyword')
                ->where('app_domain',config('app.domain'))
                ->where('lang',config('app.locale'))
                ->where('parent',null)
                ->simplePaginate(50);
        });
        $this->viewShare();
    }
    private function viewShare(){
        view()->share(
            'channel',array(
                'siteConfig'=>$this->_siteConfig,
                'keywordPrimary'=>$this->_keywordPrimary,
            )
        );
    }
}