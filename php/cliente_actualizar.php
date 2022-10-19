<?php
	require_once "main.php";

	/*== Almacenando id ==*/
    $id=limpiar_cadena($_POST['id_cliente']);


    /*== Verificando categoria ==*/
	$check_cliente=conexion();
	$check_cliente=$check_cliente->query("SELECT * FROM cliente WHERE id_cliente='$id'");

    if($check_cliente->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La categoría no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_cliente->fetch();
    }
    $check_cliente=null;

    /*== Almacenando datos ==*/
    $nombre=limpiar_cadena($_POST['nombre']);
    $apellido=limpiar_cadena($_POST['apellido']);
    $ci=limpiar_cadena($_POST('ci'));
    $direccion=limpiar_cadena($_POST('direccion'));


    /*== Verificando campos obligatorios ==*/
    if($nombre==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if($apellido!=""){
    	if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}",$apellido)){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El APELLIDO no coincide con el formato solicitado
	            </div>
	        ';
	        exit();
	    }
    }


    /*== Verificando nombre ==*/
    if($nombre!=$datos['categoria_nombre']){
	    $check_nombre=conexion();
	    $check_nombre=$check_nombre->query("SELECT categoria_nombre FROM categoria WHERE categoria_nombre='$nombre'");
	    if($check_nombre->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El NOMBRE ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_nombre=null;
    }

    /*==verificando cedula==*/
    if($ci!=$datos['ci']){
        $check_ci=conexion();
        $check_ci=$check_ci->query("SELECT ci FROM cliente WHERE ci='$ci'");
	    if($check_ci->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La CEDULA ingresada ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_ci=null;
    }


    /*== Actualizar datos ==*/
    $actualizar_cliente=conexion();
    $actualizar_cliente=$actualizar_cliente->prepare("UPDATE cliente SET nombre=:nombre,apellido=:apellido,ci=ci,direccion=direccion WHERE id_cliente=:id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        "ci"=>$ci,
        "direccion"=>$direccion,
        ":id"=>$id
    ];

    if($actualizar_cliente->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡CLIENTE ACTUALIZADO!</strong><br>
                El cliente se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el cliente, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_cliente=null;