<!-- header.depense.php -->
<?php if(!isset($_SESSION)) session_start();?>
<div class="nav">
	<ul class="breadcrumb">
		<?php if($_SESSION['logInfo']['access'] == "caisse"):?>
			<li><a href="../index.php">Home</a></li>
		<?php endif?>
		<!-- <li><a href="index.php">Index</a></li> -->
		<li><a href="add.depense.php">Ajouter</a></li>
		<li><a href="depense.php">Depenses</a></li>
	</ul>
</div>