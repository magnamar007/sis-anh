<?php

	/*== Almacenando datos ==*/
    $cliente_id_del=limpiar_cadena($_GET['cliente_id_del']);

    /*== Verificando usuario ==*/
    $check_cliente=conexion();
    $check_cliente=$check_cliente->query("SELECT id_cliente FROM cliente WHERE id_cliente='$cliente_id_del'");
    
    if($check_cliente->rowCount()>1){

    	$check_ventas=conexion();
    	$check_ventas=$check_ventas->query("SELECT id_cliente FROM ventas WHERE id_cliente='$cliente_id_del' LIMIT 1");

    	if($check_ventas->rowCount()<=0){
    		
	    	$eliminar_cliente=conexion();
	    	$eliminar_cliente=$eliminar_cliente->prepare("DELETE FROM cliente WHERE id_cliente=:cliente_id_del");

	    	$eliminar_cliente->execute([":id"=>$cliente_id_del]);

	    	if($eliminar_cliente->rowCount()==1){
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡CLIENTE ELIMINADO!</strong><br>
		                Los datos del cliente se eliminaron con exito
		            </div>
		        ';
		    }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar al cliente, por favor intente nuevamente
		            </div>
		        ';
		    }
		    $eliminar_cliente=null;
    	}else{
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No podemos eliminar al cliente ya que tiene compras registradas por el
	            </div>
	        ';
    	}
    	$check_ventas=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CLIENTE que intenta eliminar no existe
            </div>
        ';
    }
    $check_cliente=null;