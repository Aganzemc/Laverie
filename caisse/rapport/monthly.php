<!-- monthly.php -->
<?php $monthly['capital'] = isset($monthly['capital']) ? $monthly['capital'] : array(); ?>
<?php if ( count( $monthly['capital'] ) > 0): ?>

	<div class="table-responsive">
		<h2>Rapport Mensuel <small>Caisse</small> </h2>
		<table class="table table-hover">
			<thead style="background-color:#000;color: #f4f4f4;">
				<tr>
					<th>Year</th>
					<th>Month</th>
					<th>Entrees</th>
					<th>Sorties</th>
					<th>Capital</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $monthly['capital'] as $value ): ?>
					<tr >
						<td><?= $value['year']?></td>
						<td><?= $value['month']?> &nbsp;</td>
						<td><?= $value['input']?> &nbsp;$</td>
						<td><?= $value['output']?> &nbsp;$</td>
						<td ><?= $value['capital']?> &nbsp;$</td>

						<td class="alert alert-<?= $value['msg_type']?>">
							<?= $value['precise']?>
						</td>
					</tr >
				<?php endforeach ?>
			</tbody>
		</table>
	</div>

<?php endif ?>