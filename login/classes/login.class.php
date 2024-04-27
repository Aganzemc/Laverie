<?php
	//login.class.php
	/**
	 * 
	 */
	class Login Extends Dbh {

		private $name;
		private $pw;
		private $keepLog;
        private $login_key;
        private $connect_db;
        private $obj_crypto;
        private $obj_loginManager;

        public $error_messages = array();
        public $messenger;

        public static $cookieDelay = 3600; //a hour

		public function __construct(string $name, string $pw = '1234', bool $keepLog = false){

			$this->pw = $pw;
			$this->name = $name;
			$this->keepLog = $keepLog;
            $this->login_key = 'log_'.random_int(100000000, 999999999);
            $this->connect_db = $this->connect_db();
            $this->obj_crypto = new Crypto();
            $this->obj_loginManager = new LoginManager();

            $this->error_messages = array(

                'account_disabled' => ' Votre compte est desactivé!',
                'error_server' => ' erreur lors de la connection au serveur reessayer plutard !',
                'not_recognized' => 'Nom ou mot de pass non reconnus !',
                'error_session' => 'erreur lors de la creation de sesssion!'
            );
		}

		public function login(){

            $sql = "SELECT * FROM users WHERE name = :name AND password = PASSWORD(:pw)";

            $query = $this->connect_db->prepare($sql);
            $query->execute([':name' => $this->name,':pw' => $this->pw]);

            $userInfos = $query->fetch();

            if ($query->rowCount() > 0 ) {

                if ($this->checkActive($userInfos['active'])) {
                    if($this->setLogSession($userInfos)){
                        if($this->insertLogin($userInfos['id'], $this->login_key)){
                            $this->setcookie();
                            return true;
                        }else return false;
                    }else return false;
                }else return false;
                
            }else{
                $this->setError("not_recognized");
                return false;
            }
		}

        private function setcookie(){

            if ($this->keepLog) {
                
                $setName = setcookie("laverie_name",$this->obj_crypto->encrypt_str($this->name),time()+self::$cookieDelay,"/");
                $setPw = setcookie("laverie_pw",$this->obj_crypto->encrypt_str($this->pw),time()+self::$cookieDelay,"/");

            }
            return ($setName && $setPw) ? true : false;
        }

        private function checkActive($row){

            if ($row == true) return true;
            else{
                $this->setError("account_disabled");
                return false;
            } 
        }

        private function setLogSession($data){

            if(!isset($_SESSION)) session_start();

            $_SESSION['logInfo'] = array();
            $_SESSION['logInfo']['loginKey'] = $this->login_key;

            $_SESSION['logInfo']['id'] = $data['id'];
            $_SESSION['logInfo']['name']  = $data['name'];
            $_SESSION['logInfo']['pw'] = true;
            $_SESSION['logInfo']['lang']= 'en';
            $_SESSION['logInfo']['access']= $data['access'];
            $_SESSION['logInfo']['active']= $data['active'];

            $sessions = array();

            $sessions = array(

                $_SESSION['logInfo']['id'],
                $_SESSION['logInfo']['name'],
                $_SESSION['logInfo']['pw'],
                $_SESSION['logInfo']['lang'],
                $_SESSION['logInfo']['access'],
                $_SESSION['logInfo']['active']
            );
            return $this->checkSession($sessions);
        }

        private function insertLogin( $user_id, $login_key ){

            if($this->obj_loginManager->userIsLogin( $user_id ) ){

                $loginInfo = $this->obj_loginManager->getLoginInfo( $user_id );
                $login_key = $loginInfo['login_key'];
                $_SESSION['logInfo']['loginKey'] = $login_key;
                
                return true;

            }else {
                return $this->obj_loginManager->insertLogin( $user_id, $login_key );
            }
        }

        private function checkSession( array $sessions){
            foreach ($sessions as $session) {
                if (empty($session)) {
                    $this->setError("error_session");
                    return false;
                }
            }
            return true;
        }

        private function setError($error_msg){
            $this->messenger = $this->error_messages[$error_msg];
        }

        public function getError(){
            return $this->messenger;
        }
	}
?>

