<div class="container is-fluid mb-6">
	<h1 class="title">Ventas</h1>
	<h2 class="subtitle">Nueva venta</h2>
</div>
<div class="container pb-6 pt-6">
	<?php
		require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/venta_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
		<div class="columns">
			<div class="column">
				<div class="control">
					<label>Nombre</label>
					<input class="input" type="text" name="nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="40" required>
				</div>
			</div>
			<div class="column">
				<div class="control">
					<label>Apellido</label>
					<input class="input" type="text" name="apellido" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="40" required>
				</div>
			</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Precio</label>
				  	<input class="input" type="text" name="precio" pattern="[0-9.]{1,25}" maxlength="25" required >
				</div>
		  	</div>
			  <div class="column">
		    	<div class="control">
					<label>Cantidad</label>
				  	<input class="input" type="text" name="cantidad" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required >
				</div>
		  	</div>
			<div class="column">
				<div class="control">
					<label>Cedula de identidad</label>
					<input class="input" type="text" id="cedula" pattern="[0-9.]{1,25}" maxlength="25" >
				</div>
			</div>
		</div>
		<p class="has-text-left">
			<button type="button" class="button is-info is-rounded" action="funcion_leer.php" onclick="">Recoger</button>
		</p>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Venta</button>
		</p>
		
	</form>
</div>