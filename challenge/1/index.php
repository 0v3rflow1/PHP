<?php
        if(isset($_GET['code'])){
                highlight_file("index.php");
        }
        class Auth{
                function __construct(){
                        //$this->alg="sha512";
                        $this->alg="md5";
                        //$this->hardcode1="745106d76120245fd909fdfd02dc33248043878851158898674fd118e834f447816dd136829767180b9c22541eacaea33f443cd25ec9fcf9e3b2eb69324900c2";
                        $this->hardcode1="c5af2e900e24e011e2ad81826104988e";
                        //$this->hardcode2="0a6e6a28ed6287c0de256cf0025f4d69ba4dbe374819f90f628156a57f42a6befa1f8f8978fa2c3d8b03ea932807ce8b9d2841edb3d244adbb6e8c9a73bb17df";
                        $this->hardcode2="ca053c4823bdb2a424a65ad07bd2f4ab";
                }
                function credentials($data=NULL){

                        $alg=$this->alg;
                        $ok1=$this->hardcode1;
                        $ok2=$this->hardcode2;

                        if($data===NULL)
                                return false;
                        $salt=(array_key_exists('magic',$data))?$data['magic']:NULL;
                        $user=(array_key_exists('user'.$salt, $data))?$data['user'.$salt]:NULL;
                        $pass=(array_key_exists('pass'.$salt, $data))?$data['pass'.$salt]:NULL;
                        $return=(hash($alg,$user)===$ok1 && hash($alg,$pass)===$ok2)?true:false;
                        return $return;
                }
        }

        $magic=uniqid("-hackTheGalaxy31337-");
        $method="POST";
        $objAuth=new Auth();
        if($objAuth->credentials($_POST)){
                $log=isset($_POST["log"])?htmlentities($_POST["log"]):"\nnope!\n";
                //file_get_contents("http://127.0.0.1:6666/".$log);
                @file_put_contents("pwned31337.log", "\n - ".$log."\n",FILE_APPEND | LOCK_EX);
                header("Location:/challenge/php/1/pwned31337.log#$log");
        }else{
                echo "Nope!";
        }
?>

<div style='width:500px;margin:0 auto;'>
        <form action='/challenge/php/1/index.php' method='<?=$method?>'>
                <input type='text' placeholder='administrator' name='user<?=$magic?>'/><br/><br/>
                <input type='password' value='solarwinds123' name='pass<?=$magic?>'/><br/><br/>
                <input type='hidden' value='<?=$magic?>' name='magic'/>
                <textarea name='log'>-</textarea><br/><br/>
                <input type='submit' value='hackThePlanet!'/>
        </form>
</div>
