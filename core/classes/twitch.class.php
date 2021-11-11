<?php
        class Twitch{
                function __construct($uid){
                        $this->client_id = '****v7dcwyzi**********';
                        $this->ch=curl_init();
                        curl_setopt($this->ch, CURLOPT_HTTPHEADER, 
                                array(
                                        "Client-ID: ".$this->client_id,
                                )
                        );
                        
                        curl_setopt($this->ch, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS | CURLPROTO_HTTP);
                        curl_setopt($this->ch, CURLOPT_PROXY, '127.0.0.1');
                        curl_setopt($this->ch, CURLOPT_PROXYPORT, '54321');
                        curl_setopt($this->ch, CURLOPT_REDIR_PROTOCOLS, CURLPROTO_HTTP |CURLPROTO_HTTPS);
                        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($this->ch, CURLOPT_MAXREDIRS,503);
                        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 1001);
                        curl_setopt($this->ch, CURLOPT_PATH_AS_IS, true);
                        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
                        curl_setopt($this->ch, CURLOPT_TIMEOUT, 1001);
                        //curl_setopt($this->ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
                        curl_setopt($this->ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 10.0; rv:78.0) Gecko/20100101 Firefox/78.0");
                        curl_setopt($this->ch, CURLOPT_HEADER,false);
                        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER,true);
                        curl_setopt($this->ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
                        //curl_setopt($this->ch, CURLOPT_BINARYTRANSFER, 1);
                }
                
                function similarUsers($user=null){
                        return false;
                        if($user==null)
                                $user=$this->uid;
                        $payload ="{\"requests\":[{\"indexName\":\"user\",\"params\":\"query=$user&page=0&hitsPerPage=100&numericFilters=%5B%5D&facets=*&facetFilters=&restrictSearchableAttributes=%5B%5D\"}]}";

                        curl_setopt($this->ch, CURLOPT_HEADER,false);
                        curl_setopt($this->ch, CURLOPT_URL, "https://xluo134hor-3.algolianet.com/1/indexes/*/queries?x-algolia-agent=Algolia%20for%20vanilla%20JavaScript%203.24.11&x-algolia-application-id=XLUO134HOR&x-algolia-api-key=d157112f6fc2cab93ce4b01227c80a6d");
                        curl_setopt($this->ch, CURLOPT_POST, 1);
                        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $payload);
                        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
                                'Content-Type: application/json'
                        ));
                        $similarUsers  = curl_exec($this->ch);
                        $objSQL=new SQL();
                        curl_close($this->ch);
                        $similarUsers=json_decode($similarUsers,true)['results'][0]['hits'];
                        foreach($similarUsers as $user){
                                $uid=intval($user['objectID']);
                                if(isset($uid) && is_numeric($uid)){
                                        $login=isset($user['login'])?htmlentities($user['login']):null;
                                        $name=isset($user['name'])?htmlentities($user['name']):null;
                                        $followers=isset($user['followers'])?intval($user['followers']):0;
                                        $created_at=isset($user['created_at'])?intval($user['created_at']):null;
                                        $urlImg=isset($user['profile_image'])?$user['profile_image']:null;
                                        $game=isset($user['game'])?$user['game']:null;
                                        $status=isset($user['status'])?htmlentities($user['status']):null;
                                        $objSQL->query(
                                                "insert into userInTwitch (id,uid,login,name,followers,created_at,urlImg,game,status) values(null,:uid,:login,:name,:followers,:created_at,:urlImg,:game,:status) ON DUPLICATE KEY UPDATE login=:login,name=:name,followers=:followers,created_at=:created_at,urlImg=:urlImg,game=:game,status=:status",
                                                array(
                                                        "uid"=>$uid,
                                                        "login"=>$login,
                                                        "name"=>$name,
                                                        "followers"=>$followers,
                                                        "created_at"=>$created_at,
                                                        "urlImg"=>$urlImg,
                                                        "game"=>$game,
                                                        "status"=>$status,
                                                        
                                                ),
                                        );
                                }
                        }
                        return $similarUsers;
                }

        }
?>
