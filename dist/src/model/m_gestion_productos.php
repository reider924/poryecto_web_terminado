<?php

setlocale(LC_TIME, "spanish");
date_default_timezone_set('America/Bogota');

$dbm = conectar_mysql();
$error_personal = null;
$fecha_hoy = date("Y-m-d");
$fecha_hora_hoy = date("Y-m-d H:i:s"); //fecha_creacion
$formulario = variable_exterior("formulario");
$id = variable_exterior("id");

$sql = "SELECT * FROM lavadoras WHERE id= $id";
$query = $dbm->prepare($sql);
$query->execute();
$lavadora = $query->fetch();

if ($formulario == "actualizar_datos") {

    $marca = variable_exterior("marca");
    $modelo = variable_exterior("modelo");
    $referencia = variable_exterior("referencia");
    $id_cliente = $_SESSION['id_usuario'];

    $sql = "UPDATE `lavadoras`
            SET 
                `marca` = '$marca',
                `modelo` = '$modelo',
                `referencia` = '$referencia',
                `id_cliente` = '$id_cliente'
            WHERE 
                id = $id";
    $update = $dbm->prepare($sql);
    if ($update->execute()) {
?>
        <script type="text/javascript">
            alert("Producto Actualizado Correctamente")
            location.href = '?url_id=gestion_productos&id=<?php echo $id ?>';
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("ERROR!! Producto NO Actualizado")
            location.href = '?url_id=gestion_productos&id=<?php echo $id ?>';
        </script>
<?php
    }
}
