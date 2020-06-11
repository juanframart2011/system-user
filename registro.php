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
					if( isset( $_POST['input'] ) ){

						$nombres	= mysqli_real_escape_string($conn,(strip_tags($_POST['nombres'], ENT_QUOTES)));
						$telefono  	= mysqli_real_escape_string($conn,(strip_tags($_POST['telefono'], ENT_QUOTES)));
						$email 		= mysqli_real_escape_string($conn,(strip_tags($_POST['email'], ENT_QUOTES)));
						$direccion  = mysqli_real_escape_string($conn,(strip_tags($_POST['direccion'], ENT_QUOTES)));
						$registrado=date("Y-m-d H:i:s");
				
						$insert = mysqli_query($conn, "INSERT INTO clientes(id, nombres, telefono, email, direccion, registrado)
																	VALUES(NULL,'$nombres', '$telefono', '$email', '$direccion', '$registrado')") or die(mysqli_error());
						if( $insert ){?>
							<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Bien hecho, los datos han sido agregados correctamente.</div>
						<?
						}
						else{?>
							<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo registrar los datos.</div>
						<?
						}
					}
					?>
    
    				<blockquote>Agregar cliente</blockquote>
                 	<form name="form1" id="form1" class="form-horizontal row-fluid" action="registro.php" method="POST" >
						<div class="control-group">
							<label class="control-label" for="nombres">Nombres</label>
							<div class="controls">
								<input type="text" name="nombres" id="nombres" placeholder="Nombres del cliente" class="form-control span8 tip" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="apellidoPaterno">Apellido Paterno</label>
							<div class="controls">
								<input type="text" name="apellidoPaterno" id="apellidoPaterno" placeholder="Apellido Paterno del cliente" class="form-control span8 tip" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="apellidoMaterno">Apellido Materno</label>
							<div class="controls">
								<input type="text" name="apellidoMaterno" id="apellidoMaterno" placeholder="Apellido Materno del cliente" class="form-control span8 tip">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="sexo">Sexo</label>
							<div class="controls">
								<select class="form-control span8 tip" name="sexo" id="sexo" required>
									<option value="">Seleccionar Sexo</option>
									<option value="masculino">Masculino</option>
									<option value="femenino">Femenino</option>
								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="fechaNacimiento">Fecha de Nacimiento</label>
							<div class="controls">
								<input type="date" name="fechaNacimiento" id="fechaNacimiento" placeholder="Fecha de Nacimiento del cliente" class="form-control span8 tip" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="Nacionalidad">Nacionalidad</label>
							<div class="controls">
								<input type="text" name="Nacionalidad" id="Nacionalidad" placeholder="Fecha de Nacimiento del cliente" class="form-control span8 tip" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="telefono">Teléfono</label>
							<div class="controls">
								<input type="text" name="telefono" id="telefono" placeholder="Teléfono del cliente" class="form-control span8 tip" required>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="email">Email</label>
							<div class="controls">
								<input name="email" id="email" class="form-control span8 tip" type="email" placeholder="Correo electrónico"  required />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="direccion">Dirección</label>
							<div class="controls">
								<input name="direccion" id="direccion" class=" form-control span8 tip" type="text" placeholder="Dirección" required />
							</div>
						</div>
                        
                      

						<div class="control-group">
							<div class="controls">
								<button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Registrar</button>
                               <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>