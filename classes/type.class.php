<!-- type.class.php -->
<?php 
	/**
	 * 
	 */
	class Type extends Dbh {

		private $connect_db;
		
		function __construct() {

			$this->connect_db = $this->connect_db();
		}

		public function getTypeCol(){

			$sql = "SHOW COLUMNS FROM types";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$results = $query->fetchAll();

			$fiels = array();

			for ($i=0; $i < count($results) ; $i++) 
				$fiels[] = $results[$i]['Field'];
			
			return $fiels;
		}

		public function getTypeAll(){

			$sql  = ("SELECT * FROM types ");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getTypeInfo(int $type_id){

			$sql  = ("SELECT * FROM types WHERE type_id = ? ");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$type_id]);
			$result = $query->fetch();

			return $result;
		}

		public function getTypeEnabled( bool $active = true){

			$sql  = ("SELECT * FROM types WHERE type_active = ? ");

			$query = $this->connect_db->prepare( $sql );
			$query->execute([$active]);
			$result = $query->fetchAll();

			return $result;
		}

		public function typeExist(string $type_name){

			$sql = "SELECT type_name FROM types WHERE type_name = ?";
			$query = $this->connect_db->prepare($sql);
			$query->execute([$type_name]);
			$query->fetch();

			return ($query->rowCount() > 0) ? true : false;
		}

		public function insertType(string $type_name, $type_price, bool $type_active = true) : bool {

			$sql = ("INSERT INTO types ( type_name, type_price, type_active ) VALUES (?,?,?) ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$type_name, $type_price, $type_active]);
		}

		public function updateTypeName( int $type_id, string $type_name){

			$sql = ("UPDATE types SET type_name = ? WHERE type_id = ? ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$type_name, $type_id]);
		}

		public function updateTypePrice( int $type_id,  $type_price ){

			$type_price = (float) $type_price;

			$sql = ("UPDATE types SET type_price = ? WHERE type_id = ? ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$type_price, $type_id]);
		}

		public function typeIsActive(int $type_id){

			$sql = "SELECT type_active FROM types WHERE type_id = ?";
			$query = $this->connect_db->prepare($sql);
			$query->execute([$type_id]);
			$result = $query->fetch();

			return $result['type_active'];
		}

		public function updateTypeActive( int $type_id ){

			if( $this->typeIsActive( $type_id ) ) 
				$type_active = false;
			else 
				$type_active = true;

			$sql = ("UPDATE types SET type_active = ? WHERE type_id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$type_active, $type_id]);
		}

		public function updateTypeAll( int $type_id, $type_name, $type_price ){

			// $type_price = (float) $type_price;

			$sql = ("UPDATE types SET type_name = ? , type_price = ? WHERE type_id = ?  ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$type_name, $type_price, $type_id]);
		}

		public function deleteType(int $type_id){

			$sql = ("DELETE FROM types WHERE type_id = ? ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$type_id]);
		}

		public function getTypeVetement(int $record_id){

			$sql = "

				SELECT * 
				FROM types
				WHERE type_id IN(

					SELECT type_id FROM vetements WHERE record_id = ? 

				)";

			$query = $this->connect_db->prepare($sql);
			$query->execute([$record_id]);
			$result = $query->fetchAll();

			return $result;
		}
	}