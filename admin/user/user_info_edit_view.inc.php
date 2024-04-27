<!-- user_info_edit_view.inc.php -->
<?php if ( isset( $_GET['edit'] ) ): ?>
	<?php 
		$id = $_GET['edit'];
		$infoUser = $obj_admin->getUserInfo($id);

	?>
	<div class="panel panel-default" style="padding:5px;">

		<h4>Modifier l'Utilisateur : <b><?= $infoUser['name'];?></b></h4>
		<div class="panel panel-default" style="padding:3px;">
			<h5>Modifier l'avatar 
				<a href="process.admin.php?edit_avatar=<?=$id;?>">
					<?php if (file_exists("http://localhost/laverie/".$infoUser["avatar"])): ?>
						<img src="http://localhost/laverie/'<?= $infoUser["avatar"]?>" width="30" class="img-circle"/>
					<?php else: ?>
						<img src="http://localhost/laverie/images/users/img_default.jpg" width="30" class="img-circle"/>
					<?php endif ?>
				</a>
			</h5>
		</div><!-- End panel panel-default -->

		<div class="panel panel-default" style="padding:3px;">
			<h5>Modifier le Nom </h5>
			<form method="POST" action="process.admin.php">
				<input type="hidden"  name="id" value="<?= $id;?>">
				<input type="text" autocomplete="off" disabled="" name="name" value="<?= $infoUser['name'];?>">
				<input type="text" autocomplete="off" name="new_name" placeholder="Nouveau Nom">
				<input type="submit" name="edit_name" value="Appliquer">
			</form>
		</div><!-- End panel panel-default -->

		<div class="panel panel-default" style="padding:3px;">
			<form method="POST" action="process.admin.php">
				<input type="hidden"  name="id" value="<?= $id;?>">
				<label>Type de Compte </label><br>
				<input type="text" disabled="" name="" value="<?= $infoUser['access'];?>"><br>
				<select name="access">
					<option value="editor">Editeur</option>
					<option value="caisse">Caisse</option>
					<option value="admin">Admin</option>
				</select>
				<input type="submit" name="account_type" value="Appliquer">
			</form>
		</div><!-- End panel panel-default -->

		<div class="panel panel-default" style="padding:3px;">
			<form method="POST" action="process.admin.php">
				<input type="hidden"  name="id" value="<?= $id;?>">
				<label>Changer le Mot de pass : </label><br>
				<input type="password" autocomplete="off" name="pw1" placeholder="Nouveau">
				<input type="password" autocomplete="off" name="pw2" placeholder="Confirmer">
				<input type="submit" name="edit_pw" value="Appliquer">
			</form>
		</div><!-- End panel panel-default -->

		<div class="panel panel-default" style="padding:3px;">

			<?php if ($infoUser['active']): ?>
				<h5>Compte <b class="text-success">Actif</b></h5>
				<a href="process.admin.php?active=<?= $id?>" class="btn btn-warning">Desactiver</a>
			<?php else: ?>
				<h5>Compte <b class="text-danger">Non Actif</b></h5>
				<a href="process.admin.php?active=<?= $id?>" class="btn btn-success">&nbsp;&nbsp;&nbsp;Activer&nbsp;&nbsp;&nbsp;</a>
			<?php endif ?>

		</div><!-- End panel panel-default -->

		<div class="panel panel-default" style="padding:3px;">
			<div class="text-link h5">Suppression du compte</div>
			<!-- <div class="alert alert-warning">
				<p>
					<b>Note : </b> Les trois premiers compte par default de peuvent pas etre supprimés!
				</p>
			</div> -->
			<a href="process.admin.php?delete=<?= $infoUser['id']?>" title="Cette action est irreversible!" class="btn btn-danger disabled" >Supprimer</a>
		</div>
	</div>

<?php else: ?>

	<div class="panel panel-default" style="padding:5px;">
		<h4>Parametre</h4>
		<div class="panel panel-default" style="padding:3px;">
			<h5>Ajouter un Utilisateur</h5>
			<form method="POST" action="process.admin.php">
				<input type="text" name="name" autocomplete="off" placeholder="Nom">
				<input type="password" name="pw1" autocomplete="off" placeholder="Mot de passe">
				<input type="password" name="pw2" autocomplete="off" placeholder="Confirmer">
				<input type="submit" name="add_user" value="Appliquer">
			</form>
		</div>
	</div>

<?php endif ?>