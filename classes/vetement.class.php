 <!-- vetement.class.php -->
<?php 
	class Vetement extends Dbh{

		private $connect_db;

		function __construct(){

			$this->connect_db = $this->connect_db();
		}

		public function getVetementCol(){

			$sql = "SHOW COLUMNS FROM vetements";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$results = $query->fetchAll();

			$fiels = array();

			for ($i=0; $i < count($results) ; $i++) 
				$fiels[] = $results[$i]['Field'];
			
			return $fiels;
		}

		public function getVetementAll(){

			$sql  = ("SELECT * FROM vetements ");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getVetement(int $vetement_id){

			$sql  = ("SELECT * FROM vetements WHERE vetement_id = ? ");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$vetement_id]);
			$result = $query->fetch();

			return $result;
		}

		public function getVetementRecord( int $record_id ){

			$sql = ("SELECT * FROM vetements WHERE record_id = ? ");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$record_id]);
			$result = $query->fetchAll();

			return $result;
		}

		public function insertVetement( int $record_id, int $type_id, int $vetement_num ) : bool {

			$sql = ("INSERT INTO vetements (record_id,type_id,vetement_num) VALUES (?,?,?) ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$record_id, $type_id, $vetement_num]);
		}
	}
	