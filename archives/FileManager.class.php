<?php
	/**
	 * 
	 */
	class FileManager {

		public $fileName;
		public $tempDir;
		public $objFileTemp;
		
		function __construct() {

			$this->objFileTemp = new TempFileManager();
			$this->tempDir = $this->objFileTemp::$fileTempDir;
		}

		public function crypt_data($string_to_encrypt, $password=1234){
		    return $encrypted_string=openssl_encrypt($string_to_encrypt,"AES-128-ECB",$password);
		}
		public function decrypt_data($encrypted_string, $password=1234){
		    return $decrypted_string=openssl_decrypt($encrypted_string,"AES-128-ECB",$password);
		}

		private function makeDir($dir){

			if (!is_dir($dir)) {
				mkdir($dir,"0777",true);
				return true;
			}
			return true;
		}

		public function fileRead(string $file){

			$data = null;
			$file  = fopen($file,"r");

				while (($line = fgets($file)) != false ) {

					$data[] = $line;
				}

			fclose($file);
			return $data;
		}

		public function fileReadDecrypt($file,$pw = 1234){

			$data = null;
			$exts = explode(".", $file);
			$tmpDir = $this->tempDir.basename($exts[0]."_".time().".".$exts[1]);

			copy($file, $tmpDir);

			$file = $tmpDir;

			$data = $this->fileRead($file);

			$elements = null;
			if (is_array($data)) {
				foreach($data AS  $datum){
					$elements[] = $this->decrypt_data($datum,$pw);
				}
				return $elements;
			}else {
				return $this->decrypt_data($data);
			}
		}

		public function fileCreate($file, $text){

			$text = is_array($text) ? $text : array($text);

			if (file_exists($file)) {

				$fp =  fopen($file,'a');
					foreach($text AS $datum){
						fwrite($fp, $datum."\n");
					}
				fclose($fp);

				return true;

			}else{
				file_put_contents($file, "");

				$fp =  fopen($file,'w');
					foreach($text AS $datum){
						fwrite($fp, $datum."\n");
					}
				fclose($fp);

				return true;
				
			}
		}

		public function fileCreateEncrypt($file, $text, $password = 1234){

			$names = explode(".", $file);
			$names[count($names)-1] = "crpt";

			$fileNewName = implode(".", $names);

			$file = $fileNewName;
			// $file = $file.".crpt";

			$text = is_array($text) ? $text : array($text);

			if (file_exists($file)) {

				$fp =  fopen($file,'a');
					foreach($text AS $datum){
						fwrite($fp, $this->crypt_data($datum, $password)."\n");
					}
				fclose($fp);
				return true;

			}else{
				file_put_contents($file, "");

				$fp =  fopen($file,'w');
					foreach($text AS $datum){
						fwrite($fp, $this->crypt_data($datum, $password)."\n");
					}
				fclose($fp);
				return true;
			}
		}

		public function fileDisplay($file){

			$data = $this->fileRead($file);
			if(is_array($data)){
				foreach($data as $datum){
					echo $datum."<br>";
				}

			}else echo $data;
		}

		public function fileDisplayDecrypt($file, $password = 1234){

			$data = $this->fileReadDecrypt($file, $password);
			if(is_array($data)){
				foreach($data as $datum){
					echo $datum."<br>";
				}

			}else echo $data;
		}

		
	}