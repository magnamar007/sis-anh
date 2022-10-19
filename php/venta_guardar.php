<?php
	require_once "../inc/session_start.php";

	require_once "main.php";

	/*== Almacenando datos ==*/
	/*$id_cliente=limpiar_cadena($_POST['id_cliente']);*/
	$cantidad=limpiar_cadena($_POST['cantidad']);
	$precio=limpiar_cadena($_POST['precio']);
    $nombre=limpiar_cadena($_POST ['nombre']);
    $apellido=limpiar_cadena($_POST['apellido']);
    $ci=limpiar_cadena($_POST['ci']);
    


    $selecionar_nombre=conexion();
    $selecionar_nombre=$selecionar_nombre->query("SELECT nombre FROM cliente WHERE ci='$ci'");
    $check_nombre=conexion();
    $check_nombre=$check_nombre->query("SELECT nombre FROM cliente WHERE ci='$ci'");
    $check_nombre=null;



    /* Directorios de imagenes */
	$img_dir='../img/producto/';

    $fecha_actual = date('Y-m-D H:i:s');
	/*== Guardando datos ==*/
    $guardar_venta=conexion();
    $guardar_venta=$guardar_venta->prepare("INSERT INTO venta(id_cliente,fecha_venta,cantidad,precio,usuario_venta) VALUES(:id_cliente,:fecha,:cantidad,:precio,:usuario)");

    $marcadores=[
        ":id_cliente"=>$id_cliente,
        ":fecha"=>$fecha_actual,
        ":cantidad"=>$cantidad,
        ":precio"=>$precio,
        ":usuario"=>$selecionar_nombre
    ];

    $guardar_venta->execute($marcadores);

    if($guardar_venta->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡VENTA REGISTRADA!</strong><br>
                El producto se registro con exito
            </div>
        ';
    }else{

    	if(is_file($img_dir.$foto)){
			chmod($img_dir.$foto, 0777);
			unlink($img_dir.$foto);
        }

        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el producto, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_venta=null;