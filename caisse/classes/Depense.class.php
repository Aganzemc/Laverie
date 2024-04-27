<!-- Depence.class.php -->
<?php 
	/**
	 * 
	 */
	class Depense extends Dbh {

		private $connect_db;
		
		function __construct() {

			$this->connect_db = $this->connect_db();
		}

		public function getDepenseCol(){

			$sql = "SHOW COLUMNS FROM depenses";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$results = $query->fetchAll();

			$fields = array();

			for ($i=0; $i < count($results) ; $i++) 
				$fields[] = $results[$i]['Field'];
			
			return $fields;
		}

		public function getDepenseAll(){

			$sql  = ("SELECT * FROM depenses ORDER BY depense_id DESC ");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getDepense(int $depense_id){

			$sql  = ("SELECT * FROM depenses WHERE depense_id = ? ");

			$query = $this->connect_db->prepare($sql);
			$query->execute([$depense_id]);
			$result = $query->fetch();

			return $result;
		}

		public function getDepenseLastId(){

			$sql  = ("SELECT depense_id FROM depenses ORDER BY depense_id DESC LIMIT 1 ");

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetch();

			return $result['depense_id'];
		}

		public function insertDepense( string $designation, int $user_id, float $montant , string $date_reg) : bool {

			$sql = ("INSERT INTO depenses (designation, user_id, montant ,date_reg) VALUES (?,?,?,?) ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$designation, $user_id, $montant, $date_reg]);
		}

		public function updateDepenseDesignation( int $depense_id, string $str){

			$sql = ("UPDATE depenses SET designation = ? WHERE depense_id = ? ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$str, $depense_id]);
		}

		public function updateDepenseMontant( int $depense_id,  $value ){

			$value = (float) $value;

			$sql = ("UPDATE depenses SET montant = ? WHERE depense_id = ? ");
			$query = $this->connect_db->prepare($sql);

			return $query->execute([$value, $depense_id]);
		}

		public function updateDepenseDate_reg( int $depense_id, string $date_reg){

			$sql = ("UPDATE depenses SET date_reg = ? WHERE depense_id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$date_reg, $depense_id]);
		}

		public function deleteDepense(int $depense_id){

			$sql = ("DELETE FROM depenses WHERE depense_id = ? ");
			$query = $this->connect_db->prepare($sql);
			
			return $query->execute([$depense_id]);
		}

		public function getOutput($depense_id){

			$sql = "SELECT montant FROM depenses WHERE depense_id = ? ";

			$query = $this->connect_db->prepare($sql);
			$query->execute([$depense_id]);
			$result = $query->fetch();

			return (float) $result['montant'];
		}

		public function getDepenseTotal(){

			$sql = "SELECT sum(montant) AS 'sum' FROM depenses";
			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetch();

			return (float) $result['sum'];
		}

		public function getDepenseMonth(){

			$sql = "

				SELECT 
					sum(montant) AS 'sum', 
					MONTH(date_reg) AS 'month', 
					YEAR(date_reg) AS 'year',
					count(depense_id) AS 'times' 
				FROM depenses 
				
				GROUP BY MONTH(date_reg),YEAR(date_reg)
				ORDER BY YEAR(date_reg) DESC
			";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}

		public function getDepenseYear(){

			$sql = "

				SELECT 
					sum(montant) AS 'sum', 
					YEAR(date_reg) AS 'year', 
					count(depense_id) AS 'count' 
				FROM depenses 
				GROUP BY YEAR(date_reg)
			";

			$query = $this->connect_db->prepare($sql);
			$query->execute();
			$result = $query->fetchAll();

			return $result;
		}
	}