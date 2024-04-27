<!-- Admin.class.php -->
<?php 
	class Admin extends Dbh {

		private $connect_db;
		public $obj_user;
		public $obj_type;
		public $obj_loginManager;

		function __construct() {
			$this->connect_db = $this->connect_db();
			$this->obj_user = new User();
			$this->obj_type = new Type();
			$this->obj_loginManager = new LoginManager();
		}

		public function getUserAll(){
			return $this->obj_user->getUserAll();
		}

		public function getUserInfo( $user_id ){
			return $this->obj_user->getUserInfo( $user_id );
		}

		public function userIsActive( $user_id ){
			return $this->obj_user->userIsActive( $user_id );
		}

		public function updateUserActive( $user_id, $active ){
			return $this->obj_user->updateUserActive(  $user_id, $active );
		}

		public function updateUserAccess($user_id, $access){
			return $this->obj_user->updateUserAccess($user_id, $access);
		}

		public function updateUserPassword( $user_id, $password ){
			return $this->obj_user->updateUserPassword( $user_id, $password );
		}

		public function userExist( $name ){
			return $this->obj_user->userExist( $name );
		}

		public function insertUser( $name, $password ){
			return $this->obj_user->insertUser( $name, $password );
		}

		public function updateUserAvatar( $user_id, $avatar ){
			return $this->obj_user->updateUserAvatar( $user_id, $avatar );
		}

		public function updateUserName( $user_id, $new_name){
			return $this->obj_user->updateUserName( $user_id, $new_name);
		}

		public function deleteUser( $user_id ){
			return $this->obj_user->deleteUser( $user_id );
		}

		//----------------------------------------------------------------------------------

		public function getTypeAll(){
			return $this->obj_type->getTypeAll();
		}

		public function getTypeInfo( $type_id ){
			return $this->obj_type->getTypeInfo($type_id);
		}

		public function typeIsActive( $type_id ){
			return $this->obj_type->typeIsActive($type_id);
		}

		public function updateTypeAll( $type_id, $type_name, $type_price ){
			return $this->obj_type->updateTypeAll( $type_id, $type_name, $type_price );
		}

		public function updateTypeActive( $type_id ){
			return $this->obj_type->updateTypeActive( $type_id );
		}

		public function insertType( $type_name, $type_price ){
			return $this->obj_type->insertType( $type_name, $type_price );
		}
		public function typeExist( $type_name ){
			return $this->obj_type->typeExist( $type_name );
		}

		//----------------------------------------------------------------------------------

		public function getOnlineUser($limite = 10){
			return $this->obj_loginManager->getLoginUser(1,$limite);
		}
		public function getOfflineUser($limite = 2){
			return $this->obj_loginManager->getLoginUser(0,$limite);
		}
	}