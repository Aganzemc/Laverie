<!-- SuitRegister.class.php -->
<?php 
	
	class SuitRegister extends Dbh {

		public $cl_type;
		public $cl_client;
		public $cl_record;
		public $cl_vetement;
		private $connect_db;

		function __construct() {

			$this->connect_db   = $this->connect_db();
			$this->cl_type 		= new Type();
			$this->cl_client 	= new Client();
			$this->cl_record 	= new Record();
			$this->cl_vetement 	= new Vetement();
		}

		public function getClientAll(){
			return $this->cl_client->getClientAll();
		}

		public function getClientInfo( int $client_id){
			return $this->cl_client->getClientInfo( $client_id);
		}

		public function getClientLastid(){
			return $this->cl_client->getClientLastid();
		}

		public function searchClientName( $name){
			return $this->cl_client->searchClientName( $name);
		}

		public function insertClient( $name, $prenom, $address, $date_nais ){
			return $this->cl_client->insertClient( $name, $prenom, $address, $date_nais );
		}

		public function getTypeEnabled( bool $type_active ){
			return $this->cl_type->getTypeEnabled( $type_active );
		}

		public function clientExist( string $name ){
			return $this->cl_client->clientExist( $name );
		}

		public function getRecordLastId(){
			return $this->cl_record->getRecordLastId();
		}

		public function getRecordInfo( $record_id ){
			return $this->cl_record->getRecordInfo( $record_id );
		}

		public function insertRecord($client_id, $user_id, $nombre_hab, $date_depot, $date_recupe){
			return $this->cl_record->insertRecord($client_id, $user_id, $nombre_hab, $date_depot, $date_recupe);
		}

		public function insertVetement($record_id, $type_id, $vetement_num){
			return $this->cl_vetement->insertVetement($record_id, $type_id, $vetement_num);
		}

		public function getClient_Record (int $client_id, int $record_id){
			return $this->cl_client->getClient_Record ( $record_id );
		}

		public function getVetement_type(int $requette_id){

			$sql = ("

					SELECT * 
					FROM 
						vetements,
						types 
					WHERE 
						vetements.record_id = ? AND 
						vetements.type_id = types.type_id
				");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$requette_id]);
			$result = $query->fetchAll();

			return $result;
		}

		public function getClientRecord(int $client_id){

			$sql = ("

					SELECT * 
					FROM 
						clients,
						records 
					WHERE 
						clients.client_id = ? AND 
						records.client_id = ? 
					ORDER BY records.record_id DESC

				");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$client_id, $client_id]);
			$result = $query->fetchAll();

			return $result;
		}
	}
