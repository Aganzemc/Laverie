<!-- user.class.php -->
<?php 
	/**
	 * 
	 */
	class User extends Dbh {

		private $connect_db;
		
		function __construct() {

			$this->connect_db = $this->connect_db();
		}

		public function getUserCol(){

			$sql = "SHOW COLUMNS FROM users";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$results = $query->fetchAll();

			$fiels = array();

			for ($i=0; $i < count($results) ; $i++) 
				$fiels[] = $results[$i]['Field'];
			
			return $fiels;
		}

		public function getUserAll(){

			$sql  = ("SELECT * FROM users ");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getUserInfo(int $id){

			$sql  = ("SELECT * FROM users WHERE id = ? ");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$id]);
			$result = $query->fetch();

			return $result;
		}

		public function getUserEnabled( bool $active = true){

			$sql  = ("SELECT * FROM users WHERE active = ? ");

			$query = $this->connect_db->prepare( $sql );
			$query->execute([$active]);
			$result = $query->fetchAll();

			return $result;
		}

		public function userIsActive($user_id){

			$sql = "SELECT active FROM users WHERE id = ?";
			$query = $this->connect_db->prepare($sql);
			$query->execute([$user_id]);

			$result = $query->fetch();

			return (int) $result['active'];
		}

		public function insertUser(string $nom, string $password) : bool {

			$sql = "INSERT INTO users (name,password) VALUES ('$nom', PASSWORD( $password ) )";
			$query = $this->connect_db->prepare($sql);

			return $query->execute();
		}

		public function userExist(string $name){

			$sql = "SELECT name FROM users WHERE name = ?";
			$query = $this->connect_db->prepare($sql);
			$query->execute([$name]);
			$query->fetch();

			return ($query->rowCount() > 0) ? true : false;
		}

		public function updateUserName(int $user_id, string $name){

			$sql = ("UPDATE users SET name = ? WHERE id = ? ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$name, $user_id]);
		}

		public function updateUserPassword(int $user_id, string $password){

			$sql = ("UPDATE users SET password = PASSWORD($password)  WHERE id = ? ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$user_id]);
		}

		public function updateUserAvatar(int $user_id, string $avatar){

			$sql = ("UPDATE users SET avatar = ? WHERE id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$avatar, $user_id]);
		}

		public function updateUserActive(int $user_id, bool $active){

			$sql = ("UPDATE users SET active = ? WHERE id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$active, $user_id]);
		}

		public function updateUserAccess( int $user_id, string $str){

			$sql = ("UPDATE users SET access = ? WHERE id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$str, $user_id]);
		}

		public function updateUserDate_reg( int $user_id, string $str ){

			$sql = ("UPDATE users SET date_reg = ? WHERE id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$str, $user_id]);
		}

		public function deleteUser(int $user_id){

			$not_delete = array(1,2,3);

			if(!in_array($user_id, $not_delete)) {
				$sql = ("DELETE FROM users WHERE id = ? ");
				$query = $this->connect_db->prepare($sql);

				return $query->execute([$user_id]);
			}
			return false;
		}
	}