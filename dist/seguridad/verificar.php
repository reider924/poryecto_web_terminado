<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>VERIFICAR | REPAIRLN</title>
	<meta name="description" content="VERIFICAR | REPAIRLN  " />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8" />
	<meta property="og:locale" content="es_ES" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="VERIFICAR | REPAIRLN" />
	<meta property="og:url" content=" " />
	<meta property="og:site_name" content="REPAIRLN" />
	<meta property="og:image" content="https://unidadso.com.co/web/wp-content/uploads/2020/06/Logo-Unidad-de-Salud-Ocupacional.png" />
	<link rel="canonical" href=" " />
	<link rel="shortcut icon" href="assets/media/logos/logo.ico" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />


	<link rel="stylesheet" href="../src/plugins/sweetalert2/dist/sweetalert2.min.css">
	<script src="../src/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>

<body>
	<?php

include "conexion.php";


	function variable_exterior($nombre)
	{
		$variable = "";

		if (isset($_POST["$nombre"]) && $_POST["$nombre"] != "") {
			$variable = $_POST["$nombre"];
		} else if (isset($_GET["$nombre"]) && $_GET["$nombre"] != "") {
			$variable = $_GET["$nombre"];
		}

		return trim($variable);
	}


	$nombre_formulario = variable_exterior("formulario");

	////////////////// procesamiento de formulario de LogIn para INTRANET
	if ($nombre_formulario == "ingreso") {

		$nit = variable_exterior("nit");
		$username = variable_exterior("username");
		$password = variable_exterior("password");

		if ($username != "" && $password  != "" && $nit  != "") {

			$dbm = conectar_mysql();
			$sql = "SELECT * FROM clientes WHERE `usuario` = '" . $username . "' AND contraseña = '" . $password . "' AND identificacion = '" . $nit . "' AND estado = 'activo'";
			$query = $dbm->prepare($sql);
			$query->execute();
			$datos = $query->fetch();

			if ($datos !== false || $datos != "") {
				$_SESSION["id_usuario"] = $datos["id"];
				$_SESSION["identificacion"] = $datos["identificacion"];
				$_SESSION["nombre"] = $datos["nombre"];
				$_SESSION["correo"] = $datos["correo"];
				$_SESSION["direccion"] = $datos["direccion"];
				$_SESSION["administrador"] = $datos["administrador"];
				?>
				<script type="text/javascript">
					location.href = '../index.php?url_id=personal';
				</script>
			<?php
			} else {
			?>
				<script type="text/javascript">
					javascript: history.back(1);
				</script>
			<?php
			}
		} else {
			?>
			<script type="text/javascript">
				javascript: history.back(1);
			</script>
	<?php

		}
	}


	?>
</body>

</html>