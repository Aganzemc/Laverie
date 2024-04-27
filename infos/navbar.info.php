<!-- navbar.inc.php -->
<?php if(!isset($_SESSION)) session_start(); ?>
<nav id="myNavbar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarCollapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="#!" class="navbar-brand" style="color: #fff;">PRESSING ET LAVERIE</a>
		</div>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="nav navbar-nav">
				<?php if ($_SESSION['logInfo']['access'] == 'editor'): ?>
					<li class="active"><a href="../home.php">HOME</a></li>
				<?php endif ?>
				<li><a href="index.php" onmouseover="javacript:getThisPage(this);" >INDEX</a></li>
				<li><a href="recuperation.info.php" onmouseover="javacript:getThisPage(this);" >RECUPERATION</a></li>
				<li><a href="depot.info.php" onmouseover="javacript:getThisPage(this);" >VETEMENT-DEPOSÉ</a> </li>
				<li><a href="Recuperer.info.php" onmouseover="javacript:getThisPage(this);" >VETEMENT-RECUPERÉ</a></li>
				<li><a href="agent.info.php" onmouseover="javacript:getThisPage(this);" >AGENT-RECEPTION</a></li>
			</ul>
			
			<?php if ($_SESSION['logInfo']['access'] == 'editor'): ?>
				<ul class="nav navbar-nav navbar-right"> 
			     	<li><a href="logout.php">LOGOUT</a></li> 
			    </ul> 
			<?php endif ?>
		</div>
	</div>
</nav>
<script type="text/javascript" src="http://localhost/laverie/libs/bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="http://localhost/laverie/libs/bootstrap/js/bootstrap.js"></script>
<style type="text/css">
	body {
		margin-top: 60px;
	}
</style>