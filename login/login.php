<!-- login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>LogIn</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/laverie/libs/bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
</head>

<body style="background: #000;">
    <div class="container">

        <?php
				include "../includes/functions.inc.php";

				if (isset($_COOKIE['laverie_pw']) || isset($_COOKIE['laverie_name'])) {
					$cookiePw = decrypt_str($_COOKIE['laverie_pw']);
					$cookieName = decrypt_str($_COOKIE['laverie_name']);
				}else {
					$cookiePw = '';
					$cookieName = '';
				}
			?>
        <div class="row login">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h2 class="panel-title text-center">LAVERIE<small>Login</small></h2>
                    </div>
                    <div class="panel-body">

                        <?php include "../includes/messenger.inc.php";?>

                        <form method="POST" action="<?= basename($_SERVER['SCRIPT_NAME']);?>" class="form-block"
                            role="form" id="login">
                            <h1 class="text-white text-center"></h1>
                            <div class="form-group">
                                <label class="sr-only" for="inputText">Name</label>
                                <input type="text" name="name" value="<?= $cookieName;?>" placeholder="Your name"
                                    required="required" autocomplete="off" class="form-control" id="inputText">
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="inputPassword">Password</label>
                                <input type="password" name="pw" value="<?= $cookiePw;?>" placeholder="password"
                                    required="required" autocomplete="off" class="form-control" id="inputPassword">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="login" value="Connexion"
                                    class="btn btn-primary form-control">
                            </div>
                            <div class="divider"></div>
                            <hr>
                            <p class="pull-left">
                                <input type="checkbox" size="100" name="keepLogIn"><span>&nbsp;Garder la session
                                    ouverte! </span>
                            </p><br>
                        </form>

                        <?php include "login.process.php"; ?>

                    </div><!-- End panel-body -->
                </div><!-- End panel panel-primary -->
            </div>
        </div>
    </div>
</body>

</html>