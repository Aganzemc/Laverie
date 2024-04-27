<!-- Payment.class.php -->
<?php 
	
	class Payment extends Dbh {
		
		private $connect_db;

		function __construct() {
			$this->connect_db = $this->connect_db();
		}

		public function getPaymentCol(){


			$sql = "SHOW COLUMNS FROM payments";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$results = $query->fetchAll();

			$fields = array();

			for ($i=0; $i < count($results) ; $i++) 
				$fields[] = $results[$i]['Field'];
			
			return $fields;
		}

		public function getPaymentAll(){

			$sql  = ("SELECT * FROM payments ");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getPayment(int $payment_id){

			$sql  = ("SELECT * FROM payments WHERE payment_id = ? ");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$payment_id]);
			$result = $query->fetch();

			return $result;
		}

		public function getPaymentRecord(int $record_id){

			$sql = "

				SELECT * 
				FROM payments
					WHERE record_id = ? ";

			$query = $this->connect_db->prepare($sql);
			$query->execute([$client_id]);
			$result = $query->fetch();

			return $result;
		}

		public function getPaymentLastId(){

			$sql = "SELECT payment_id FROM payments ORDER BY payment_id DESC LIMIT 1";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetch();

			return ($result['payment_id'] == null) ? 1 : (int) $result['payment_id'];
		}

		public function updatePaymentAll( float $montant, int $user_id, int $record_id, string $payment_date ){

			$sql = ("

					UPDATE payments 
					SET 
						montant = ? ,
						user_id = ?,
						record_id = ?,
						payment_date = ?
					WHERE payment_id = ? 
			");

			$query = $this->connect_db->prepare($sql);

			return $query->execute([$montant, $user_id, $record_id, $payment_date]);
		}

		public function insertPayment( float $montant, int $user_id, int $record_id, string $payment_date ) : bool {

			$sql = ("INSERT INTO payments (montant, user_id, record_id, payment_date) VALUES (?,?,?,?) ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$montant, $user_id, $record_id, $payment_date]);
		}

		public function updatePaymentMontant(int $payment_id, float $value){

			$sql = ("UPDATE payments SET montant = ? WHERE payment_id = ? ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$value, $payment_id]);
		}

		public function updatePaymentUser_id(int $payment_id, int $user_id ){

			$sql = ("UPDATE payments SET user_id = ? WHERE payment_id = ? ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$user_id, $payment_id]);
		}

		public function updatePaymentRecord_id(int $payment_id, int $record_id){

			$sql = ("UPDATE payments SET record_id = ? WHERE payment_id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$record_id, $payment_id]);
		}

		public function updatePaymentPayment_date(int $payment_id, string $payment_date){

			$sql = ("UPDATE payments SET payment_date = ? WHERE payment_id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$payment_date, $payment_id]);
		}

		public function deletePayment(int $payment_id){

			$sql = ("DELETE FROM payments WHERE payment_id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$payment_id]);
		}

		public function getPaymentTotal(){

			$sql = "SELECT sum(montant) AS 'sum' FROM payments";
			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetch();

			return (float) $result['sum'];
		}
	}