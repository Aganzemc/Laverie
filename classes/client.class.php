<!-- client.class.php -->
<?php 
	
	class Client extends Dbh {

		private $connect_db;
		
		function __construct() {
			$this->connect_db = $this->connect_db();
		}

		public function getClientCol(){

			$sql = "SHOW COLUMNS FROM clients";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$results = $query->fetchAll();

			$fiels = array();

			for ($i=0; $i < count($results) ; $i++) 
				$fiels[] = $results[$i]['Field'];
			
			return $fiels;
		}

		public function getClientAll(){

			$sql  = ("SELECT * FROM clients ORDER BY client_id DESC ");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getClientMultiple(array $id){

			$sql  = ("SELECT * FROM clients WHERE client_id IN(?) ");

			$query = $this->connect_db->prepare($sql);
			$query->execute($id);
			$result = $query->fetchAll();

			return $result;
		}

		public function getClient(int $id){

			$sql  = ("SELECT * FROM clients WHERE client_id = ? ");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$id]);
			$result = $query->fetch();

			return $result;
		}

		public function getClientInfo( int $client_id){

			return $this->getClient($client_id);
		}

		public function clientExist(string $name){

			$sql = "SELECT nom FROM clients WHERE nom = ?";
			$query = $this->connect_db->prepare($sql);
			$query->execute([$name]);
			$query->fetch();

			return ($query->rowCount() > 0) ? true : false;
		}

		public function getClientLastid(){

			$sql  = ("SELECT client_id FROM clients ORDER BY client_id DESC LIMIT 1 ");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetch();

			return $result['client_id'];
		}

		public function searchClientName(string $name = ""){

			$sql = "SELECT * FROM clients WHERE nom LIKE '%$name%' ORDER BY nom ASC ";
			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function insertClient(string $name, string $prenom, string $address, $date_nais){

			$sql = ("INSERT INTO clients (nom,prenom,adresse,date_nais) VALUES (?,?,?,?) ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$name, $prenom, $address, $date_nais]);
		}

		public function updateClientName( int $client_id, string $name ) {

			$sql = ("UPDATE clients SET nom = ? WHERE client_id = ? ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$name, $client_id]);
		}

		public function updateClientDate( int $client_id, string $date ) {

			$sql = ("UPDATE clients SET date_nais = ? WHERE client_id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$date, $client_id]);
		}

		public function updateClientAdresse( int $client_id, string $adresse ) {

			$sql = ("UPDATE clients SET adresse = ? WHERE client_id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$adresse, $client_id]);
		}

		public function deleteClient(int $client_id){

			$sql = ("DELETE FROM clients WHERE client_id = ? ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$client_id]);
		}


		public function getClientRecord(int $record_id){

			$sql = "

				SELECT * 
				FROM clients
				WHERE client_id IN(

					SELECT client_id FROM records WHERE record_id = ? 

				)
				";

			$query = $this->connect_db->prepare($sql);
			$query->execute([$record_id]);
			$result = $query->fetch();

			return $result;
		}

		public function getClient_Record ( int $record_id){

			$sql = ("
					SELECT * 
					FROM 
						clients,
						records 
					WHERE 
						clients.client_id = records.client_id AND 
						records.record_id = ?
				");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$record_id]);
			$result = $query->fetch();

			return $result;
		}

	}