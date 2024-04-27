<!-- DirManager.class.php -->
<?php

	class DirManager {
		
		public 		$dir 		= "";
		public  	$directory 	= array();
		public 		$loadDirEnabled = true;
		public 		$fileEscape = array(".", "..", ".svg", ".htaccess");

	    function __construct(string $dir = "./"){
	    	$this->dir = is_dir($dir) ? $dir : "./";
	    }

		private function fileBasename (){

			$data = null;
			foreach($this->getFile() AS $file){
				$data[] = basename($file);
			}
			return $data;
		}

		private function checkDir(){

			if (!empty($this->dir) && is_dir($this->dir)) 
				return true;
			else 
				return false;
		}

		private function realDir(string $dir){

			$dir = (string) $dir;

			return ($dir[strlen($dir)-1] != "/") ? $dir."/" : $dir;

		}

		private function dirOpen(){

			if($this->checkDir()){
				if ($dir = opendir($this->dir)){

					$i = 0;
					$files = array();
					$dirs  = array();
					$path  = null;

					while (($file = readdir($dir)) !== false ){
						if (in_array($file, $this->fileEscape)) continue;

						$path = $this->dir."/".$file;

						if (is_dir($path))
							$dirs[] = $path;
						else
							$files[] = $path;
						$i++;
					}
					closedir($dir);

					$this->directory = $dirs;
					
					return $files;

				}else return array();
			}else return array();
		}

		public function getFile(){
			return $this->dirOpen();
		}

		public function getDir(){
			$this->dirOpen();
			return $this->directory;
		}

		public function getFileBasename(){
			return $this->fileBasename();
		}

		public function fileExist(string $file){

			if ((count($this->getFile()) > 0) && (in_array($file, $this->fileBasename())))
				return true;
			else
				return false;
		}
	}