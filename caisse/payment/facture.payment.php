<!-- facture.php -->
<?php if (isset($_GET['record'])):?>
	<?php
		$requette_id = $_GET['record'];
		$client_id = $infoClient['client_id'];

		$infoClient = $obj_caisse->getClient_Record($client_id, $requette_id);
		$detail = $obj_caisse->getVetementTypeRecord($requette_id);

		$ttg = 0;
	?>
	<div class="panel panel-primary">
		<div class="panel-body">
			<h2 style="font-variant: small-caps;" class="text-center">PRESSING ET LAVERIE</h2>
			<kbd>Facture</kbd>
			<blockquote>
				<p class="lean">
					Client : <b><?= $infoClient['nom']?></b> <br>
					Vetement(s) : <b><?= $infoClient['nombre_hab']?></b> <br>
					Depot : <b><?= $infoClient['date_depot']?></b> <br>
					Remise : <b><?= $infoClient['date_recupe']?></b>.<br><br>
					<small><cite>Merci de nous avoir choisi!</cite></small>
				</p>
			</blockquote>
			<?php if(count($detail) > 0 ):?>
				<p class="lean">Details </p>
				<table class="table table-hover">
					<thead>
						<tr style="background-color: #555;color: #f4f4f4;">
							<th>Type Tissu</th><th>Nombres</th><th>P.U</th><th>P.T</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($detail as $row ):?>
							<tr>
								<td><?= $row['type_name'];?></td>
								<td><?= $row['vetement_num'];?></td>
								<td><?= $row['type_price'];?>&nbsp;$</td>
								<td>
									<?= get_mult(array($row['type_price'],$row['vetement_num']));?>&nbsp;$
								</td>
							</tr>
							<?php $ttg += get_mult(array($row['type_price'],$row['vetement_num'])); ?>
						<?php endforeach;?>
					</tbody>
					<tfoot>
						<tr style="background-color: #555;color: #f4f4f4;">
							<td colspan="4">
								<b class="pull-right">Total General : <?=$ttg;?>&nbsp;$</b>
							</td>
						</tr>
					</tfoot>
				</table>
			<?php endif;?>
			<small class="pull-right">
				<p>Fait a Bukavu <?= date('d-m-y h:i',time())?></p>
			</small>
		</div>
	</div>
<?php endif ?>