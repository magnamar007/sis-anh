<?php
	require_once "./php/main.php";

    $id=limpiar_cadena($_POST['client_id_up']);
?>
<div class="container is-fluid mb-6">
	
		<h1 class="title">Clientes </h1>
		<h2 class="subtitle">Actualizar cliente</h2>
	<?php ?>
</div>

<div class="container pb-6 pt-6">
	<?php

		include "./inc/btn_back.php";

        /*== Verificando usuario ==*/
    	$check_cliente=conexion();
    	$check_cliente=$check_cliente->query("SELECT * FROM clientes WHERE id_cliente='$id'");

        if($check_cliente->rowCount()>0){
        	$datos=$check_cliente->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/cliente_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="id_cliente" value="<?php echo $datos['client_id_up']; ?>" required >
		
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombres</label>
				  	<input class="input" type="text" name="nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['nombre']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Apellidos</label>
				  	<input class="input" type="text" name="apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['apellido']; ?>" >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Carnet de identidad</label>
				  	<input class="input" type="text" name="ci" pattern="[a-zA-Z0-9]{4,20}" maxlength="10" required value="<?php echo $datos['ci']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Direccion</label>
				  	<input class="input" type="text" name="direccion" maxlength="200" value="<?php echo $datos['direccion']; ?>" >
				</div>
		  	</div>
		</div>
		<br><br>
		<br>
		<br><br><br>
		<p class="has-text-centered">
			los datos del cliente se actualizaran
		</p>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_usuario=null;
	?>
</div>