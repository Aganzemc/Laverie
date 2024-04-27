<!-- crypto.class.php -->
<?php
	
	class Crypto {

		private $message;
		private $pw = 1234;
		
		
	    public function encrypt_str($string_to_encrypt,$pw='1234'){

	        return $encrypted_string=openssl_encrypt($string_to_encrypt,"AES-128-ECB",$this->pw);
	    }

	    public function decrypt_str($encrypted_string,$pw='1234'){

	        return $decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$this->pw);
	    }

	    private function sign($message, $key) {

	        return hash_hmac('sha256', $message, $key) . $message;
	    }

	    private function verify($bundle, $key) {

	        return hash_equals(
	          hash_hmac('sha256', mb_substr($bundle, 64, null, '8bit'), $key),
	          mb_substr($bundle, 0, 64, '8bit')
	        );
	    }

	    private function getKey($password, $keysize = 16) {

	        return hash_pbkdf2('sha256',$password,'some_token',100000,$keysize,true);
	    }

	    public function encryptNd($message, $password=1234) {

	        $iv = random_bytes(16);
	        $key = getKey($this->pw);
	        $result = sign(openssl_encrypt($message,'aes-256-ctr',$key,OPENSSL_RAW_DATA,$iv), $key);

	        return bin2hex($iv).bin2hex($result);
	    }

	   	public  function decryptNd($hash, $password=1234) {

	        $iv = hex2bin(substr($hash, 0, 32));
	        $data = hex2bin(substr($hash, 32));
	        $key = getKey($this->pw);

	        if (!verify($data, $key)) {
	          return null;
	        }

	        return openssl_decrypt(mb_substr($data, 64, null, '8bit'),'aes-256-ctr',$key,OPENSSL_RAW_DATA,$iv);
	    }
	}
?>