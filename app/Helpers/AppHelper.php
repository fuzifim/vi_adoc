<?php
namespace App\Helpers;
use Carbon\Carbon; 
use File; 
class AppHelper
{
    function has_ssl( $domain ) {
        $ssl_check = @fsockopen( 'ssl://' . $domain, 443, $errno, $errstr, 30 );
        $res = !! $ssl_check;
        if ( $ssl_check ) { fclose( $ssl_check ); }
        return $res;
    }
    function checkBlacklistWord($str){
        $blacklist=preg_split("/(\r\n|\n|\r)/",File::get(public_path('data/words_blacklist.txt')));
        foreach($blacklist as $a) {
            if (stripos($str,$a) !== false)
            {
                return false;
            }
        }
        return true;
    }
    function renameBlacklistWord($str){
        $blacklist=preg_split("/(\r\n|\n|\r)/",File::get(public_path('data/words_blacklist.txt')));
        return str_replace($blacklist, "***", $str);
    }
    function ConvertToUTF8Array($array){
        if(is_array($array)){
            $out=array();
            foreach ($array as $text){
                $encoding = mb_detect_encoding($text, mb_detect_order(), false);

                if($encoding == "UTF-8")
                {
                    $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
                }
                array_push($out, @iconv(mb_detect_encoding($text, mb_detect_order(), false), "UTF-8//IGNORE", $text));
            }
            return $out;
        }else{
            return $array;
        }
    }
    function detectUTF8($text){
        $enc = mb_detect_encoding($text, mb_list_encodings(), true);
        return $enc;
    }
    function convertToUTF8($text){
        $enc = mb_detect_encoding($text, mb_list_encodings(), true);
        if ($enc==false){
            $text=mb_strtolower($text, 'UTF-8');
        }
        else if ($enc!="UTF-8"){
            $text = @iconv($enc, "UTF-8//IGNORE", $text);
        }
        return $text;
    }
    function characterReplaceUrl($string){
        $string=strip_tags($string);
        $string=str_replace('/', 'Lw==', $string);
        $string=str_replace('\'', 'Jw==', $string);
        $string=str_replace('"', 'Ig==', $string);
        $string=str_replace(',', 'LA==', $string);
        $string=str_replace(';', 'Ow==', $string);
        $string=str_replace('<', 'PA==', $string);
        $string=str_replace('>', 'Pg==', $string);
        $string=str_replace('[', 'Ww==', $string);
        $string=str_replace(']', 'XQ==', $string);
        $string=str_replace('{', 'ew==', $string);
        $string=str_replace('}', 'fQ==', $string);
        $string=str_replace('|', 'fA==', $string);
        $string=str_replace('^', 'Xg==', $string);
        $string=str_replace('%', 'JQ==', $string);
        $string=str_replace('&', 'Jg==', $string);
        $string=str_replace('$', 'JA==', $string);
        $string=preg_replace('/([+])\\1+/', '$1',str_replace(' ','+',$string));
        return $string;
    }
    public function keywordDecodeBase64($string){
        //$keywordnew=preg_replace('{(.)\1+}','$1',rtrim(str_replace('+', ' ', preg_replace('/[^\w\s]+/u',' ' ,$this->_parame['slug'])), '+'));
        $string=str_replace('Lw==', '/', $string);
        $string=str_replace('Jw==', '\'', $string);
        $string=str_replace('Ig==', '"', $string);
        $string=str_replace('LA==', ',', $string);
        $string=str_replace('Ow==', ';', $string);
        $string=str_replace('PA==', '<', $string);
        $string=str_replace('Pg==', '>', $string);
        $string=str_replace('Ww==', '[', $string);
        $string=str_replace('XQ==', ']', $string);
        $string=str_replace('ew==', '{', $string);
        $string=str_replace('fQ==', '}', $string);
        $string=str_replace('fA==', '|', $string);
        $string=str_replace('Xg==', '^', $string);
        $string=str_replace('JQ==', '%', $string);
        $string=str_replace('Jg==', '&', $string);
        $string=str_replace('JA==', '$', $string);
        return $string;
    }
	function addNofollow($html, $skip = null,$linkJson=false) {
		if($linkJson==true){
			return preg_replace_callback(
				'/<a(.*?)href="(.*?)"([^>]*?)>/', function ($mach) use ($skip) {
					if(!($skip && strpos($mach[2], $skip) !== false) && strpos($mach[2], 'rel=') === false){
						return '<a class="siteLink" data-url='.htmlentities(json_encode($mach[2])).' href="javascript:void(0);">';
					}else{
						return $mach[0];
					}
				},
				$html
			);
		}else{
			return preg_replace_callback(
				"#(<a[^>]+?)>#is", function ($mach) use ($skip) {
					return (
						!($skip && strpos($mach[1], $skip) !== false) &&
						strpos($mach[1], 'rel=') === false
					) ? $mach[1] . ' rel="nofollow">' : $mach[0];
				},
				$html
			);
		}
	}
    public function is_valid_url($url) {
        // First check: is the url just a domain name? (allow a slash at the end)
        $_domain_regex = "|^[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*(\.[A-Za-z]{2,})/?$|";
        if (preg_match($_domain_regex, $url)) {
            return true;
        }

        // Second: Check if it's a url with a scheme and all
        $_regex = '#^([a-z][\w-]+:(?:/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))$#';
        if (preg_match($_regex, $url, $matches)) {
            // pull out the domain name, and make sure that the domain is valid.
            $_parts = parse_url($url);
            if (!in_array($_parts['scheme'], array( 'http', 'https' )))
                return false;

            // Check the domain using the regex, stops domains like "-example.com" passing through
            if (!preg_match($_domain_regex, $_parts['host']))
                return false;

            // This domain looks pretty valid. Only way to check it now is to download it!
            return true;
        }

        return false;
    }
	function time_request($time,$lang='')
    {
		if($lang=='en'){
			$minute=' minute ago'; 
			$hour=' hour ago'; 
			$day=' day ago'; 
			$month=' month ago'; 
			$year=' year ago'; 
		}else{
			$minute=' phút trước'; 
			$hour=' giờ trước'; 
			$day=' ngày trước'; 
			$month=' tháng trước'; 
			$year=' năm trước';
		}
        $date_current = date('Y-m-d H:i:s');
        $s = strtotime($date_current) - strtotime($time);
        if ($s <= 60) { // if < 60 seconds
            return '1 phút trước';
        }else
        {
            $t = intval($s / 60);
            if ($t >= 60) {
                $t = intval($t / 60);
                if ($t >= 24) {
                    $t = intval($t / 24);
                    if ($t >= 30) {
                        $t = intval($t / 30);
                        if ($t >= 12) {
                            $t = intval($t / 12);
                            return $t . $year;
                        } else {
                            return $t . $month;
                        }
                    } else {
                        return $t.$day;
                    }
                } else {
                    return $t.$hour;
                }
            } else {
                return $t.$minute;
            }
        }
    }
	function checkWordCC($str){ 
		$blacklist=preg_split("/(\r\n|\n|\r)/",File::get('words_cungcap.txt')); 
		foreach($blacklist as $a) {
			if (stripos($str,$a) !== false) 
			{
				return false; 
			}
		}
		return true; 
	}
	public function makeDir($root='img'){
		$dateFolder=[
			'day'=>date('d', strtotime(Carbon::now()->format('Y-m-d H:i:s'))), 
			'month'=>date('m', strtotime(Carbon::now()->format('Y-m-d H:i:s'))), 
			'year'=>date('Y', strtotime(Carbon::now()->format('Y-m-d H:i:s')))
		]; 
		$path = $root.'/'.$dateFolder['year'].'/'.$dateFolder['month'].'/'.$dateFolder['day']; 

		return $path; 
	}
	public static function price($price)
	{
		if(is_numeric($price)){
			return number_format($price, 0);
		}else{
			return 0; 
		}
	}
	public static function instance()
    {
        return new AppHelper();
    }
}