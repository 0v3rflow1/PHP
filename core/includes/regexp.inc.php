<?php
defined("REGEXP_SECURE_FILENAME") || define("REGEXP_SECURE_FILENAME","/[a-z0-9_\-]*/i");
defined("REGEXP_USERNAME") || define("REGEXP_USERNAME","/[^a-z0-9_]/i");
defined("REGEXP_URI_IMAGE") || define("REGEXP_URI_IMAGE","/(http(s?):)([^ ]*\.(jpg|gif|png|jpeg))/i");

//https://twitter.com/Interior/status/463440424141459456"
defined("REGEXP_URI_TWITTER") || define("REGEXP_URI_TWITTER","/(https:\/\/(www\.)?)?(?:twitter\.com\/([a-z0-9]*))\/status\/([0-9]{5,45})/i");
//https://www.tiktok.com/@blabla/video/{ID}
defined("REGEXP_URI_TIKTOK") || define("REGEXP_URI_TIKTOK","/(https:\/\/(www\.)?)?(?:tiktok\.com\/@([a-z0-9]*))\/video\/([0-9]{5,30})/i");
defined("REGEXP_URI_YOUTUBE") || define("REGEXP_URI_YOUTUBE","/(https:\/\/(www\.)?)?(?:youtube\.com\/\S*(?:(?:\/e(?:mbed))?\/|watch\?(?:\S*?&?v\=))|youtu\.be\/)([a-zA-Z0-9_-]{6,11})/i");
defined("REGEXP_URI_LINK") || define("REGEXP_URI_LINK","/((ht|f)tp(s)?:\/\/[a-z0-9\-_\.][^ \s]{2,}\.{1,}[^ \s]{2,})/i");
defined("REGEXP_HASHTAG") || define("REGEXP_HASHTAG","/(#([áéíóúÁÉÍÓÚñÑ\w]{3,25}))/i");
defined("REGEXP_TAG_USERNAME") || define("REGEXP_TAG_USERNAME","/(@([\w]{3,25}))/i");

defined("REGEXP_IMAGE") || define("REGEXP_IMAGE","/\[\[IMG:(.*)\]\].*/i");
defined("REGEXP_YOUTUBE") || define("REGEXP_YOUTUBE","/\[\[YOUTUBE:([a-z0-9\-\_]*)\]\].*/i");
defined("REGEXP_TIKTOK") || define("REGEXP_TIKTOK","/\[\[TIKTOK:([a-z0-9\-\_]*)\|([0-9]*)\]\].*/i");
defined("REGEXP_TWITTER") || define("REGEXP_TWITTER","/\[\[TWITTER:([a-z0-9\-\_]*)\|([0-9]*)\]\].*/i");

defined("REGEXP_STRINGS") || define("REGEXP_STRINGS","/\w{5,}/i");
defined("REGEXP_EMAIL") || define("REGEXP_EMAIL","/[\w\-\+\.\_]+(\.[\w\-\+\.\_]+)*@[\w\-\+\.\_]+(\.[\w\+\.\_]+)*(\.[A-Za-z]{2,})/i");

defined("REGEXP_ANTI_XSS") || define("REGEXP_ANTI_XSS","/(<[^>]*>?[^<>]*(<\/[^>]*>?)?|((\\%3D)|(=))\[^\\n\]\*((\\%3C)|\<)\[^\\n\]+((\\%3E)|\>))/i");

