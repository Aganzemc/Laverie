<!-- client_search.php -->
<?php if(isset( $obj_suitRegister ) ):?>
	<div class="panel">
		<form method="POST" action="#" role="form" class="form-inline">
		    <div class="input-group">
		        <input type="search" name="search" class="form-control" placeholder="Rechercher&hellip;" required="required">
		        <span class="input-group-btn">
		            <input type="submit" class="btn btn-default" value="Go">
		        </span>
		    </div>
		</form><br>
		<?php

			if (isset($_POST['search'])) {

			    $search = $_POST['search'];
			    $search = preg_replace("#[^0-9a-z]#i"," ",$search);
			   	
			   	$search_client = $obj_suitRegister->searchClientName( $search );

			    if (count($search_client) == 0) {

			        $output = '<div class="alert alert-warning">Aucun resultat trouvé! <br> </span>';
			        echo $output;

			    }else { ?>

			        <button class="btn btn-primary launch-modal-unset-item">Afficher le resultat</button>
			        <a href="<?= basename($_SERVER['SCRIPT_NAME']);?>"  class="btn btn-default btn-xm">Refresh</a>
					<!-- modal-unset-item  -->
					<div id="modal-unset-item" class="modal fade">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
									<h4 class="modal-title">Resultat de recheche</h4>
								</div>
								<div class="modal-body">

									<div style="z-index:0;">
										<p> <span class="badge bagde-link"><?= count($search_client)?> Resultats </span> </p>
										<table class="table table-hover">
											<tr>
												<th>Nom</th>
												<th>ADRESSE</th>
												<th>DATE NAISSANCE</th>
												<th>RECORDS</th>
											</tr>
						        			<?php foreach($search_client as $result): ?>
						                    <tr>
						                    	<td><?= $result['nom'];?></td>
												<td><?= $result['adresse']; ?></td>
												<td><?= $result['date_nais']; ?></td>
												<td>
													<a href="vetement_regist.php?add_info=<?= $result['client_id'];?>" class="btn btn-info">Nouveau</a>
													<a href="client_record.php?add_info=<?= $result['client_id'];?>" class="btn btn-primary">Info</a>
												</td>
						        			</tr>
						           			 <?php endforeach ?>
						           		</table>
						        	</div>
									
								</div>
								<div class="modal-footer">
									<a href="<?= basename($_SERVER['SCRIPT_NAME'])?>" data-dismiss="modal" class="btn btn-danger">Close</a>
								</div>
							</div><!-- End .modal-content -->
						</div><!-- End .modal-dialog -->
					</div><!-- End #modal-unset-personal-info -->
			        <?php
		        }
		   		// echo "<hr>";
		   }
		?>
	</div>
<?php endif ?>
