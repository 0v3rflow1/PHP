<?php
        class IP{

                function __construct($host=NULL){
                        $host=($host===NULL||empty($host))?"localhost":$host;
                        $this->addr=($host!=="localhost")?gethostbyname($host):'127.0.0.1';
                        $this->host=($host===$this->addr)?gethostbyaddr($host):$host;
                        $this->client=$this->client();
                }

                function checkPort($port){
                        if(!is_numeric($port))
                                return false;
                        $host = htmlentities($this->host);
                        $connection = @fsockopen($host, $port,$errno, $errstr,1);
                        if (is_resource($connection))
                        {
                                $ports=array(80,81,82,8080,8081);
                                if(in_array($port,$ports)){
                                        //$tags=get_meta_tags('http://'.$host.":".$port);
                                }
                                include_once(PATH_CLASS_SQL);
                                $objSQL=new SQL();
                                $result=$objSQL->query(
                                        "insert into ips (id,ip,host,port) values(NULL,:ip,:host,:port)",
                                        array(":ip"=>$this->addr,":host"=>$this->host,":port"=>$port)
                                );
                                $r = '<h2>' . $host . ':' . $port . ' ' . '(' . getservbyport($port, 'tcp') . ') is open.</h2>' . "\n";
                                fclose($connection);
                        }
                        else
                        {
                                $r = '<h2>' . $host . ':' . $port . ' is not responding.</h2>' . "\n";
                        }
                        return $r;
                }

                function client(){
                        if (!empty($_SERVER['HTTP_CLIENT_IP'])){
                                $ip = $_SERVER['HTTP_CLIENT_IP'];
                        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
                                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                        }else{
                                $ip = $_SERVER['REMOTE_ADDR'];
                        }
                        return $ip;
                }

        }
?>
