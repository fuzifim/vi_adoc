<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Site_config extends Model
{
    protected $table = 'site_config';
    public $timestamps = false;
    protected $fillable = ['config_type','site_name','site_description','site_name_short' ,'site_domain','site_url','site_lang','webmaster_tools','google_analytics_account','site_ads','updated_at','created_at'];
}
