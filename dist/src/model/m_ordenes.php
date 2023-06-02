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


if ($formulario == "crear_personal") {
    $usuario = variable_exterior("usuario");
    $contraseña = variable_exterior("contraseña");
    $numero_identificacion = variable_exterior("numero_identificacion");
    $administrador = variable_exterior("administrador");
    $nombre_completo = variable_exterior("nombre_completo");
    $correo = variable_exterior("correo");
    $direccion = variable_exterior("direccion");
    $telefono = variable_exterior("telefono");

    $validar = validar_usuario_existente($usuario, $contraseña, $numero_identificacion, $dbm);

    if ($validar == 1) {
?>
        <script type="text/javascript">
            alert("El usuario ya se encuentra creado con las credenciales diligenciadas!!");
        </script>
        <?php
    } else {

        $sql = "INSERT INTO
                    clientes(
                        identificacion,
                        usuario,
                        contraseña,
                        nombre,
                        correo,
                        direccion,
                        telefono,
                        administrador,
                        estado
                    )
                VALUES
                    (
                        '$numero_identificacion',
                        '$usuario',
                        '$contraseña',
                        '$nombre_completo',
                        '$correo',
                        '$direccion',
                        '$telefono',
                        '$administrador',
                        'activo'
                    )";
        $query = $dbm->prepare($sql);
        if ($query->execute()) {
        ?>
            <script type="text/javascript">
                alert("Usuario creado exitosamente!!!");
            </script>
        <?php
        }
    }
}

if ($formulario == "consultar_personal" && $formulario != "") {

    $numero_identificacion = variable_exterior("numero_identificacion");
    $usuario = variable_exterior("usuario");
    $nombre_completo = variable_exterior("nombre_completo");

    $comodin = "";

    $comodin_identificacion = "";
    if ($numero_identificacion != "") {
        $comodin_identificacion = " AND identificacion = '$numero_identificacion'";
        $comodin .= $comodin_identificacion;
    }

    $comodin_usuario = "";
    if ($usuario != "") {
        $comodin_usuario = " AND usuario = '$usuario'";
        $comodin .= $comodin_usuario;
    }

    $comodin_nombre_completo = "";
    if ($nombre_completo != "") {
        $comodin_nombre_completo = " AND nombre = '$nombre_completo'";
        $comodin .= $comodin_nombre_completo;
    }


    $sql = "SELECT * FROM `clientes` WHERE 1=1 $comodin";
    $consulta = $dbm->prepare($sql);
    $consulta->execute();
}

$accion = variable_exterior("accion");
$id_accion = variable_exterior("id_accion");

if ($accion != "" && $id_accion >= 1) {
    $sql = "UPDATE clientes SET estado = '" . $accion . "' WHERE id = '" . $id_accion . "' ";
    $update = $dbm->prepare($sql);
    if ($update->execute()) {
        ?>
        <script type="text/javascript">
            alert("Personal Actualizado Correctamente")
            location.href = '?url_id=gestion_personal';
        </script>
<?php
    }
}



?>