defined("REGEXP_TECHNOLOGIES") || define("REGEXP_TECHNOLOGIES",array(
        "Jquery"=>array(
                "/\/\*! jQuery v[\d]\.[\d]\.[\d](\.[\d])? \| \(c\) OpenJS Foundation and other contributors \| jquery\.org\/license \*\//",
                "/jquery[.-]([\d.]*\d)[^/]*\.js/i",
                "/jquery.*\.js(?:\?ver(?:sion)?=([\d.]+))?/i",
                "/jquery.*\.js/i",
                <<<R
                /<script[^>]*src=(\"|\')http(s)?:\/\/code\.jquery\.com\/jquery-\d{1,3}\.\d{1,3}\.\d{1,3}(\.min)?\.js(\'|\")[^>]*><\/script>/
R,
        ),
        "Bootstrap"=>array(
                "/<link[^>]+?href=(\"|\')[^\"\']*bootstrap(?:\.min)?\.css/i",
                "/(?:\/([\d.]+))?(?:\/js)?\/bootstrap(?:\.min)?\.js/i",
                <<<R
                /<script[^>]*src=(\"|\')https:\/\/maxcdn\.bootstrapcdn\.com\/bootstrap\/\d{1,3}\.\d{1,3}\.\d{1,3}\/js\/bootstrap(\.min)?\.js(\'|\")[^>]*><\/script>/
R,
        ),
        "Comscore"=>array(
                "/\.scorecardresearch\.com/beacon\.js|COMSCORE\.beacon/",
        ),
        "Polyfill"=>array(
                "/polyfill\.min\.js/",
        ),
        "Google Adsense"=>array(
                "/googlesyndication\.com\//i",
        ),
        "Font Awesome"=>array(
                "/<link[^>]* href=[^>]+(?:([\d.]+)\/)?(?:css\/)?font-awesome(?:\.min)?\.css/i"
        ),
        "Facebook"=>array(
                "/\/\/connect\.facebook\.net\/[^\/]*\/[a-z]*\.js/i",
        ),
        "Cloudflare"=>array(
                "/server ?: ?cloudflare/i",
                "/report-uri=\"https:\/\/report-uri\.cloudflare\.com\/cdn-cgi\/beacon\/expect-ct/",
        ),
        "FreeBSD"=>array(
                "@FreeBSD(?: ([\d.]+))?@i",
        ),
        "Open SSL"=>array(
                "@OpenSSL(?:\/([\d.]+[a-z]?))?@i"
        ),
        "Perl"=>array(
                "@mod_perl(?:\/([\d\.]+))?@i",
        ),
        "PHP"=>array(
                "@php\/?([\d.]+)?@i",
                "@<link rel=[\"']stylesheet[\"'] [^>]+wp-(?:content|includes)@i",
                "@\/wp-includes\/@i",
                "@WordPress( [\d.]+)?@i",
                "/rel=(\"|\')https:\/\/api\.w\.org\/(\"|')/i"
        ),
        "Wordpress"=>array(
                "/<link rel=[\"']stylesheet[\"'] [^>]+wp-(?:content|includes)/i",
                "@\/wp-includes\/@i",
                "/WordPress( [\d.]+)?/i",
        ),
        "mod_perl"=>array(
                "/mod_perl(?:\/([\d\.]+))?/i",
        ),
        "Apache"=>array(
                "/(?:Apache(?:$|\/([\d.]+)|[^\/-])|(?:^|)HTTPD)/i",
                "/mod_perl(?:\/([\d\.]+))?/i"
        ),
        "Google Fonts API"=>array(
                "/<link[^>]* href=[^>]+fonts\.(?:googleapis|google)\.com/i"
        ),
        "Whatsapp"=>array(
                "/https:\/\/api\.whatsapp\.com\/send\?phone=\d+(&text=)?/"
        ),
        "Mysql"=>array(
                "@<link rel=[\"']stylesheet[\"'] [^>]+\/wp-(?:content|includes)\/@i",
                "@\/wp-(?:content|includes)\/@i",
                "@rel=(\"|')https:\/\/api\.w\.org\/(\"|')@i"
        ),
        "Google Analytics"=>array(
                "@google-analytics\.com\/(?:ga|urchin|analytics)\.js@i"
        ),
        "Quancast"=>array(
                "/\.quantserve\.com\/quant\.js/i",
        ),
        "MemberStack"=>array(
                "/memberstack\.js/i",
        ),
        "React"=>array(
                "/react.*\.js/i",
        ),
        "Google Maps"=>array(
                "@\/\/maps\.google(?:apis)?\.com/maps/api/js@i",
        ),
        "animate.css"=>array(
                "@<link [^>]+(?:/([\d.]+)/)?animate\.(?:min\.)?css@i",
        ),
        "DataTables"=>array(
                "/dataTables.*\.js/"
        )
));

defined("REGEXP_TAGS") || define("REGEXP_TAGS",array(
        "phpinfo"=>array(
                "/<title>phpinfo\(\)<\/title>/",
                "/\?=PHPE9568F34-D428-11d2-A769-00AA001ACF42(\"|') alt=\"PHP Logo\"/i",
                "/\?=PHPE9568F35-D428-11d2-A769-00AA001ACF42(\"|') alt=(\"|')Zend logo(\"|')/i",
                "/\?=PHPB8B5F2A0-3C92-11d3-A3A9-4C7B08C10000(\"|')>PHP Credits/i"
        ),
        "Index of"=>array(
                "/<title>Index of( [^>]*)?<\/title>/i",
        ),
        "Mysqli"=>array(
                "/You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near/",
                "/Msg \d{1,4}, Level \d{1,4}, State \d{1,4}, Line \d{1,4}/",
                "/ORA-\d{1,7}: quoted string not properly terminated./"
        ),
        "Phishing"=>array(
                
        )
));

/*
Ref:
https://github.com/PHPIDS/PHPIDS/blob/master/lib/IDS/default_filter.xml
*/
?>
