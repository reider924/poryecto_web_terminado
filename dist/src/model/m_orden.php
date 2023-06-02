<?php

setlocale(LC_TIME, "spanish");
date_default_timezone_set('America/Bogota');

$dbm = conectar_mysql();
$error_personal = null;
$fecha_hoy = date("Y-m-d");
$fecha_hora_hoy = date("Y-m-d H:i:s"); //fecha_creacion
$formulario = variable_exterior("formulario");

$resultados = array();
$resultados_final = array();

$consulta = "";

$sql = "SELECT * FROM `lavadoras` WHERE estado = 'activo'";
$productos = $dbm->prepare($sql);
$productos->execute();

$sql = "SELECT * FROM `lavadoras` WHERE estado = 'activo'";
$productos_filtro = $dbm->prepare($sql);
$productos_filtro->execute();

if($formulario == 'delete_orden'){

    $id =  $_POST['delete_order'];

    $sql = "DELETE FROM orden WHERE id = $id";
    $query = $dbm->prepare($sql);
    $query->execute();
}



if($formulario == ''){
    $sql = "SELECT 
                o.servicio,
                o.direccion,
                o.observaciones,
                o.fecha,
                o.fecha_programacion,
                o.id,
                l.modelo
    FROM orden o
    JOIN  lavadoras l ON o.id_lavadora  = l.id
    JOIN clientes c ON o.id_cliente = c.id
    ";

    $consulta = $dbm->prepare($sql);
    $consulta->execute();

}




if ($formulario == "crear_orden") {

    $nombre = variable_exterior("nombre");
    $direccion = variable_exterior("direccion");
    $producto = variable_exterior("producto");
    $servicio = variable_exterior("servicio");
    $observacion = variable_exterior("observacion");
    $id_cliente = variable_exterior("id_cliente");
    $fecha_programacion = variable_exterior("fecha_programacion");
    

    $sql = "INSERT INTO orden(
                    id_lavadora,
                    id_cliente,
                    servicio,
                    nombre_cliente,
                    direccion,
                    observaciones,
                    fecha,
                    fecha_programacion
                )
            VALUES (
                    '$producto',
                    '$id_cliente',
                    '$servicio',
                    '$nombre',
                    '$direccion',
                    '$observacion',
                    '$fecha_hora_hoy',
                    '$fecha_programacion'
                )";
    $query = $dbm->prepare($sql);
    if ($query->execute()) {
?>
        <script type="text/javascript">
            alert("Orden generada exitosamente!!!");
        </script>
    <?php
    }
}

if ($formulario == "consultar_orden" && $formulario != "") {

    $producto = variable_exterior("producto");
    $id_usuario = $_SESSION['id_usuario'];

    $comodin = "";

    $comodin_producto = "";
    if ($producto != "") {
        $comodin_producto = " AND id_lavadora = '$producto'";
        $comodin .= $comodin_producto;
    }

    $sql = "SELECT * FROM `orden` WHERE 1=1 AND id_cliente = '$id_usuario' $comodin ";
    // var_dump($sql);
    $consulta = $dbm->prepare($sql);
    $consulta->execute();
}




?>