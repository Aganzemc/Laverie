<?php
	//dbc.class.php
	/**
	 * Creating connection to the database
	 * 
	 */
	class Dbh {

		private $host = 'localhost';
		private $user = 'root';
		private $pw = '';
		private $db = 'laveriedb';
		private $statement;
		private $error;
		private $connect_db;

		function __construct() {
            $conn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            try {
                $this->connect_db = new PDO($conn, $this->user, $this->pw, $options);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
            return $this->connect_db;
        }

		protected function connect_db(){
			// data source name
			$dsn = 'mysql:host=' .$this->host. ';dbname=' . $this->db;
			$pdo = new PDO($dsn, $this->user, $this->pw);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			return $pdo;
		}
		//Allows us to write queries
        public function query($sql) {
            $this->statement = $this->connect_db()->prepare($sql);
        }

        //Bind values
        public function bind($parameter, $value, $type = null) {
            switch (is_null($type)) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
            $this->statement->bindValue($parameter, $value, $type);
        }

        //Execute the prepared statement
        public function execute() {
            return $this->statement->execute();
        }

        //Return an array
        public function resultSet() {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        //Return a specific row as an object
        public function single() {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        //Get's the row count
        public function rowCount() {
            return $this->statement->rowCount();
        }
	}

?>