<!-- user_info_view.inc.php -->
<?php $users = (isset($users)) ? $users : array();?>
<?php if (count($users) > 0 ):?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>NUM</th><th>NOM</th><th>ACCES</th><th>ACTIF(VE)</th><th>OPTIONS</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($users AS $row):?>
				<tr>
					<td><?= $row['id']?></td>
					<td><?= get_user_avatar($row['avatar']).' '.$row['name']?></td>
					<td><?= $row['access']?></td>
						<?php 
							if ($row['active'] == true){
								$alert = 'success';
								$active = 'Oui';
							} 
							else {
								$alert = 'danger';
								$active = 'Non';
							}
						?>
					<td class="alert alert-<?= $alert;?>">
						<?= $active;?>
					</td>
					<td>
						<a href="#" class="btn btn-info disabled">Info</a>
						<a href="<?=basename($_SERVER['SCRIPT_NAME'])?>?edit=<?= $row['id'];?>" class="btn btn-primary">Modifier</a>
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>
<?php endif;?>