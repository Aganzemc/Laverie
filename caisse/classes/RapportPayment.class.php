<!-- RapportPayment.class.php -->
<?php 
	class RapportPayment extends Dbh {
		
		private $connect_db;

		function __construct() {
			$this->connect_db = $this->connect_db();
		}

		public function getRapportPaymentCol(){

			$sql = "SHOW COLUMNS FROM rapport_payment";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$results = $query->fetchAll();

			$fields = array();

			for ($i=0; $i < count($results) ; $i++) 
				$fields[] = $results[$i]['Field'];
			
			return $fields;
		}

		public function getRapportPaymentAll(){

			$sql  = ("SELECT * FROM rapport_payment ");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;

		}
		public function getRapportPayment(int $rapport_payment_id){

			$sql  = ("

					SELECT * FROM rapport_payment WHERE rapport_payment_id = ?
				");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$rapport_payment_id]);
			$result = $query->fetch();

			return $result;

		}

		public function getRapportPaymentLastId(){

			$sql = "SELECT rapport_payment_id FROM rapport_payment ORDER BY rapport_payment_id DESC LIMIT 1";
			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetch();

			return ($result['rapport_payment_id'] == null) ? 0 : (int) $result['rapport_payment_id'];

		}

		public function updateRapportPaymentAll (int $rapport_payment_id, int $payment_id, float $manquant, float $excedant, string $description ) : bool {

			$sql = ("

					UPDATE rapport_payment 
					SET 
						payment_id = ? ,
						manquant = ?,
						excedant = ?,
						description = ?
					WHERE rapport_payment_id = ? 
			");

			$query = $this->connect_db->prepare($sql);

			return $query->execute([$payment_id, $manquant, $excedant, $description, $rapport_payment_id]);
		}

		public function insertRapportPayment( $payment_id, $manquant, $excedant, $description = "" ) : bool {

			$sql = ("INSERT INTO rapport_payment (payment_id, manquant, excedant, description) VALUES (?,?,?,?) ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$payment_id, $manquant, $excedant, $description]);
		}

		public function deleteRapportPayment(int $rapport_payment_id) : bool {

			$sql = ("DELETE FROM rapport_payment WHERE rapport_payment_id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$rapport_payment_id]);
		}
	}