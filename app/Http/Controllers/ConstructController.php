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
    public $_parame;
    public $_keywordPrimary;
    public function __construct(){
        $this->_parame=Route::current()->parameters();
        $this->_keywordPrimary = Cache::store('memcached')->remember('keyword_primary', 1, function()
        {
            return DB::connection('mongodb')->collection('mongo_keyword')
                ->where('lang',env('LANG'))
                ->simplePaginate(10);
        });
        $this->viewShare();
    }
    private function viewShare(){
        view()->share(
            'channel',array(
                'keywordPrimary'=>$this->_keywordPrimary,
            )
        );
    }
}