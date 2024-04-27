<!-- total.php -->
<?php if(isset($total)): ?>
	<h2 class="page-header">Rapport General <small>Caisse</small></h2>
	<div class="row justify-content-center">
		<div class="col-md-4">
			<div class="panel panel-warning text-center">
				<div class="panel-heading"><h2 class="panel-title">ENTREES</h2></div>
				<div class="panel-body">
					<h1 class="text-warning"><?= $total['input']?>&nbsp;$</h1>
				</div>
			</div>
			
		</div>
		<div class="col-md-4">
			<div class="panel panel-danger text-center">
				<div class="panel-heading"><h2 class="panel-title">SORTIES</h2></div>
				<div class="panel-body">
					<h1 class="text-danger"><?= $total['output']?>&nbsp;$</h1>
				</div>
			</div>
			
		</div>
		<div class="col-md-4">
			<div class="panel panel-success text-center">
				<div class="panel-heading"><h2 class="panel-title">CAPITAL</h2></div>
				<div class="panel-body">
					<h1 class="text-success"><?= $total['capital']?>&nbsp;$</h1>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>