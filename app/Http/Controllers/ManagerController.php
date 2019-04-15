<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Model\Site_config;

class ManagerController extends ConstructController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    public function siteConfig()
    {
        $siteConfig=DB::table('site_config')->first();
        return view('manager.site_config',array(
            'siteConfig'=>$siteConfig
        ));
    }
    public function siteConfigUpdate(Request $request){
        if(!empty($request->site_name) && !empty($request->site_domain) && !empty($request->site_url) && !empty($request->site_lang)){
            $data=array(
                'site_name'=>$request->site_name,
                'site_description'=>$request->site_description,
                'site_name_short'=>$request->site_name_short,
                'site_domain'=>$request->site_domain,
                'site_url'=>$request->site_url,
                'site_lang'=>$request->site_lang,
                'webmaster_tools'=>$request->webmaster_tools,
                'site_ads'=>$request->site_ads,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
            );
            Site_config::updateOrCreate(['config_type' => 'site_config'],$data);
        }
        return redirect()->route('site.config');
    }
}
