<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Cache;
use AppHelper;
class VideoController extends ConstructController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function show(){
        if(!empty($this->_parame['yid'])){
            $video = Cache::store('memcached')->remember('video_'.base64_encode($this->_parame['yid']), 1, function()
            {
                return DB::connection('mongodb')->collection('mongo_video')
                    ->where('yid',$this->_parame['yid'])->first();
            });
            if(!empty($video['title'])){
                DB::connection('mongodb')->collection('mongo_video')
                    ->where('yid',$this->_parame['yid'])
                    ->increment('view', 1);
                $videoParent=[];
                if(!empty($video['parent'])){
                    $videoParent = Cache::store('memcached')->remember('vY_parent_'.base64_encode($video['parent']).'_'.$video['_id'], 1, function() use($video)
                    {
                        return DB::connection('mongodb')->collection('mongo_video')
                            ->where('parent',$video['parent'])
                            ->where('_id','!=',(string)$video['_id'])
                            ->get()->toArray();
                    });
                }
                $return=array(
                    'video'=>$video,
                    'videoParent'=>$videoParent
                );
                return view('video.show', $return);
            }else{
                echo 'video not found';
            }
        }
    }
    public function showById(){
        if(!empty($this->_parame['yid'])){
            $video = Cache::store('memcached')->remember('infoVideoYoutube_'.$this->_parame['yid'], 1, function()
            {
                return DB::connection('mongodb')->collection('mongo_video')
                    ->where('yid',$this->_parame['yid'])->first();
            });
            if(!empty($video['yid'])){
                $videoParent=[];
                if(!empty($video['parent'])){
                    $videoParent = Cache::store('memcached')->remember('infoVideoYoutube_parent_'.base64_encode($video['parent']).'_'.$video['_id'], 1, function() use($video)
                    {
                        return DB::connection('mongodb')->collection('mongo_video')
                            ->where('parent',$video['parent'])
                            ->where('_id','!=',(string)$video['_id'])
                            ->get()->toArray();
                    });
                }
                $return=array(
                    'video'=>$video,
                    'videoParent'=>$videoParent
                );
                return view('video.show', $return);
            }
        }
    }
}
