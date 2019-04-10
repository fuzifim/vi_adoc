<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Model\Keyword_mongo;
use Carbon\Carbon;
use Cache;
use AppHelper;
class KeywordController extends ConstructController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function show(){
        $this->_keyword=str_replace('+', ' ', $this->_parame['slug']);
        $this->_keyword=AppHelper::instance()->keywordDecodeBase64($this->_keyword);
        if(AppHelper::instance()->is_valid_url($this->_keyword)!=true) {
            $getKeyword = DB::connection('mongodb')->collection('mongo_keyword')
                ->where('base_64', base64_encode($this->_keyword))->first();
            if(!empty($getKeyword['keyword'])){
                DB::connection('mongodb')->collection('mongo_keyword')
                    ->where('base_64',base64_encode($this->_keyword))
                    ->increment('view', 1);
                $return=array(
                    'keyword'=>$getKeyword
                );
                return view('keyword.show', $return);
            }else{
                $return=array(
                    'keyword'=>$this->_keyword
                );
                return view('keyword.notfound',$return);
            }
        }else{
            $return=array(
                'keyword'=>$this->_keyword
            );
            return view('keyword.notfound',$return);
        }
    }
    public function keyword_of_page()
    {
        $getKeyword=DB::connection('mongodb')->collection('mongo_keyword')
            ->where('lang',env('LANG'))
            ->where('parent',null)
            ->simplePaginate(10);
        $data=array(
            'keywords'=>$getKeyword
        );
        return view('manager.keyword_of_page',$data);
    }
    public function keyword_of_page_add()
    {
        return view('manager.keyword_of_page_add');
    }
    public function keyword_of_page_update($id)
    {
        if(!empty($id)){
            $keyword=DB::connection('mongodb')->collection('mongo_keyword')
                ->where('_id',$id)
                ->first();
            $data=array(
                'keyword'=>$keyword
            );
            return view('manager.keyword_of_page_add',$data);
        }
    }
    public function keyword_of_page_add_request(Request $request)
    {
        if(!empty($request->keywordid)){
            $keyword=Keyword_mongo::find($request->keywordid);
            if(!empty($keyword->keyword)){
                $keyword->order_number=(!empty($request->orderNumber)?$request->orderNumber:0);
                $keyword->save();
                return redirect()->route('keyword.of.page.update', $request->keywordid);
            }
        }else if(!empty($request->keywordname)){
            $check=DB::connection('mongodb')->collection('mongo_keyword')
                ->where('base_64',base64_encode($request->keywordname))
                ->first();
            if(empty($check['keyword'])){
                $keywordId=DB::connection('mongodb')->collection('mongo_keyword')
                    ->insertGetId(
                        [
                            'keyword' => $request->keywordname,
                            'base_64' => base64_encode($request->keywordname),
                            'description'=>'',
                            'image'=>'',
                            'status'=>'pending',
                            'order_number'=>(!empty($request->orderNumber)?$request->orderNumber:0),
                            'lang'=>env('LANG'),
                            'created_at'=>new \MongoDB\BSON\UTCDateTime(Carbon::now()),
                            'updated_at'=>new \MongoDB\BSON\UTCDateTime(Carbon::now())
                        ]
                    );
                return redirect()->route('keyword.of.page.update', $keywordId);
            }else{
                dd('tu khoa da ton tai');
            }
        }
    }
}