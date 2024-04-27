<!-- user_offline_view.inc.php -->
<?php $user_offline = (isset($user_offline)) ? $user_offline : array();?>
<?php if (count($user_offline) > 0): ?>
	<h3>Recent Online User</h3>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>No</th>
				<th>NAME</th>
				<th>ACCESS</th>
				<th>LOGIN START</th>
				<th>LOGIN END</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1;?>
			<?php foreach ($user_offline as $offline): ?>
				<tr>
					<td><?= $i;?></td>
					<td><?= $offline['name']?></td>
					<td><?= $offline['access']?></td>
					<td><?= $offline['login_start']?></td>
					<td><?= $offline['login_end']?></td>
				</tr>
				<?php $i++;?>
			<?php endforeach ?>
		</tbody>
	</table>
<?php else: ?>
	<div class="alert alert-info">
		<p>
			Pas d' infos!
		</p>
	</div>
<?php endif ?>