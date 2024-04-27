<!-- LoginManager.class.php -->
<?php 
	
	class LoginManager extends Dbh {

		private $connect_db;
		
		function __construct() {
			$this->connect_db = $this->connect_db();
		}

		public function getLoginCol(){

			$sql = "SHOW COLUMNS FROM logins";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$results = $query->fetchAll();

			$fiels = array();

			for ($i=0; $i < count($results) ; $i++) 
				$fiels[] = $results[$i]['Field'];
			
			return $fiels;
		}

		public function getLoginAll(){

			$sql  = ("SELECT * FROM logins ");
			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getLoginInfo( $identifier ){

			$sql  = ("SELECT * FROM logins WHERE login_key = $identifier OR user_id = $identifier ORDER BY login_id DESC LIMIT 1 ");
			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetch();

			return $result;
		}

		public function userIsLogin( $user_id ){

			$sql = ("SELECT login_status FROM logins WHERE user_id = ? ORDER BY login_id DESC LIMIT 1 ");
			$query = $this->connect_db->prepare($sql);
			$query->execute([$user_id]);
			$result = $query->fetch();

			return $result['login_status'];
		}

		public function getLoginUser( $status = 1, int $limit = 2){

			$sql = ("

				SELECT *
				FROM 
					logins,
					users 
				WHERE
					logins.login_status = ? AND
					users.id = logins.user_id 
				ORDER BY login_id DESC
				LIMIT $limit
			");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$status]);
			$result = $query->fetchAll();

			return $result;
		}

		public function getLoginActive( bool $status = true ){

			$sql = ("SELECT * FROM logins WHERE login_status = ? ");
			$query = $this->connect_db->prepare($sql);
			$query->execute([$status]);
			$result = $query->fetchAll();

			return $result;
		}

		public function loginKeyExist( $login_key = "" ){

			if( ($login_key == "") || (empty($login_key) ) ) {

				if(!isset($_SESSION)) {
					$this->unsetUser();
					return false;	
				}

				if(isset($_SESSION['logInfo']['loginKey'])){
					$login_key = $_SESSION['logInfo']['loginKey'];
				}
				else {
					$this->unsetUser();
					return false;
				}
			}

			$sql = "SELECT login_key FROM logins WHERE login_status = 1 AND login_key = ?";
			$query = $this->connect_db->prepare($sql);
			$query->execute([$login_key]);
			$query->fetch();

			$result = ($query->rowCount() > 0) ? true : false;
			if(!$result) $this->unsetUser();
			return $result;
		}

		private function unsetUser(){

			if(isset($_SESSION)) {
				session_unset();
				session_destroy();
			}
			header("location:http://localhost/laverie/logout.php");
		}

		public function getLoginLastid(){

			$sql  = ("SELECT login_id FROM logins ORDER BY login_id DESC LIMIT 1 ");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetch();

			return ($result['login_id'] == null) ? 1 : $result['login_id'];
		}

		public function insertLogin( $user_id, $login_key ){

            $sql = ("INSERT INTO logins ( user_id, login_key ) VALUES (?,?) ");
            $query = $this->connect_db->prepare($sql);

            return $query->execute([$user_id, $login_key]);
        }

		public function updateLogin( int $user_id, string $login_key ) {

			$sql = ("UPDATE logins SET login_end = NOW(), login_status = 0 WHERE user_id = ?  AND login_key = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$user_id, $login_key]);
		}

		public function updateLoginHard( $user_id ){

			$sql = ("UPDATE logins SET login_end = NOW(), login_status = 0 WHERE user_id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$user_id]);
		}
	}