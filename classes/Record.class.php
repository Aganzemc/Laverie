<!-- Record.class.php -->
<?php 
	/**
	 * 
	 */
	class Record extends Dbh {

		private $connect_db;
		
		function __construct() {

			$this->connect_db = $this->connect_db();
		}

		public function getRecordCol(){

			$sql = "SHOW COLUMNS FROM records";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$results = $query->fetchAll();

			$fiels = array();

			for ($i=0; $i < count($results) ; $i++) 
				$fiels[] = $results[$i]['Field'];
			
			return $fiels;
		}

		public function getRecordAll(){

			$sql  = ("

					SELECT * FROM records
				");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getRecordInfo(int $record_id){

			$sql  = ("SELECT * FROM records WHERE record_id = ? ");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$record_id]);
			$result = $query->fetch();

			return $result;
		}

		public function getRecordId(){

			$sql  = ("SELECT record_id FROM records ");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getRecordRecupere(bool $enabled = true){

			$sql  = ("SELECT * FROM records WHERE recupere = ? ");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$enabled]);
			$result = $query->fetchAll();

			return $result;
		}

		public function getRecordClient(int $client_id){

			$sql = "

				SELECT * 
				FROM records
				WHERE client_id IN(

					SELECT client_id FROM records WHERE client_id = ? 

				)";

			$query = $this->connect_db->prepare($sql);
			$query->execute([$client_id]);
			$result = $query->fetchAll();

			return $result;
		}

		public function isRecupere($record_id) {

			$sql  = ("

					SELECT recupere FROM records WHERE record_id = ?
				");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$record_id]);
			$result = $query->fetch();

			return $result['recupere'] ;
		}

		public function updateRecupere($record_id){

			$sql  = ("UPDATE records SET recupere = 1 WHERE record_id = ? ");

			$query = $this->connect_db->prepare($sql);

			return $query->execute([$record_id]);
		}

		public function insertRecord( int $client_id, string $user_id, int $nombre_hab, string $date_depot, string $date_recupe ) : bool {

			$sql = ("INSERT INTO records (client_id,user_id,nombre_hab,date_depot,date_recupe) VALUES (?,?,?,?,?) ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$client_id, $user_id, $nombre_hab, $date_depot, $date_recupe]);

		}

		public function getRecordLastId(){

			$sql = "SELECT record_id FROM records ORDER BY record_id DESC LIMIT 1";
			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetch();

			return ($result['record_id'] == null) ? 1 : (int) $result['record_id'];
		}
	}