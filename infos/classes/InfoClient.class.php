<!-- InfoClient.class.php -->
<?php 
	class InfoClient extends Dbh {

		private $connect_db;
		public $obj_client;

		function __construct(){

			$this->connect_db = $this->connect_db();
			$this->obj_user = new User();
		}

		public function date_recuperation(){

			$sql = ("

				SELECT * 
				FROM 
					clients,
					records 
				WHERE 
					clients.client_id = records.client_id AND 
					records.recupere = 0 
				-- ORDER BY records.record_id DESC

			");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function depot(){

			$sql = ("

				SELECT * 
				FROM 
					clients,
					records 
				WHERE 
					clients.client_id = records.client_id AND 
					records.recupere = 0 
				ORDER BY records.date_depot

			");
			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();
			
			return $result;
		}

		public function recuperer(){

			$sql = ("

				SELECT * 
				FROM 
					clients,
					records 
				WHERE 
					clients.client_id = records.client_id AND 
					records.recupere = 1 
				ORDER BY records.date_depot

			");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();
			
			return $result;
		}

		public function vetement(int $record_id){

			$sql = ("

					SELECT *
					FROM 
						vetements
					WHERE 
						record_id = ?
			");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$record_id]);
			$result = $query->fetchAll();

			return $result;
		}

		public function get_vetement_type(int $type_id){

			$sql = ("SELECT type_name FROM types WHERE type_id = ? ");
			
			$query = $this->connect_db->prepare($sql);
			$query->execute([$type_id]);
			$result = $query->fetch();

			return $result['type_name'];
		}

		public function get_client_info(int $record_id){

			$sql = "

				SELECT * 
				FROM clients 
				WHERE client_id IN (

					SELECT client_id FROM records WHERE record_id = ?

				) ";

			$query = $this->connect_db->prepare($sql);
			$query->execute([$record_id]);
			$result = $query->fetch();

			return $result;
		}

		public function get_client_record(int $client_id){

			$sql = ("

					SELECT * 
					FROM 
						clients,
						records 
					WHERE 
						clients.client_id = ? AND 
						records.client_id = ? 

				");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$client_id, $client_id]);
			$result = $query->fetchAll();

			return $result;
		}

		public function getAgentByDate(){

			$sql = "SELECT DISTINCT DATE(date_depot) as 'date', user_id AS 'user_id' FROM records ORDER BY date_depot DESC";
			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getUserInfo( int $user_id){
			return $this->obj_user->getUserInfo( $user_id);
		}

		public function getCount( $table ){

			switch ($table) {
				case 'clients':
					$sql = "SELECT count(*) AS 'clients' FROM clients";
					$key = "clients";
					break;
				case 'records':
					$sql = "SELECT count(*) AS 'records' FROM records";
					$key = "records";
					break;
				case 'vetements':
					$sql = "SELECT SUM(vetement_num) AS 'vetements' FROM vetements";
					$key = "vetements";
					break;
				case 'types':
					$sql = "SELECT count(*) AS 'types' FROM types";
					$key = "types";
					break;
				default:
					return array();
					break;
			}

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetch();

			return $result[$key];
		}

	}
	