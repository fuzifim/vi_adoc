#### Deploy 

Centos 6.9 

Change vendor/jeremykendall/php-domain-parser/src/IDNAConverterTrait.php 
Line 110 private function idnToAscii(string $domain): string 

```
if (defined('INTL_IDNA_VARIANT_UTS46')) {

    $output = idn_to_utf8($domain, 0, INTL_IDNA_VARIANT_UTS46, $arr);
} else {

    $output = idn_to_utf8($domain);
}
```
#### Channel Config 

- Channel Color: 
```
$attribute->value=array('
    'channel_menu'=>'#3b5997', 
    'channel_menu_text'=>'#ffffff', 
    'channel_title'=>'#f8f8f8', 
    'channel_title_text'=>'#333333', 
    'channel_footer'=>'#333333', 
    'channel_footer_text'=>'#ffffff'
'); 
```
- Channel Logo 
```
$attribute=array(
    'media_id'=>1, 
    'url'=>'https://cungcap.net/themes/main/assets/img/logo-red-blue.svg', 
    'url_thumb'=>'https://cungcap.net/themes/main/assets/img/logo-red-blue.svg', 
    'url_small'=>'https://cungcap.net/themes/main/assets/img/logo-red-blue.svg', 
    'url_xs'=>'https://cungcap.net/themes/main/assets/img/logo-red-blue.svg', 
    'url_icon'=>'https://cungcap.net/themes/main/assets/img/logo-red-blue.svg'
); 
```