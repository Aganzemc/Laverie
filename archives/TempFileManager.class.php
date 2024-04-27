<!-- TempFileManager.class.php -->
<?php
	/**
	 * 
	 */
	class TempFileManager {
		
		public static $expTime = 600;
		public static $fileTempDir = "temp/";
		public $fileTempCount;
		public $fileTmpEscape;

		function __construct() {
			
			$this->makeDir(self::$fileTempDir);
			$this->fileTmpEscape = array (".", "..", ".svg", ".htaccess");
			$this->fileTempCount = count($this->getTempFile());
		}

		protected function dirManager(){

			$obj = new DirManager(self::$fileTempDir);
			return $obj;
		}

		private function makeDir($dir){

			if (!is_dir($dir)) {
				mkdir($dir,"0777",true);
				return true;
			}
			return true;
		}

		public function getTempFile(){

			$obj = $this->dirManager();
			return $obj->getFile();
		}

		public function deleteTemp($file){

			if (unlink($file)) return true;
			else return false;
		}

		public function autoDelete(){

			if ($this->fileTempCount > 0){
				$files = $this->getTempFile();
				foreach ($files AS $file){
					if (time() > (filectime($file) + $this::$expTime)) {
						$this->deleteTemp($file);
					}
				} 
		 	}
		}

		public function displayTemp(){

			if ($this->fileTempCount > 0){
			echo"<table class='table table-hover'>
					<caption>
						<span class='badge bagde-success'> ".$this->fileTempCount." </span> Temporary Files 
						<span class='badge bagde-success'>Delay : ".$this::$expTime."  s</span> 
					</caption>";
				echo"<thead>
						<tr>
							<th>id</th>
							<th>Name</th>
							<th>Path</th>
							<th>Size</th>
							<th>Creation</th>
							<th>Expire</th>
							<!-- <th>TimeOut</th> -->
							<th>Option</th>
						</tr>
					</thead>
					<tbody>";
						$files = $this->getTempFile(); $i= 1 ;
						foreach ($files AS $file) {
							echo"<tr>";
							echo"<td> ".$i."</td>";
							echo"<td> ".basename($file)."</td>";	
							echo"<td> ".$file."</td>";
							echo"<td> ".filesize($file). " </td>";
							echo"<td> ".date('d-m-y H:i:s',filectime($file))."</td>";
							echo"<td> ".date('d-m-y H:i:s',filectime($file) + $this::$expTime)."</td>";
							echo"<td><a href='".basename($_SERVER['PHP_SELF'])."?delete=".$file." ' class='btn btn-danger'>Delete</a></td>";
							echo"</tr>";
							$i++;
						 }
				echo"</tbody>
				</table>";
			} else {
				echo"
				<div class='alert alert-info'>
					<h3>No temporary files !!
				</div>";
			}
		}

	}