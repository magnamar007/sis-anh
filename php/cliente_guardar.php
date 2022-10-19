<?php
    
    require_once "main.php";

    /*== Almacenando datos ==*/
    $ci=limpiar_cadena($_POST['ci']);

    $nombre=limpiar_cadena($_POST['nombres']);
    $apellido=limpiar_cadena($_POST['apellidos']);

    $direccion=limpiar_cadena($_POST['direccion']);



    /*== Verificando campos obligatorios ==*/
    if($ci=="" ||$nombre=="" || $apellido=="" || $direccion==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El APELLIDO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9a-zA-Z0-9]{4,10}",$ci)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                EL NUMERO DE CEDULA no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9a-zA-Z0-9 ]{3,200}",$direccion)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                la direccion no coincide con el formato solicitado
            </div>
        ';
        exit();
    }
    
    /*== Verificando usuario ==*/
    $check_ci=conexion();
    $check_ci=$check_ci->query("SELECT ci FROM cliente WHERE ci='$ci'");
    if($check_ci->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                EL NUMERO DE CEDULA ya se encuentra registrada, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_ci=null;


    /*== Guardando datos ==*/
    $guardar_cliente=conexion();
    $guardar_cliente=$guardar_cliente->prepare("INSERT INTO cliente(ci,nombre,apellido,direccion) VALUES(:ci,:nombre,:apellido,:direccion)");

    $marcadores=[
        ":ci"=>$ci,
        ":nombre"=>$nombre,
        ":apellido"=>$apellido,
        ":direccion"=>$direccion
    ];

    $guardar_cliente->execute($marcadores);

    if($guardar_cliente->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡CLIENTE REGISTRADO!</strong><br>
                El cliente se registro con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el usuario, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_usuario=null;