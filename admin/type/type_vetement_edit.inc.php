<!-- type_vetement_edit.inc.php -->
<?php if (isset($_GET['edit'])): ?>

	<?php 
		$id = $type_id = $_GET['edit']; 
		$typeInfo = $obj_admin->getTypeInfo( $type_id );
	?>

	<div class="panel panel-default" style="padding:5px;">
		<h4>Modifier l'info : <b><?= $typeInfo['type_name']; ?></b></h4>

		<div class="panel panel-default" style="padding:3px;">
			<h5>Modifier</h5>
			<form method="POST" action="process.admin.php">
				<input type="hidden"  name="id" value="<?= $typeInfo['type_id']; ?>">
				<input type="text" required name="new_type" value="<?= $typeInfo['type_name']; ?>" readonly placeholder="Nouveau Nom">
					<br><br>
				<input type="number" step="any" min="0" required name="new_price" value="<?= $typeInfo['type_price']; ?>"  placeholder="Nouveau type_price">
				<input type="submit" name="edit_tissu" value="Appliquer">
			</form>
		</div><!-- End panel panel-default -->

		<div class="panel panel-default" style="padding:3px;">

			<?php if ($typeInfo['type_active']): ?>
				<h5>Type de tissu <b class="text-success">Actif</b></h5>
				<a href="process.admin.php?active_hab=<?= $id?>" class="btn btn-warning">Desactiver</a>
			<?php else: ?>
				<h5>Type de tissu <b class="text-danger">Non Actif</b></h5>
				<a href="process.admin.php?active_hab=<?= $id?>" class="btn btn-success">&nbsp;&nbsp;&nbsp;Activer&nbsp;&nbsp;&nbsp;</a>
			<?php endif ?>

		</div><!-- End panel panel-default -->

	</div>

<?php else: ?>

	<div class="panel panel-default" style="padding:5px;">
		<h4>Parametre</h4>
		<div class="panel panel-default" style="padding:3px;">
			<h5>Ajouter un Type de Vetement</h5>
			<form method="POST" action="process.admin.php">
				<input type="text" required name="type_name" placeholder="Type">
				<input type="number" required name="type_price" step="any" placeholder="type_price" step="">
				<input type="submit" name="add_type" value="Appliquer">
			</form>
		</div>
	</div>

<?php endif ?>