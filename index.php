<?php include "conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("head.php");?>
</head>
<body>

    <?php include( "navbar.php" );?>

    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="content">
					<?php
					if( isset( $_GET['action'] ) == 'delete' ){

						$id_delete = intval( $_GET['id'] );
						$query = mysqli_query( $conn, "SELECT * FROM clientes WHERE id='$id_delete'" );
						
						if( mysqli_num_rows( $query ) == 0 ){?>

							<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>
						<?
						}
						else{
							$delete = mysqli_query($conn, "DELETE FROM clientes WHERE id='$id_delete'");
							if( $delete ){?>

								<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  Bien hecho, los datos han sido eliminados correctamente.</div>
							<?
							}
							else{?>

								<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>
							<?
							}
						}
					}
					?>
		            <div class="panel panel-default">
		                <div class="panel-heading">
		                	<h3 class="panel-title"><i class="icon-user"></i>Lista de Usuarios</h3>
		            	</div>
						
		                <div class="panel-body">
							<div class="pull-right">
								<a href="registro.php" class="btn btn-sm btn-primary">Nuevo cliente</a>
							</div>
							<br>
							<hr>
							<table id="lookup" class="table table-bordered table-hover">  
								<thead bgcolor="#eeeeee" align="center">
									<tr>
										<th>ID</th>
										<th>Nombres</th>
										<th>Apellido Paterno</th>
										<th>Imagen</th>
										<th>Telefono</th>
										<th>Dirección</th>
										<th>Registrado</th>
										<th class="text-center"> Acciones </th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="datatables/jquery.dataTables.js"></script>
    <script src="datatables/dataTables.bootstrap.js"></script>
    <script src="scripts/main.js"></script>
</body>