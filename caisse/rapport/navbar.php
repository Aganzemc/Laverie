<!-- header.rapport.php -->
<?php if(!isset($_SESSION)) session_start();?>
<div class="nav">
	<ul class="breadcrumb">

		<?php if ( isset( $_SESSION['logInfo']['access'] ) ):?>
			<?php if ($_SESSION['logInfo']['access'] == "caisse" ): ?>
				<li><a href="../index.php">Home</a></li>
				<li><a href="index.php">Index</a></li>
			<?php endif ?>
		<?php endif?>

	</ul>
</div>