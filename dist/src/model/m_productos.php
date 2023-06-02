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

if($formulario == ''){
    $sql = "SELECT * FROM `lavadoras`";
    $consulta = $dbm->prepare($sql);
    $consulta->execute();
}

if ($formulario == "crear_producto") {

    $marca = variable_exterior("marca");
    $modelo = variable_exterior("modelo");
    $referencia = variable_exterior("referencia");

    $sql = "INSERT INTO lavadoras( marca, modelo, referencia,id_cliente,estado)
            VALUES ('$marca', '$modelo', '$referencia', '".$_SESSION['id_usuario']."','activo')";
    $query = $dbm->prepare($sql);
    if ($query->execute()) {
        $id_ultimo = $dbm->lastInsertId();
        foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {
            if ($_FILES["archivo"]["name"][$key]) {
                $filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
                $source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
                $directorio = "adjuntos/productos";
                if (!file_exists($directorio)) {
                    mkdir($directorio, 0777, true) or die("No se puede crear el directorio de extraccion");
                }
                $dir = opendir($directorio); //Abrimos el directorio de destino
                $target_path = $directorio . '/' . $id_ultimo . '.png'; //Indicamos la ruta de destino, así como el nombre del archivo
                if (move_uploaded_file($source, $target_path)) {
                } else {
?>
                    <script type="text/javascript">
                        alert("ERROR ARCHIVO")
                    </script>
        <?php
                }
                closedir($dir);
            }
        }
        ?>
        <script type="text/javascript">
            alert("Producto creado exitosamente!!!");
        </script>
    <?php

    }
}

if ($formulario == "consultar_producto" && $formulario != "") {

    $marca = variable_exterior("marca");
    $modelo = variable_exterior("modelo");
    $referencia = variable_exterior("referencia");

    $comodin = "";

    $comodin_marca = "";
    if ($marca != "") {
        $comodin_marca = " AND marca = '$marca'";
        $comodin .= $comodin_marca;
    }

    $comodin_modelo = "";
    if ($modelo != "") {
        $comodin_modelo = " AND modelo = '$modelo'";
        $comodin .= $comodin_modelo;
    }

    $comodin_referencia = "";
    if ($referencia != "") {
        $comodin_referencia = " AND referencia = '$referencia'";
        $comodin .= $comodin_referencia;
    }


    $sql = "SELECT * FROM lavadoras WHERE 1=1 $comodin";
    $consulta = $dbm->prepare($sql);
    $consulta->execute();
}

$accion = variable_exterior("accion");
$id_accion = variable_exterior("id_accion");

if ($accion != "" && $id_accion >= 1) {
    $sql = "UPDATE lavadoras SET estado = '" . $accion . "' WHERE id = '" . $id_accion . "' ";
    $update = $dbm->prepare($sql);
    if ($update->execute()) {
    ?>
        <script type="text/javascript">
            alert("Producto Actualizado Correctamente")
            location.href = '?url_id=productos';
        </script>
<?php
    }
}



?>