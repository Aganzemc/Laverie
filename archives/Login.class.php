<!-- Login.class.php -->
<?php 
	/**
	 * 
	 */
	class Login extends Dbh {

		public  $login_enabled = true;
		private $connect_db;
		private $username;
		private $password;
		private $keepLog;
		private $error_messages = array(

			"username" => "Nom de l\' utilisateur n\'est pas reconnu ",
			"password" => "Mot de passe incorrect",
			"username_or_password" => "Mot de passe ou nom utilisateur incorrect"
		);
		
		function __construct(string $user = 'user', string $password = null, bool $keepLog = false) {

			$this->username = $user;
			$this->password = $password;
			$this->keepLog 	= $keepLog;

			$this->connect_db = $this->connect_db();
		}

		private function checkPassword(){

			if($this->password != null) 
				return true;
			else
				return false;
		}
		private function checkUsername(){

			if($this->username != 'user') 
				return true;
			else
				return false;
		}

		protected function loginProcess(){

			if($this->checkPassword()){
				
			}

		}

		private function insert(){

		}

		private function setSession(){

		}

		private function setError(string $message = ''){

			$msg_type = 'danger';

			if(!isset($_SESSION)) session_start();
			$_SESSION['message'] = $this->error_messages[$message];
			$_SESSION['msg_type'] = $msg_type;

		}

		public function getError(){

		}
	}