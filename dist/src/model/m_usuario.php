<?php

setlocale(LC_TIME, "spanish");
date_default_timezone_set('America/Bogota');

$dbm = conectar_mysql();
$error_personal = null;
$fecha_hoy = date("Y-m-d");
$fecha_hora_hoy = date("Y-m-d H:i:s"); //fecha_creacion
$formulario = variable_exterior("formulario");
$id = variable_exterior("id");

$sql = "SELECT * FROM clientes WHERE id= $id";
$query = $dbm->prepare($sql);
$query->execute();
$usuario = $query->fetch();

if ($formulario == "actualizar_datos") {
    $nombre = variable_exterior("nombre");
    $identificacion = variable_exterior("identificacion");
    $direccion = variable_exterior("direccion");
    $telefono = variable_exterior("telefono");
    $correo = variable_exterior("correo");
    $usuario = variable_exterior("usuario");
    $contraseña = variable_exterior("contraseña");


    $sql = "UPDATE 
                clientes 
            SET 
                nombre = '$nombre',
                identificacion = '$identificacion',
                direccion = '$direccion',
                telefono = '$telefono',
                correo = '$correo',
                usuario = '$usuario',
                contraseña = '$contraseña'
            WHERE 
                id = $id";
    $update = $dbm->prepare($sql);
    if ($update->execute()) {
        foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {
            if ($_FILES["archivo"]["name"][$key]) {
                $filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
                $source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo
                $directorio = "adjuntos/usuarios/" . $id;
                if (!file_exists($directorio)) {
                    mkdir($directorio, 0777, true) or die("No se puede crear el directorio de extraccion");
                }

                $dir = opendir($directorio); //Abrimos el directorio de destino
                $target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo
                if (move_uploaded_file($source, $target_path)) {
                }else {
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
            alert("Personal Actualizado Correctamente")
            location.href = '?url_id=usuario&id=<?php echo $id ?>';
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("ERROR!! Personal NO Actualizado")
            location.href = '?url_id=usuario&id=<?php echo $id ?>';
        </script>
<?php
    }
}
