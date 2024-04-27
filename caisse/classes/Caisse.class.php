<!-- Caisse.class.php -->
<?php 
	class Caisse extends Dbh{

		private $connect_db;
		public $obj_client;
		public $obj_record;
		public $obj_vetement;
		public $obj_type;
		public $obj_depense;
		public $obj_payment;
		public $obj_rapportPayment;
		public $obj_crypto;
		public $obj_loginManager;

		function __construct(){

			$this->connect_db = $this->connect_db();
			$this->obj_client = new Client();
			$this->obj_record = new Record();
			$this->obj_vetement = new Vetement();
			$this->obj_type = new Type();
			$this->obj_depense = new Depense();
			$this->obj_payment = new Payment();
			$this->obj_rapportPayment = new RapportPayment();
			$this->obj_crypto = new Crypto();
			$this->obj_loginManager = new LoginManager();
		}

		public function getRecordAll(){

			return $this->obj_record->getRecordAll();
		}

		public function getRecordRecupere( bool $enabled = true ){

			return $this->obj_record->getRecordRecupere( $enabled );
		}

		public function getClientRecord($record_id){

			return $this->obj_client->getClientRecord( $record_id );
		}

		public function getClientAll(){

			return $this->obj_client->getClientAll();
		}

		public function getVetementRecord(int $record_id){

			return $this->obj_vetement->getVetementRecord($record_id);
		}

		public function getTypeVetement(int $record_id){

			return $this->obj_type->getTypeVetement($record_id);
		}

		public function getVetementTypeRecord(int $record_id){

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
			$query->execute([$record_id]);
			$result = $query->fetchAll();

			return $result;
		}

		public function getSum($record_id){

			$data = $this->getVetementTypeRecord($record_id);
			$sum = (float) 0.0;
			$results = array();

			foreach($data AS $datum)
				$results[] = $datum['vetement_num'] * $datum['type_price'];

			foreach($results as $result)
				$sum += $result;

			return $sum;
		}

		public function getClient_Record(int $client_id, int $requette_id){

			$sql = ("
					SELECT * 
					FROM 
						clients,
						records 
					WHERE 
						clients.client_id = ? AND 
						records.client_id = ? AND 
						records.record_id = ?
				");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$client_id, $client_id, $requette_id]);
			$result = $query->fetch();

			return $result;
		}

		public function insertPayment( $montant, $user_id, $record_id, $payment_date){
			
			$insert = $this->obj_payment->insertPayment($montant, $user_id, $record_id, $payment_date);
			if($insert) {

				$this->obj_record->updateRecupere($record_id);

				$toPay = $this->getSum($record_id);
				$manquant = (float) 0.00;
				$excedant = (float) 0.00;

				if($montant > $toPay) 
					$excedant = $montant - $toPay;
				elseif ($montant < $toPay) 
					$manquant = $toPay - $montant;

				$payment_id = $this->obj_payment->getPaymentLastId();

				$rapport = $this->obj_rapportPayment->insertRapportPayment($payment_id, $manquant, $excedant);

				if(!$rapport){
					//there should be a log repport
				}
				return true;
			}
			return false;
		}


		public function getPaymentTotal(){
			return $this->obj_payment->getPaymentTotal();
		}

		public function getDepenseTotal(){
			return $this->obj_depense->getDepenseTotal();
		}

		public function getCapitalTotal(){

			$input = $this->getPaymentTotal();
			$output = $this->getDepenseTotal();

			return (float) ($input - $output);
		}

		public function getDepenseMonth(){
			return $this->obj_depense->getDepenseMonth();
		}
		public function getDepenseYear(){
			return $this->obj_depense->getDepenseYear();
		}

		public function getMonthlyDepense(){

			$sql = "

				SELECT 
					SUM(montant) AS 'output',
					MONTH(date_reg) AS 'month',
					YEAR(date_reg) AS 'year'
				FROM 
					depenses
				GROUP BY YEAR(date_reg),MONTH(date_reg)
			";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getMonthlyPayment(){

			$sql = "

				SELECT 
					SUM(montant) AS 'input',
					MONTH(payment_date) AS 'month',
					YEAR(payment_date) AS 'year'
				FROM 
					payments
				GROUP BY YEAR(payment_date),MONTH(payment_date)
			";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getMonthlyCapital(){

			$input = $this->getMonthlyPayment();
			$output = $this->getMonthlyDepense();

			define("DEFAULT_VALUE", 0.00);

			$data = array();
			$result = array();

			$counter = (count($input) > count($output)) ? count($input) : count($output) ;

			for ( $i=0; $i < $counter ; $i++ ) { 

				if(isset($input[$i]['month']) && isset($output[$i]['month']) && isset($input[$i]['year']) && isset($output[$i]['year'])){

				}elseif(!isset($input[$i]['month']) && isset($output[$i]['month']) && isset($input[$i]['year']) && isset($output[$i]['year'])){
					$input[$i]['month'] = $output[$i]['month'];
					$input[$i]['month'] = DEFAULT_VALUE;

				}elseif(isset($input[$i]['month']) && !isset($output[$i]['month']) && isset($input[$i]['year']) && isset($output[$i]['year'])){
					$output[$i]['month'] = $input[$i]['month'];
					$output[$i]['month'] = DEFAULT_VALUE;
				}elseif(isset($input[$i]['month']) && isset($output[$i]['month']) && !isset($input[$i]['year']) && isset($output[$i]['year'])){

				}elseif(isset($input[$i]['month']) && isset($output[$i]['month']) && isset($input[$i]['year']) && !isset($output[$i]['year'])){

				}
				
				if(($input[$i]['month'] == $output[$i]['month']) && ($input[$i]['year'] == $output[$i]['year']) ){

					$data[$i]['month'] 		 = $input[$i]['month'];
					$data[$i]['year'] 		 = $input[$i]['year'];
					$data[$i]['input'] 		 = $input[$i]['input'];
					$data[$i]['output'] 	 = $output[$i]['output'];

				}
				elseif ( ($input[$i]['month'] != $output[$i]['month'] ) && ( $input[$i]['year'] == $output[$i]['year'] ) ) {
					
					if ( ( $input[$i]['month'] > $output[$i]['month'] ) ) {

						$output[$i]['month'] 	= $input[$i]['month'];
						$output[$i]['montant'] 	= DEFAULT_VALUE;
						
						$data[$i]['month'] 		 = $input[$i]['month'];
						$data[$i]['year'] 		 = $input[$i]['year'];
						$data[$i]['input'] 		 = $input[$i]['input'];
						$data[$i]['output'] 	 = $output[$i]['montant'];

					}elseif ( ( $output[$i]['month'] > $input[$i]['month'] ) ) {

						$input[$i]['month'] 	= $output[$i]['month'];
						$input[$i]['montant'] 	= DEFAULT_VALUE;

						$data[$i]['month'] 		 = $output[$i]['month'];
						$data[$i]['year'] 		 = $input[$i]['year'];
						$data[$i]['input'] 		 = $input[$i]['input'];
						$data[$i]['output'] 	 = $output[$i]['output'];
					}
				}

				$data[$i]['capital']	 = $input[$i]['input'] - $output[$i]['output'];
				$data[$i]['status'] 	 = ( $input[$i]['input'] > $output[$i]['output'] ) ? 1 : 0;
				$data[$i]['precise'] 	 = ( $data[$i]['status'] ) ? "Benefice" : "Perte";
				$data[$i]['msg_type']	 = ( $data[$i]['status'] ) ? "success" : "danger";

				$result[] = $data[$i];
			}
			return $result;
		}
	}
