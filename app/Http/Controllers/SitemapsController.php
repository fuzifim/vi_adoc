<?
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Sitemap; 
use Cache;
use App\Model\Node; 
use Carbon\Carbon;
use DB;
class SitemapsController extends ConstructController
{
	public function __construct(){
		parent::__construct(); 
	}
    public function sitemap(){
        if($this->_parame['type']=='_category.xml'){
            $sitemapIndex='false';
            $getNote = Cache::store('memcached')->remember('sitemap_category',1, function()
            {
                return DB::connection('mongodb')->collection('mongo_keyword')
                    ->select('keyword')
                    ->where('lang',config('app.locale'))
                    ->where('craw_next','exists',true)
                    ->orderBy('updated_at','desc')
                    ->limit(200)->get();
            });
        }else if($this->_parame['type']=='_video.xml'){
            $sitemapIndex='false';
            $getNote = Cache::store('memcached')->remember('sitemap_video',1, function()
            {
                return DB::connection('mongodb')->collection('note')->select('_id','type','title', 'created_at')->where('type','video')
                    ->orderBy('updated_at','desc')
                    ->limit(1000)->get();
            });
        }else if($this->_parame['type']=='_domain.xml'){
            $sitemapIndex='false';
            $getNote = Cache::store('memcached')->remember('sitemap_domain',1, function()
            {
                return DB::connection('mongodb')->collection('mongo_domain')
                    ->select('domain')
                    ->where('craw_next','exists',true)
                    ->orderBy('updated_at','desc')
                    ->limit(200)->get();
            });
        }else if($this->_parame['type']=='_news.xml'){
            $sitemapIndex='false';
            $getNote = Cache::store('memcached')->remember('sitemap_news',1, function()
            {
                return DB::connection('mongodb')->collection('note')->select('_id','type','title', 'created_at')->where('type','news')
                    ->orderBy('updated_at','desc')
                    ->limit(1000)->get();
            });
        }else if($this->_parame['type']=='_company.xml'){
            $sitemapIndex='false';
            $getNote = Cache::store('memcached')->remember('sitemap_company',1, function()
            {
                //return Note::where('type','company')->where('status','active')->orderBy('created_at','desc')->limit(1000)->get();
                return DB::connection('mongodb')->collection('note')->select('_id','type','title', 'created_at')->where('type','company')
                    ->orderBy('updated_at','desc')
                    ->limit(1000)->get();
            });
        }else if($this->_parame['type']=='_product.xml'){
            $sitemapIndex='false';
            $getNote = Cache::store('memcached')->remember('sitemap_product',1, function()
            {
                return DB::connection('mongodb')->collection('note')->select('_id','type','title', 'created_at')->where('type','affiliate')
                    ->orderBy('updated_at','desc')
                    ->limit(1000)->get();
            });
        }else{
            $sitemapIndex='true';
            $getNote=array();
        }
        $data=array(
            'sitemapIndex'=>$sitemapIndex,
            'getNote'=>$getNote,
            'type'=>$this->_parame['type']
        );
        return response()->view('sitemap.main.sitemap',$data)->header('Content-Type', 'text/xml');
    }
    public function index()
    {
		if($this->_channel->channel_parent_id==0){
			$getSite = Cache::store('file')->remember('sitemapGetdomain_', 10, function()
			{
				return Node::where('type','domain')->where('status','=','active')
				->orderBy('updated_at','desc')
				->take(500)->get(); 
			}); 
			$getCompany = Cache::store('file')->remember('sitemapGetCompany_', 10, function()
			{
				return Node::where('type','company')->where('company_status','!=','delete')
				->orderBy('company_updated_at','desc')
				->take(500)->get(); 
			}); 
			$getNews = Cache::store('file')->remember('sitemapGetNews_', 10, function()
			{
				return Node::where('type','news')->where('status','active')
				->orderBy('updated_at','desc')
				->take(500)->get(); 
			}); 
			$getFeed = Cache::store('file')->remember('sitemapGetFeed_', 10, function()
			{
				return Feed_rss::where('status','active')
				->orderBy('updated_at','desc')
				->take(500)->get(); 
			});
			$Keywords=array(); 
			return response()->view('sitemap.main.index', [
				'getSite' => $getSite,
				'getCompany'=>$getCompany, 
				'Keywords'=>$Keywords, 
				'getNews'=>$getNews, 
				'getFeed'=>$getFeed
			])->header('Content-Type', 'text/xml');
		}else{
			$posts=Posts::where('posts.posts_status','=','active')
				//->where('posts.posts_type','=',0)
				->join('posts_join_channel','posts_join_channel.posts_id','=','posts.id')
				->where('posts_join_channel.channel_id','=',$this->_channel->id)
				//->join('channel','channel.id','=','posts_join_channel.channel_id')
				//->where('channel.channel_status','!=','delete')
				//->where('channel.service_attribute_id','!=',1) 
				
				//->where('channel.channel_date_end','>=',Carbon::now()->format('Y-m-d H:i:s')) 
				
				->groupBy('posts.id')
				->orderBy('posts.posts_updated_at','desc')
				->select('posts.*')
				->paginate(200); 
				//$posts->setPath(route('post.list',$this->_domainPrimary));
			return response()->view('sitemap.main.site', [
				'posts' => $posts,
			])->header('Content-Type', 'text/xml');
		}
    }
	public function rss()
    {
		if($this->_channel->channel_parent_id==0){
			$news = Cache::store('file')->remember('newsNew_10', 5, function()
			{
				return Node::where('type','news')->where('status','=','active')
					->orderBy('updated_at','DESC')->take(10)->get(); 
			}); 
			$feedRss = Cache::store('file')->remember('feedNew_6', 5, function()
			{
				return Feed_rss::where('status','active')->orderBy('updated_at','desc')->take(10)->get(); 
			});
			return response()->view('sitemap.main.rss_index', [
				'getNews'=>$news, 
				'getFeed'=>$feedRss
			])->header('Content-Type', 'text/xml');
		}
    }
	public function sub()
    {
		$posts=Posts::where('posts.posts_status','=','active')
			//->where('posts.posts_type','=',0)
			->join('posts_join_channel','posts_join_channel.posts_id','=','posts.id')
			->where('posts_join_channel.channel_id','!=',$this->_channel->id)
			->join('channel','channel.id','=','posts_join_channel.channel_id')
			->where('channel.channel_status','!=','delete')
			//->where('channel.service_attribute_id','!=',1) 
			
			->where('channel.channel_date_end','>=',Carbon::now()->format('Y-m-d H:i:s')) 
			
			->groupBy('posts.id')
			->orderBy('posts.posts_updated_at','desc')
			->select('posts.*')
			->paginate(200); 
		$getChannel=Channel::where('channel.channel_status','!=','delete')
			//->where('channel.service_attribute_id','!=',1)
			->where('channel.channel_parent_id','!=',0)
			->where('channel.channel_date_end','>=',Carbon::now()->format('Y-m-d H:i:s'))
			->groupBy('channel.id')
			->orderBy('channel.channel_updated_at','desc')
			->select('channel.*')
			->paginate(200); 
		//$getChannel->setPath(route('channel.list',$this->_domainPrimary));
		return response()->view('sitemap.main.sub', [
				'posts' => $posts,
				'getChannel'=>$getChannel
			])->header('Content-Type', 'text/xml');
	}
}