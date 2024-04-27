<?php
	
	class Access extends Dbh{

		private $access;
		private $connect_db;
		private $allAccess = array();

		function __construct(string $access = 'editor') {

			$this->access = $access;
			$this->connect_db = $this->connect_db();
			$this->allAccess = $this->getAllAccess();
			$this->setAccess();
			
		}

		private function getAllAccess(){

			$sql = "SELECT DISTINCT access FROM users";
			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$access = $query->fetchAll();

			$data = null;

			if($access){
				foreach ($access as $value) {
					$data[] = $value['access'];
				}
				return $data;
			}
			return false;
		}

		private function checkAccess(){

			if(!isset($_SESSION)) session_start();

			if (in_array($this->access, $this->allAccess))  return true;
			if (isset($_SESSION['logInfo']['access'])) {

				unset($_SESSION['logInfo']['access']);
			}
			return false;
		}

		private function setAccess(){

			switch ($this->access) {
				case 'editor':
					header('Location:http://localhost/laverie/home.php');
					break;
				case 'admin':
					header('Location:http://localhost/laverie/admin/index.admin.php');
					break;
				case 'caisse':
					header('Location:http://localhost/laverie/caisse/index.php');
					break;
				default:
					header('Location:http://localhost/laverie/index.php');
					break;
			}
		}
	}