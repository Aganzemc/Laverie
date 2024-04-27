<!-- user_online_view.inc.php -->
<?php $user_online = (isset($user_online)) ? $user_online : array();?>
<?php if (count($user_online) > 0): ?>
	<h3>Online User <span class="badge bagde-success"><?= count($user_online)?></span></h3>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>No</th>
				<th>NAME</th>
				<th>ACCESS</th>
				<th>LOGIN START</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1;?>
			<?php foreach ($user_online as $online): ?>
				<tr>
					<td><?= $i;?></td>
					<td><?= $online['name']?></td>
					<td><?= $online['access']?></td>
					<td><?= $online['login_start']?></td>
				</tr>
				<?php $i++;?>
			<?php endforeach ?>
		</tbody>
	</table>
<?php else: ?>
	<div class="alert alert-info">
		<p>
			Aucun utilisateur enligne!
		</p>
	</div>
<?php endif ?>
