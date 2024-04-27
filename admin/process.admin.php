<?php
	require "../includes/connect_db.inc.php";
    require "../includes/functions.inc.php";
    require "../includes/classLoader.inc.php";

    $obj_admin = new Admin();

   date_default_timezone_set('Asia/Jerusalem');

    //-----------------------------------------------------------------
    //DISABLE A USER
    if (isset($_GET['active'])) {
      $id = $_GET['active'];
      if ($obj_admin->userIsActive($id)) {
         $update = $obj_admin->updateUserActive( $id, false );
      }else {
         $update = $obj_admin->updateUserActive( $id, true );
      }
     
        echo ("<script>history.back()</script>");
    }
    //-----------------------------------------------------------------
    //Edit account type
    if (isset($_POST['account_type'])) {

    	$user_id = $_POST['id'];
    	$access = trim($_POST['access']);

    	if ($obj_admin->updateUserAccess($user_id, $access)) {
			$_SESSION['message'] = 'Success';
			$_SESSION['msg_type'] = 'success';
		}else{
			$_SESSION['message'] = 'Failure!';
			$_SESSION['msg_type'] = 'danger';
		}
    	// header('location:admin_index.php');
        echo ("<script>history.back()</script>");
    }
    //-----------------------------------------------------------------
    //Edit password
   if (isset($_POST['edit_pw'])) {
    	if (!empty($_POST['pw1']) && !empty($_POST['pw2'])) {
    		if ($_POST['pw1'] == $_POST['pw2']){

    			$user_id = $_POST['id'];
	    		if ($obj_admin->updateUserPassword($user_id, $_POST['pw1'])) {
	    			$_SESSION['message'] = 'Success';
	    			$_SESSION['msg_type'] = 'success';
	    		}else{
	    			$_SESSION['message'] = 'Failure!';
	    			$_SESSION['msg_type'] = 'danger';
	    		}
    		}else{
    			$_SESSION['message'] = 'Mot de pass Incorrect!';
    			$_SESSION['msg_type'] = 'danger';
    		}
    	}else{
         $_SESSION['message'] = 'Veuillez completer toutes les cases!';
         $_SESSION['msg_type'] = 'danger';
      }
      echo ("<script>history.back()</script>");
   }
     //-----------------------------------------------------------------
    //Add new user
    if (isset($_POST['add_user'])) {
    	if (!empty($_POST['name']) && !empty($_POST['pw1']) && !empty($_POST['pw2'])) {
    		if ($_POST['pw1'] == $_POST['pw2']){
    			$name = $_POST['name'];
    			$pw = $_POST['pw1'];

                if(!$obj_admin->userExist( $name ) ){
                    if ($obj_admin->insertUser( $name, $pw) ) {
                        $_SESSION['message'] = 'Success';
                        $_SESSION['msg_type'] = 'success';
                    }else {
                        $_SESSION['message'] = 'Failure';
                        $_SESSION['msg_type'] = 'warning';
                    }
                }
    		}
    	}else {
    		$_SESSION['message'] = 'Veuillez completer toutes les cases!';
		    $_SESSION['msg_type'] = 'warning';
    	}
        echo ("<script>history.back()</script>");
    }
     //-----------------------------------------------------------------
    //Edit avatar
    if (isset($_GET['edit_avatar'])) {

    	$user_id = $_GET['edit_avatar'];
        $infoUser = $obj_admin->getUserInfo( $user_id );
    	$user_avatar = make_avatar($infoUser['name']);

    	if ($obj_admin->updateUserAvatar( $user_id, $user_avatar ) ) {
    		$_SESSION['message'] = 'Success';
			$_SESSION['msg_type'] = 'success';
		}else{
			$_SESSION['message'] = 'Failure!';
			$_SESSION['msg_type'] = 'danger';
		}
        echo ("<script>history.back()</script>");
    }
    //-----------------------------------------------------------------
    //Edit name
    if (isset($_POST['edit_name'])) {

    	if (!empty($_POST['id']) && !empty($_POST['new_name'])) {

	    	$user_id  = $_POST['id'];
	    	$new_name = $_POST['new_name'];
            
            if(!$obj_admin->userExist( $new_name ) ){
    	    	if ($obj_admin->updateUserName( $user_id, $new_name)) {
    		    	$_SESSION['message'] = 'Success';
    				$_SESSION['msg_type'] = 'success';
    			}else{
    				$_SESSION['message'] = 'Failure!';
    				$_SESSION['msg_type'] = 'danger';
    			}
            }
    	}
        echo ("<script>history.back()</script>");
    }
    //TISSUS
    //-----------------------------------------------------------------
    //Edit TYPE_TISSU
    if (isset($_POST['edit_tissu'])) {
    	if (!empty($_POST['id']) && !empty($_POST['new_type']) && !empty($_POST['new_price'])) {

	    	$type_id      = $_POST['id'];
	    	$type_name    = $_POST['new_type'];
	    	$type_price   = $_POST['new_price'];

	    	if ($obj_admin->updateTypeAll( $type_id, $type_name, $type_price )) {

		    	$_SESSION['message'] = 'Success';
				$_SESSION['msg_type'] = 'success';

			}else{

				$_SESSION['message'] = 'Failure!';
				$_SESSION['msg_type'] = 'danger';

			}
    	}
        echo ("<script>history.back()</script>");
    }
    //-----------------------------------------------------------------
    //DISABLE A type_tissu
    if (isset($_GET['active_hab'])) {

        $type_id = $_GET['active_hab'];
        if(!$obj_admin->updateTypeActive($type_id)) {
            $_SESSION['message'] = 'Indentifiant incorrect!';
            $_SESSION['msg_type'] = 'danger';
        }
        echo ("<script>history.back()</script>");
    }
    //-----------------------------------------------------------------
    //Add new tissu
    if ( isset( $_POST['add_type'] ) ) {
    	if (!empty( $_POST['type_name'] ) && !empty( $_POST['type_price'] ) ) {

 			$type_name  = $_POST['type_name'];
 			$type_price = $_POST['type_price'];

            if(!$obj_admin->typeExist( $type_name ) ){
     			if ($obj_admin->insertType( $type_name, $type_price ) ) {
     				$_SESSION['message'] = 'Success!';
    		    	$_SESSION['msg_type'] = 'success';
     			}else{
     				$_SESSION['message'] = 'Echec!';
    		    	$_SESSION['msg_type'] = 'danger';
     			}

            }
    	}else {
    		$_SESSION['message'] = 'Veuillez completer toutes les cases!';
		    $_SESSION['msg_type'] = 'warning';
    	}
        echo ("<script>history.back()</script>");
    }

    if (isset($_REQUEST['delete'])) {

        $user_id = $_REQUEST['delete'];

        if(!$obj_admin->deleteUser($user_id)){

            $_SESSION['message'] = 'Echec!';
            $_SESSION['msg_type'] = 'danger';
        }

        header("location: user_manager.admin.php");
    }
?>