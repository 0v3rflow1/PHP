<?php
class Security{

        function __construct($session=false){
                if($session==='delete')
                        unset($_SESSION["OTPP"]);
                if($session===true)
                        $_SESSION["OTPP"]=$this->encryptSecret(uniqid(hash("sha512",uniqid("ov3rflow1OTPPPayload"))),uniqid());
                $this->OTPPE=isset($_SESSION["OTPP"])?$_SESSION["OTPP"]:uniqid('corrupted');
                $this->OTPPD=isset($_SESSION["OTPP"])?$_SESSION["OTPP"]:uniqid('corrupted');
        }

        function encryptPayload($data){
                return $this->encryptSecret(json_encode($data,true),$this->OTPPE);
        }

        function decryptPayload($payload){
                        return json_decode($this->decryptSecret($payload,$this->OTPPD),true);
        }
        
        function encryptSecret($plaintext=NULL,$secret="ov3rflow1"){
            $secret=hash("sha512",$secret);
            if($plaintext!=NULL){
                $cipheR = "AES-128-CTR";
                $cipher = "aes-128-ctr";
                if (in_array($cipheR, openssl_get_cipher_methods()) || in_array($cipher, openssl_get_cipher_methods()))
                {
                    $key = $secret;
                    $ivlen = openssl_cipher_iv_length($cipher);
                    $iv = openssl_random_pseudo_bytes($ivlen);
                    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv);
                    
                    return base64_encode($iv)."|".base64_encode($ciphertext); 
                }
            }else{
                return false;
            }
        }
        
        function decryptSecret($cipherB64,$secret="ov3rflow1"){
            $secret=hash("sha512",$secret);
            $chunks=explode("|",$cipherB64);
            if( is_array($chunks) && count($chunks)===2 ){
                
                $iv=base64_decode($chunks[0]);
                $ciphertextB64=$chunks[1];
                $key=$secret;
                $cipheR = "AES-128-CTR";
                $cipher = "aes-128-ctr";
                
                if ( in_array($cipheR, openssl_get_cipher_methods()) || in_array($cipher, openssl_get_cipher_methods()))
                {
                    $ivlen = openssl_cipher_iv_length($cipher);
                    $ciphertext=base64_decode($ciphertextB64);
                    
                    $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
                    return $original_plaintext;
                }
            }else{
                return false;
            }
        }
        
}

?>
