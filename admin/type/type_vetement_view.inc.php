<!-- type_vetement_view.inc.php -->
<?php $types = isset($types) ? $types : array(); ?>
<?php if ( count( $types ) > 0 ):?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>NUM</th><th>TYPE</th><th>PRICE</th><th>ACTIF</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach( $types as $row ):?>
				<tr>
					<td><?= $row['type_id']?></td>
					<td><?= $row['type_name']?></td>
					<td><?= $row['type_price']?>&nbsp;$</td>
						<?php 
							if ($row['type_active'] == true){
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
						<a href="<?=basename($_SERVER['SCRIPT_NAME'])?>?edit=<?= $row['type_id'];?>" class="btn btn-primary">Modifier</a>
					</td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>
<?php endif;?>