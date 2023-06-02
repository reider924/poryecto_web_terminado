<?php

setlocale(LC_TIME, "spanish");

date_default_timezone_set('America/Bogota');
ini_set('memory_limit', '512M');
$fecha_registro = date("Y-m-d h:i:s");
$fecha_hora_hoy = date("Y-m-d H:i:s"); //fecha_creacion
$formulario = variable_exterior("formulario");

$id_requerimientos = variable_exterior("id_requerimientos");
$dbm_unidadso = conectar_sicuso();

$sql = "SELECT * FROM requerimientos WHERE id = '" . $id_requerimientos . "' ";
$procesos = $dbm->prepare($sql);
$procesos->execute();
$requerimientos = $procesos->fetch();


$sql = "SELECT id, nombre_completo FROM personal WHERE estado = '1' AND id_procesos = '" . $_SESSION['id_procesos'] . "'";
$personal_listado = $dbm->prepare($sql);
$personal_listado->execute();

$id_procesos_enviar = $requerimientos['id_procesos'];
$nombre_proceso_correo = nombre_proceso($id_procesos_enviar, $dbm);
$nombre_tipo_requerimiento = nombre_tipo($requerimientos['id_tipo'], $dbm);
$nombre_categoria_requerimiento = nombre_categoria($requerimientos['id_requerimientos_categoria'], $dbm);
$nombre_asignado_correo = nombre_personal($requerimientos['id_personal_asignado'], $dbm);

$asunto_corr =  'SICUSO.COM - AVANCE Req. N ' .  $id_requerimientos . ' - ' . $nombre_proceso_correo . ' - ' . $nombre_tipo_requerimiento . ' - ' . $nombre_categoria_requerimiento . ' - ' . $nombre_asignado_correo;
$asunto_correo = utf8_encode($asunto_corr);
if ($formulario == "crear_requerimiento_hijo") {
	$origen = variable_exterior("origen");
	$prioridad = variable_exterior("prioridad");
	$id_requerimiento_padre = variable_exterior("id_requerimiento_padre");
	$detalle = variable_exterior("detalle");
	$id_procesos = variable_exterior("id_procesos_hijos");
	$tipo = variable_exterior("tipo_proceso_hijos");
	$categoria = variable_exterior("categoria_proceso_hijos");
	$id_personal_asignado = variable_exterior("id_personal_asignado");

	$sql = "SELECT ciudad, sede
				FROM procesos p, personal pe
				WHERE pe.id_procesos =  p.id
				AND pe.id = '" . $_SESSION['id_usuario'] . "'";
	$ciudad_sede = $dbm->prepare($sql);
	$ciudad_sede->execute();
	$requerimientos_ciudad_sede = $ciudad_sede->fetch();
	$sede =  variable_exterior('sede');
	$ciudad =  variable_exterior('ciudad');



	if ($sede != "" && $ciudad != "") {
		$sede =  variable_exterior('sede');
		$ciudad =  variable_exterior('ciudad');
	} else if ($requerimientos_ciudad_sede) {
		$sede =  $requerimientos_ciudad_sede['sede'];
		$ciudad =  $requerimientos_ciudad_sede['ciudad'];
	} else {
		$sede =  " ";
		$ciudad =  " ";
	}


	if ($id_procesos >= 1 && $prioridad != "" && $detalle != "") {

		$fecha_solicitado = date("Y-m-d h:i:s");

		if ($id_personal_asignado != "") {
			$data = [
				'id_procesos' => $id_procesos,
				'id_tipo' => $tipo,
				'detalle' => $detalle,
				'prioridad' => $prioridad,
				'id_requerimiento_padre' => $id_requerimiento_padre,
				'fecha_solicitado' => $fecha_solicitado,
				'id_personal_solicitado' => $_SESSION["id_usuario"],
				'origen' => $origen,
				'categoria' => $categoria,
				'sede' => $sede,
				'ciudad' => $ciudad,
				'email_cliente' => $_SESSION["email"],
				'fecha_aperturado' => $fecha_hora_hoy,
				'id_personal_aperturado' => $_SESSION["id_usuario"],
				'fecha_asignado' => $fecha_hora_hoy,
				'id_personal_asignado' => $id_personal_asignado,
				'detalle_asignado' => "Requerimiento Hijo Asignado Directamente",
				'estado' => "ASIGNADO",
			];
		} else {
			$data = [
				'id_procesos' => $id_procesos,
				'id_tipo' => $tipo,
				'detalle' => $detalle,
				'prioridad' => $prioridad,
				'id_requerimiento_padre' => $id_requerimiento_padre,
				'estado' => "SOLICITADO",
				'fecha_solicitado' => $fecha_solicitado,
				'id_personal_solicitado' => $_SESSION["id_usuario"],
				'origen' => $origen,
				'categoria' => $categoria,
				'sede' => $sede,
				'ciudad' => $ciudad,
				'email_cliente' => $_SESSION["email"],
				'fecha_aperturado' => "",
				'id_personal_aperturado' => "",
				'fecha_asignado' => "",
				'id_personal_asignado' => "",
				'detalle_asignado' => "",
			];
		}



		$sql = "INSERT INTO
                    requerimientos(
                        id_procesos,
                        id_tipo,
                        detalle,
                        prioridad,
                        id_requerimiento_padre,
                        estado,
                        fecha_solicitado,
                        id_personal_solicitado,
                        origen,
                        id_requerimientos_categoria,
                        sede,
                        ciudad,
                        email_cliente,
						fecha_aperturado,
						id_personal_aperturado,
						fecha_asignado,
						id_personal_asignado,
						detalle_asignado
                    )
                VALUES
                    (
                        :id_procesos,
                        :id_tipo,
                        :detalle,
                        :prioridad,
                        :id_requerimiento_padre,
                        :estado,
                        :fecha_solicitado,
                        :id_personal_solicitado,
                        :origen,
                        :categoria,
                        :sede,
                        :ciudad,
                        :email_cliente,
						:fecha_aperturado,
						:id_personal_aperturado,
						:fecha_asignado,
						:id_personal_asignado,
						:detalle_asignado
                    )";
		$query = $dbm->prepare($sql);

		if ($query->execute($data)) {
			$id_ultimo_requerimiento = $dbm->lastInsertId();

			if ($id_personal_asignado == "") {
				$data = [
					'id_requerimientos' => $id_ultimo_requerimiento,
					'tipo' => "Creación Requerimiento",
					'fecha' => $fecha_solicitado,
					'detalle' => "Se realiza la radicacion del Nuevo requerimiento con ID°" . $id_ultimo_requerimiento,
					'id_personal' => $_SESSION["id_usuario"],
					'icono' => "flaticon2-shield text-",
					'color' => "danger",

				];
				$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
				$query = $dbm->prepare($sql);
				$query->execute($data);
			} else {
				$data = [
					'id_requerimientos' => $id_ultimo_requerimiento,
					'tipo' => "Creación Requerimiento",
					'fecha' => $fecha_solicitado,
					'detalle' => "Se realiza la radicacion del Nuevo requerimiento con ID°" . $id_ultimo_requerimiento,
					'id_personal' => $_SESSION["id_usuario"],
					'icono' => "flaticon2-shield text-",
					'color' => "danger",
				];
				$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
				$query = $dbm->prepare($sql);
				if ($query->execute($data)) {
					$data = [
						'id_requerimientos' => $id_ultimo_requerimiento,
						'tipo' => "Asignacion de requerimiendo por el modulo de requerimiento hijo",
						'fecha' => $fecha_solicitado,
						'detalle' => "Se realiza la asignacion del requerimiento con ID°" . $id_ultimo_requerimiento,
						'id_personal' => $id_personal_asignado,
						'icono' => "flaticon2-shield text-",
						'color' => "danger",
					];
					$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
					$query = $dbm->prepare($sql);
					if ($query->execute($data)) {
?><script type="text/javascript">
							alert("Datos guardados con exito!!")
						</script><?php
								}
							}
						}


						//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
						foreach ($_FILES["archivo_hijos"]['tmp_name'] as $key => $tmp_name) {
							//Validamos que el archivo exista
							if ($_FILES["archivo_hijos"]["name"][$key]) {
								$filename = $_FILES["archivo_hijos"]["name"][$key]; //Obtenemos el nombre original del archivo
								$source = $_FILES["archivo_hijos"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo

								$directorio = "adjuntos/requerimientos/" . $id_ultimo_requerimiento;

								//Validamos si la ruta de destino existe, en caso de no existir la creamos
								if (!file_exists($directorio)) {
									mkdir($directorio, 0777, true) or die("No se puede crear el directorio de extraccion");
								}

								$dir = opendir($directorio); //Abrimos el directorio de destino
								$target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo
								if (move_uploaded_file($source, $target_path)) {
									//echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
									$data = [
										'id_requerimientos' => $id_ultimo_requerimiento,
										'tipo' => "Nuevo Archivo Adjunto",
										'fecha' => $fecha_solicitado,
										'detalle' => "Se adjunta archivo con nombre " . $filename . " como soporte para el requerimiento con ID°" . $id_ultimo_requerimiento,
										'id_personal' => $_SESSION["id_usuario"],
										'icono' => "flaticon2-download-1 text-",
										'color' => "primary",
									];
									$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
									$query = $dbm->prepare($sql);
									$query->execute($data);
									?>
						<script type="text/javascript">
							alert("Se crea satisfactoriamente el Requerimiento ID° <?php echo $id_ultimo_requerimiento ?>");
							location.href = '?url_id=requerimientos_detalle&id_requerimientos=<?php echo $id_ultimo_requerimiento ?>';
						</script>
			<?php
								}
								closedir($dir);
							}
						}
					} else {
			?><script type="text/javascript">
				alert("error al insertar ")
			</script><?php
					}

					$query = NULL;
				} else {
						?><script type="text/javascript">
			alert("no se pudo crear el requerimiento, por favor diligencia el formulario correctamente")
		</script><?php
				}
			}


			$sql = "SELECT email_cliente,id_personal_asignado,id_personal_solicitado,id_procesos FROM requerimientos WHERE id = '" . $id_requerimientos . "' ";
			$procesos2 = $dbm->prepare($sql);
			$procesos2->execute();
			$email_cliente_bd = $procesos2->fetch();

			if ($email_cliente_bd[0] != "" || $email_cliente_bd[0] != null) {
				$email_cliente_bd[0] = $email_cliente_bd[0];
			} else {
				$email_cliente_bd[0] = "";
			}
			$sql = "SELECT ciudad,sede FROM procesos WHERE id_personal = '" . $_SESSION["id_usuario"] . "'";
			$ciudad_sede = $dbm->prepare($sql);
			$ciudad_sede->execute();
			$req_ciudad_sede = $ciudad_sede->fetch();

			$sql = "SELECT * FROM `intranet_uso`.`requerimientos_bitacora` WHERE `id_requerimientos` = '" . $id_requerimientos . "' ORDER BY fecha DESC";
			$requerimientos_bitacora_seguimiento = $dbm->prepare($sql);
			$requerimientos_bitacora_seguimiento->execute();

			$sql = "SELECT personal.nombre_completo, procesos.nombre  as nombre_proceso ,cargos.nombre as nombre_cargo,
					requerimientos.empresa as nombre_empresa, requerimientos.id_requerimiento_padre
					FROM requerimientos, personal ,procesos, cargos
					WHERE requerimientos.id = '" . $id_requerimientos . "'
					AND personal.id = requerimientos.id_personal_solicitado
					AND procesos.id = personal.id_procesos
					AND cargos.id = personal.id_cargos";
			$datos_requerimiento_personal = $dbm->prepare($sql);
			$datos_requerimiento_personal->execute();
			$datos_requerimiento_personal_total = $datos_requerimiento_personal->fetch();

			if ($formulario == "actualizar_email_alterno") {
				$email_alterno = variable_exterior("email_alterno");
				$id_requerimientos = variable_exterior("id_requerimientos");
				$sql = "UPDATE requerimientos SET 
		email_alterno = '$email_alterno'
		WHERE id = $id_requerimientos";

				$query = $dbm->prepare($sql);
				if ($query->execute()) {
					?>
		<script type="text/javascript">
			alert("Se realiza la radicacion de la nueva orden con OS-°<? echo $id_ultimo ?>");
			location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
		</script>
	<?php
				} else {
	?>
		<script type="text/javascript">
			alert("Error ")
		</script>
		<?php
				}
			}
			$id_requerimiento_padre = "";
			if ($datos_requerimiento_personal_total) {

				$nombre_cargo = $datos_requerimiento_personal_total['nombre_cargo'];
				$nombre_proceso = $datos_requerimiento_personal_total['nombre_proceso'];
				$nombre_empresa = $datos_requerimiento_personal_total['nombre_empresa'];
				$id_requerimiento_padre = $datos_requerimiento_personal_total['id_requerimiento_padre'];
				// var_dump($datos_requerimiento_personal_total);

				if ($id_requerimiento_padre != 0) {
					$id_requerimiento_padre = $datos_requerimiento_personal_total['id_requerimiento_padre'];
				} else {
					$id_requerimiento_padre = "Requerimiento Actual";
				}


				if ($nombre_cargo != null || !isset($nombre_cargo) || !empty($nombre_cargo) || $nombre_cargo != false) {
					$nombre_cargo = $datos_requerimiento_personal_total['nombre_cargo'];
				} else {
					$nombre_cargo = " ";
				}

				if ($nombre_proceso != null || !isset($nombre_proceso) || !empty($nombre_proceso) || $nombre_proceso != "") {
					$nombre_proceso = $datos_requerimiento_personal_total['nombre_proceso'];
				} else {
					$nombre_proceso = " ";
				}

				if ($nombre_empresa != null || !isset($nombre_empresa) || !empty($nombre_empresa) || $nombre_empresa != "") {
					$nombre_empresa = $datos_requerimiento_personal_total['nombre_empresa'];
				} else {
					$nombre_empresa = " ";
				}
			} else {
				$nombre_empresa = " ";
				$nombre_proceso = " ";
				$nombre_cargo = " ";
				$id_requerimiento_padre = "Requerimiento Actual";
			}

			if ($formulario == "crear_bitacora") {
				$id_requerimientos_bitacora_tipo = variable_exterior("id_requerimientos_bitacora_tipo");
				$categoria_bitacora = variable_exterior('categoria_bitacora');
				$observaciones = variable_exterior('observaciones');
				$id_requerimientos = variable_exterior('id_requerimientos');
				$id_procesos = variable_exterior("id_procesos");
				// $id_requerimientos_bitacora_tipo_nombre = "";
				// $requerimientos_bitacora_tipo_nombre_total = "";


				$avance = "Avance";
				$sql = "SELECT nombre FROM requerimientos_bitacora_tipo WHERE `estado` = 'A' AND id = '" . $id_requerimientos_bitacora_tipo . "'";

				$requerimientos_bitacora_tipo = $dbm->prepare($sql);
				$requerimientos_bitacora_tipo->execute();
				$requerimientos_bitacora_tipo_total = $requerimientos_bitacora_tipo->fetch();
				$id_requerimientos_bitacora_tipo_nombre = $requerimientos_bitacora_tipo_total['nombre'];

				$sql = "SELECT nombre FROM requerimientos_bitacora_categoria WHERE `id` = '" . $categoria_bitacora . "'";

				$requerimientos_bitacora_tipo_nombre = $dbm->prepare($sql);
				$requerimientos_bitacora_tipo_nombre->execute();
				$requerimientos_bitacora_tipo_nombre_total = $requerimientos_bitacora_tipo_nombre->fetch();
				$detalle = $categoria_bitacora;
				$data = [
					'id_requerimientos' => $id_requerimientos,
					'tipo' => $id_requerimientos_bitacora_tipo_nombre,
					'detalle' => $detalle,
					'fecha' => $fecha_registro,
					'id_personal' => $_SESSION["id_usuario"],
					'icono' => "flaticon2-chat text-",
					'color' => "success",
					'observacion' => $observaciones,
				];

				$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color,observacion) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color,:observacion)";
				$query = $dbm->prepare($sql);
				if ($query->execute($data)) {
					$id_ultimo_bitacora = $dbm->lastInsertId();
					if ($_FILES["archivo_bitacora"]['tmp_name'][0] != "") {

						foreach ($_FILES["archivo_bitacora"]['tmp_name'] as $key => $tmp_name) {
							//Validamos que el archivo exista
							if ($_FILES["archivo_bitacora"]["name"][$key]) {
								$filename = $_FILES["archivo_bitacora"]["name"][$key]; //Obtenemos el nombre original del archivo
								$source = $_FILES["archivo_bitacora"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo

								$directorio = "adjuntos/requerimientos/" . $id_requerimientos;

								//Validamos si la ruta de destino existe, en caso de no existir la creamos
								if (!file_exists($directorio)) {
									mkdir($directorio, 0777, true) or die("No se puede crear el directorio de extraccion");
								}

								$dir = opendir($directorio); //Abrimos el directorio de destino
								$target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo
								if (move_uploaded_file($source, $target_path)) {

									$target_path = "'" . $target_path . "'";
									$nombre_ventana = "'Documento Adjunto'";
									$tamaño_ventana = "'width=500px,height=700px'";
									$link_file_bitacora = '<a href="javascript: void(0)" onClick="window.open(' . $target_path . ',' . $nombre_ventana . ', ' . $tamaño_ventana . ')" class="text-dark-75 font-weight-bold mt-15 font-size-lg">	
																					' . $filename . '
																				</a>';

									//echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
									$data = [
										'id_requerimientos' => $id_requerimientos,
										'tipo' => "Nuevo Archivo Adjunto",
										'fecha' => $fecha_registro,
										'detalle' => "Se adjunta archivo con nombre " . $link_file_bitacora . " como evidencia de avance para el requerimiento con ID°" . $id_requerimientos,
										'id_personal' => $_SESSION["id_usuario"],
										'icono' => "flaticon2-download-1 text-",
										'color' => "primary",
									];
									$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
									$query = $dbm->prepare($sql);
									$query->execute($data);
								}
								closedir($dir);
							}
						}
						$data = [
							'id' => $id_ultimo_bitacora,
							'detalle' => $id_requerimientos_bitacora_tipo_nombre . ' -> ' . $requerimientos_bitacora_tipo_nombre_total['nombre'] . ' -> ' . $observaciones . ' -> Adjunto : ' . $link_file_bitacora . ' ',
						];
						$ruta1 = 'https://sicuso.unidadso.com.co/dist/adjuntos/requerimientos/' . $id_requerimientos . '/' . $filename;
						$ruta2 = '<a href="' . $ruta1 . '">' . $filename . '</a>';
						$detalle = $id_requerimientos_bitacora_tipo_nombre . ' -> ' . $requerimientos_bitacora_tipo_nombre_total['nombre'] . ' -> ' . $observaciones . ' -> Adjunto : ' . $ruta2;
					} else {
						$data = [
							'id' => $id_ultimo_bitacora,
							'detalle' => $id_requerimientos_bitacora_tipo_nombre . ' -> ' . $requerimientos_bitacora_tipo_nombre_total['nombre'] . ' -> ' . $observaciones,
						];
						$detalle = $id_requerimientos_bitacora_tipo_nombre . ' -> ' . $requerimientos_bitacora_tipo_nombre_total['nombre'] . ' -> ' . $observaciones;
					}

					$sql = "UPDATE
								requerimientos_bitacora
							SET
								detalle = :detalle
							WHERE
								id = :id";
					$query = $dbm->prepare($sql);

					if ($query->execute($data)) {
						$check_proveedor = variable_exterior("check_correo_proveedor");
						$check_cliente = variable_exterior("check_correo_cliente");
						$check_alterno = variable_exterior("check_correo_alterno");
						$correo = "";
						if ($check_proveedor == "si") {
							$correo .= variable_exterior("correo_proveedor") . ';';
						}
						if ($check_cliente == "si") {
							$correo .= variable_exterior("correo_cliente") . ';';
						}
						if ($check_alterno == "si") {
							$correo .= variable_exterior("correo_alterno");
						}

						$array = explode(";", $correo);
						for ($i = 0; $i < count($array); $i++) {
							// echo $array[$i];
							enviar_email_novedad_requerimiento_bitacora($id_requerimientos, $array[$i], $detalle, $dbm, $id_procesos_enviar, $asunto_correo);
						}

		?>
			<script type="text/javascript">
				alert("Datos insertados")
				location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
			</script>
		<?php
					}
				} else {
		?>
		<script type="text/javascript">
			alert("ERROR: Datos no insertados")
			location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
		</script>
	<?php
				}
			}

			if ($formulario == "actualizar_requerimiento_terceros") {
				$empresa = variable_exterior("empresa");
				$empresa_contacto = variable_exterior("empresa_contacto");
				$paciente = variable_exterior("paciente");
				$paciente_identificacion = variable_exterior("paciente_identificacion");
				$cantidad = variable_exterior("cantidad");


				$data = [
					'empresa' => $empresa,
					'empresa_contacto' => $empresa_contacto,
					'paciente' => $paciente,
					'paciente_identificacion' => $paciente_identificacion,
					'cantidad' => $cantidad,
					'id_requerimientos' => $id_requerimientos,

				];

				$sql = "UPDATE `requerimientos` SET 
	        empresa = :empresa, 
	        empresa_contacto = :empresa_contacto, 
	        paciente = :paciente, 
	        paciente_identificacion = :paciente_identificacion,
	        cantidad = :cantidad
	        WHERE id = :id_requerimientos";
				$query = $dbm->prepare($sql);
				if ($query->execute($data)) {

	?><script type="text/javascript">
			alert("Datos Actualizados!")
			location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
		</script><?php
				} else {
					?><script type="text/javascript">
			alert("ERROR: Datos actualizar <? echo $sql ?> ")
			location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
		</script><?php
				}
			}

			if ($formulario == "cargue_anexos") {
				foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {
					//Validamos que el archivo exista
					if ($_FILES["archivo"]["name"][$key]) {
						$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
						$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo

						$directorio = "adjuntos/requerimientos/" . $id_requerimientos;
						// var_dump($directorio);
						//Validamos si la ruta de destino existe, en caso de no existir la creamos
						if (!file_exists($directorio)) {
							mkdir($directorio, 0777, true) or die("No se puede crear el directorio de extraccion");
						}

						$dir = opendir($directorio); //Abrimos el directorio de destino
						$target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo
						if (move_uploaded_file($source, $target_path)) {

							$target_path = "'" . $target_path . "'";
							$nombre_ventana = "'Documento Adjunto'";
							$tamaño_ventana = "'width=500px,height=700px'";
							$link_file = '<a href="javascript: void(0)" onClick="window.open(' . $target_path . ',' . $nombre_ventana . ', ' . $tamaño_ventana . ')" class="text-dark-75 font-weight-bold mt-15 font-size-lg">	
																	' . $filename . '
																</a>';

							//echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
							$data = [
								'id_requerimientos' => $id_requerimientos,
								'tipo' => "Nuevo Archivo Adjunto",
								'fecha' => $fecha_registro,
								'detalle' => "Se adjunta archivo con nombre " . $link_file . " como evidencia de ENTREGA para el requerimiento con ID°" . $id_requerimientos,
								'id_personal' => $_SESSION["id_usuario"],
								'icono' => "flaticon2-download-1 text-",
								'color' => "primary",
							];
							$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
							$query = $dbm->prepare($sql);
							$query->execute($data);
						}
						closedir($dir);
					?>
			<script type="text/javascript">
				alert("Exito al insertar nuevo documento ");
				location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
			</script><?
					}
				}
			}

			if ($formulario == "avance_bitacora") {

				$avance = variable_exterior("avance");



				$data = [
					'id_requerimientos' => $id_requerimientos,
					'tipo' => "Avance",
					'fecha' => $fecha_registro,
					'detalle' => $avance,
					'id_personal' => $_SESSION["id_usuario"],
					'icono' => "flaticon2-chat text-",
					'color' => "info",
				];
				$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
				$query = $dbm->prepare($sql);
				if ($query->execute($data)) {

						?><script type="text/javascript">
			alert("exito al insertar ")
			location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
		</script><?php
					if ($email_cliente_bd[0] != "") {
						enviar_email_novedad_requerimiento($id_requerimientos, $email_cliente_bd[0], $avance, $dbm, $id_procesos_enviar, $asunto_correo);
					}
				} else {
					?><script type="text/javascript">
			alert("error al insertar ")
		</script><?php
				}
			}

			if ($formulario == "editar_requerimiento") {
				$bloque = variable_exterior("bloque");

				switch ($bloque) {
					case 'anular':
						$anular = variable_exterior("anular");

						if ($anular == "SI") {
							$data = [
								'estado' => 'ANULADO',
								'fecha_anulado' => $fecha_registro,
								'id_personal_anulado' => $_SESSION["id_usuario"],
								'id_requerimientos' => $id_requerimientos

							];

							$sql = "UPDATE `requerimientos` SET 
			        estado = :estado, 
			        fecha_anulado = :fecha_anulado, 
			        id_personal_anulado = :id_personal_anulado
			        WHERE id = :id_requerimientos";
							$query = $dbm->prepare($sql);
							if ($query->execute($data)) {

					?><script type="text/javascript">
						alert("Datos Actualizados!")
						location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
					</script><?php

								$avance = "Requerimiento con ID° " . $id_requerimientos . " Anulado por la persona solicitante!";

								$data = [
									'id_requerimientos' => $id_requerimientos,
									'tipo' => "Cambio de Estado: ANULADO",
									'fecha' => $fecha_registro,
									'detalle' => $avance,
									'id_personal' => $_SESSION["id_usuario"],
									'icono' => "flaticon2-chat text-",
									'color' => "danger",
								];
								$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
								$query = $dbm->prepare($sql);
								$query->execute($data);
								if ($email_cliente_bd[0] != "") {
									enviar_email_novedad_requerimiento($id_requerimientos, $email_cliente_bd[0], $avance, $dbm, $id_procesos_enviar, $asunto_correo);
								}
							} else {
								?><script type="text/javascript">
						alert("ERROR: Datos actualizar <? echo $sql ?> ")
					</script><?php
							}
						}
						break;

					case 'aperturado':
						$rechazar = variable_exterior("rechazar");
						$comentario = variable_exterior("comentario");

						if ($rechazar == "SI") {
							$data = [
								'estado' => 'RECHAZADO',
								'fecha_rechazado' => $fecha_registro,
								'id_personal_rechazado' => $_SESSION["id_usuario"],
								'id_requerimientos' => $id_requerimientos,
								'detalle_rechazado' => $comentario,

							];

							$sql = "UPDATE `requerimientos` SET 
									estado = :estado, 
									fecha_rechazado = :fecha_rechazado, 
									id_personal_rechazado = :id_personal_rechazado,
									detalle_rechazado = :detalle_rechazado
									WHERE id = :id_requerimientos";
							$query = $dbm->prepare($sql);
							if ($query->execute($data)) {

								?><script type="text/javascript">
						alert("Datos Actualizados!")
						location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
					</script><?php

								$avance = "Requerimiento Rechazado por la persona responsable del proceso, adjunta la siguiente observacion:" . $comentario;
								$data = [
									'id_requerimientos' => $id_requerimientos,
									'tipo' => "Cambio de Estado: RECHAZADO",
									'fecha' => $fecha_registro,
									'detalle' => $avance,
									'id_personal' => $_SESSION["id_usuario"],
									'icono' => "flaticon2-chat text-",
									'color' => "danger",
								];
								$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
								$query = $dbm->prepare($sql);
								$query->execute($data);
								if ($email_cliente_bd[0] != "") {
									enviar_email_novedad_requerimiento($id_requerimientos, $email_cliente_bd[0], $avance, $dbm, $id_procesos_enviar, $asunto_correo);
								}
							} else {
								?><script type="text/javascript">
						alert("ERROR: Datos actualizar <? echo $sql ?> ")
					</script><?php
							}
						}

						if ($rechazar == "") {
							$id_personal_asignado = variable_exterior("id_personal_asignado");
							$n_prioridad = variable_exterior("n_prioridad");
							$nombre_asignado = nombre_personal($id_personal_asignado, $dbm);

							$data = [
								'estado' => 'ASIGNADO',
								'fecha_asignado' => $fecha_registro,
								'id_personal_asignado' => $id_personal_asignado,
								'id_requerimientos' => $id_requerimientos,
								'detalle_asignado' => $comentario,
								'n_prioridad' => $n_prioridad,

							];

							$sql = "UPDATE `requerimientos` SET 
								estado = :estado, 
								fecha_asignado = :fecha_asignado, 
								id_personal_asignado = :id_personal_asignado,
								detalle_asignado = :detalle_asignado,
								n_prioridad = :n_prioridad
								WHERE id = :id_requerimientos";
							$query = $dbm->prepare($sql);
							if ($query->execute($data)) {

								?><script type="text/javascript">
						alert("Datos Actualizados!")
						location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
					</script><?php

								$avance = "Requerimiento Asignado por la persona responsable del proceso, Asignado A:" . $nombre_asignado;
								$data = [
									'id_requerimientos' => $id_requerimientos,
									'tipo' => "Cambio de Estado: ASIGNADO",
									'fecha' => $fecha_registro,
									'detalle' => $avance,
									'id_personal' => $_SESSION["id_usuario"],
									'icono' => "flaticon2-chat text-",
									'color' => "info",
								];
								$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
								$query = $dbm->prepare($sql);
								$query->execute($data);

								$email_asignado = email_personal($id_personal_asignado, $dbm);

								enviar_email_novedad_requerimiento($id_requerimientos, $email_asignado, $avance, $dbm, $id_procesos_enviar, $asunto_correo);
							} else {
								?><script type="text/javascript">
						alert("ERROR: Datos actualizar <? echo $sql ?> ")
					</script><?php
							}
						}
						break;

					case 'entregar':
						$entregar = variable_exterior("entregar");
						$comentario = variable_exterior("comentario");

						if ($entregar == "SI") {
							$data = [
								'estado' => 'ENTREGADO',
								'fecha_entregado' => $fecha_registro,
								'id_personal_entregado' => $_SESSION["id_usuario"],
								'id_requerimientos' => $id_requerimientos,
								'detalle_entregado' => $comentario,

							];

							$sql = "UPDATE `requerimientos` SET 
			        estado = :estado, 
			        fecha_entregado = :fecha_entregado, 
			        id_personal_entregado = :id_personal_entregado,
			        detalle_entregado = :detalle_entregado
			        WHERE id = :id_requerimientos";
							$query = $dbm->prepare($sql);
							if ($query->execute($data)) {

								?><script type="text/javascript">
						alert("Datos Actualizados!")
						location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
					</script><?php
								$avance = "Requerimiento Entregado por la persona asignadoa por el responsable del proceso, adjunta la siguiente observacion:" . $comentario;
								$data = [
									'id_requerimientos' => $id_requerimientos,
									'tipo' => "Cambio de Estado: ENTREGADO",
									'fecha' => $fecha_registro,
									'detalle' => $avance,
									'id_personal' => $_SESSION["id_usuario"],
									'icono' => "flaticon2-chat text-",
									'color' => "success",
								];
								$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
								$query = $dbm->prepare($sql);
								$query->execute($data);
								if ($email_cliente_bd[0] != "") {
									enviar_email_novedad_requerimiento($id_requerimientos, $email_cliente_bd[0], $avance, $dbm, $id_procesos_enviar, $asunto_correo);
								}

								//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
								foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {
									//Validamos que el archivo exista
									if ($_FILES["archivo"]["name"][$key]) {
										$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
										$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo

										$directorio = "adjuntos/requerimientos/" . $id_requerimientos;

										//Validamos si la ruta de destino existe, en caso de no existir la creamos
										if (!file_exists($directorio)) {
											mkdir($directorio, 0777, true) or die("No se puede crear el directorio de extraccion");
										}

										$dir = opendir($directorio); //Abrimos el directorio de destino
										$target_path = $directorio . '/' . $filename; //Indicamos la ruta de destino, así como el nombre del archivo
										if (move_uploaded_file($source, $target_path)) {

											$target_path = "'" . $target_path . "'";
											$nombre_ventana = "'Documento Adjunto'";
											$tamaño_ventana = "'width=500px,height=700px'";
											$link_file = '<a href="javascript: void(0)" onClick="window.open(' . $target_path . ',' . $nombre_ventana . ', ' . $tamaño_ventana . ')" class="text-dark-75 font-weight-bold mt-15 font-size-lg">	
																    						' . $filename . '
																    					</a>';

											//echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
											$data = [
												'id_requerimientos' => $id_requerimientos,
												'tipo' => "Nuevo Archivo Adjunto",
												'fecha' => $fecha_registro,
												'detalle' => "Se adjunta archivo con nombre " . $link_file . " como evidencia de ENTREGA para el requerimiento con ID°" . $id_requerimientos,
												'id_personal' => $_SESSION["id_usuario"],
												'icono' => "flaticon2-download-1 text-",
												'color' => "primary",
											];
											$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
											$query = $dbm->prepare($sql);
											$query->execute($data);
										}
										closedir($dir);
									}
								}
							} else {
								?><script type="text/javascript">
						alert("ERROR: Datos actualizar <? echo $sql ?> ")
					</script><?php
							}
						}
						break;

					case 'finalizar':
						$inconforme = variable_exterior("inconforme");
						$comentario = variable_exterior("comentario");

						if ($inconforme == "SI") {
							$data = [
								'estado' => 'INCONFORME',
								'fecha_inconforme' => $fecha_registro,
								'id_personal_inconforme' => $_SESSION["id_usuario"],
								'id_requerimientos' => $id_requerimientos,
								'detalle_inconforme' => $comentario,

							];

							$sql = "UPDATE `requerimientos` SET 
			        estado = :estado, 
			        fecha_inconforme = :fecha_inconforme, 
			        id_personal_inconforme = :id_personal_inconforme,
			        detalle_inconforme = :detalle_inconforme
			        WHERE id = :id_requerimientos";
							$query = $dbm->prepare($sql);
							if ($query->execute($data)) {

								?><script type="text/javascript">
						alert("Datos Actualizados!")
						location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
					</script><?php

								$avance = "Requerimiento devuelto a EN GESTION por INCONFORMIDAD del solicitante con lo entregado, adjunta la siguiente observacion:" . $comentario;
								$data = [
									'id_requerimientos' => $id_requerimientos,
									'tipo' => "Cambio de Estado: INCONFORME",
									'fecha' => $fecha_registro,
									'detalle' => $avance,
									'id_personal' => $_SESSION["id_usuario"],
									'icono' => "flaticon2-chat text-",
									'color' => "danger",
								];
								$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
								$query = $dbm->prepare($sql);
								$query->execute($data);

								$email_asignado = email_personal($email_cliente_bd[1], $dbm);

								enviar_email_novedad_requerimiento($id_requerimientos, $email_asignado, $avance, $dbm, $id_procesos_enviar, $asunto_correo);
							} else {
								?><script type="text/javascript">
						alert("ERROR: Datos actualizar <? echo $sql ?> ")
					</script><?php
							}
						}

						if ($inconforme == "") {

							$calificacion = variable_exterior("calificacion");

							$data = [
								'estado' => 'FINALIZADO',
								'fecha_finalizado' => $fecha_registro,
								'id_personal_finalizado' => $_SESSION["id_usuario"],
								'id_requerimientos' => $id_requerimientos,
								'detalle_finalizado' => $comentario,
								'calificacion' => $calificacion,
							];

							$sql = "UPDATE `requerimientos` SET 
			        estado = :estado, 
			        fecha_finalizado = :fecha_finalizado, 
			        id_personal_finalizado = :id_personal_finalizado,
			        detalle_finalizado = :detalle_finalizado,
			        calificacion = :calificacion
			        WHERE id = :id_requerimientos";
							$query = $dbm->prepare($sql);
							if ($query->execute($data)) {

								?><script type="text/javascript">
						alert("Datos Actualizados!")
						location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
					</script><?php

								$avance = "Requerimiento FINALIZADO por la persona solicitante, adjunta la siguiente observacion:" . $comentario;
								$data = [
									'id_requerimientos' => $id_requerimientos,
									'tipo' => "Cambio de Estado: FINALIZADO",
									'fecha' => $fecha_registro,
									'detalle' => $avance,
									'id_personal' => $_SESSION["id_usuario"],
									'icono' => "flaticon2-chat text-",
									'color' => "info",
								];
								$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
								$query = $dbm->prepare($sql);
								$query->execute($data);

								$email_asignado = email_personal($email_cliente_bd[1], $dbm);

								enviar_email_novedad_requerimiento($id_requerimientos, $email_asignado, $avance, $dbm, $id_procesos_enviar, $asunto_correo);

								$avance = "Requerimiento CALIFICADO por la persona solicitante -> " . $calificacion . "/3";
								$data = [
									'id_requerimientos' => $id_requerimientos,
									'tipo' => "CALIFICACION DE REQUERIMIENTO - " . $calificacion . "/3",
									'fecha' => $fecha_registro,
									'detalle' => $avance,
									'id_personal' => $_SESSION["id_usuario"],
									'icono' => "flaticon2-chat text-",
									'color' => "info",
								];
								$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
								$query = $dbm->prepare($sql);
								$query->execute($data);

								$email_asignado = email_personal($email_cliente_bd[1], $dbm);

								enviar_email_novedad_requerimiento($id_requerimientos, $email_asignado, $avance, $dbm, $id_procesos_enviar, $asunto_correo);
							} else {
								?><script type="text/javascript">
						alert("ERROR: Datos actualizar <? echo $sql ?> ")
					</script><?php
							}
						}
						break;
				}
			}




			if ($requerimientos["origen"] == "CLIENTE") {
				$personal_solicitado = nombre_cliente($requerimientos["id_personal_solicitado"], $dbm_unidadso);
				$nombre_proceso = correo_cliente($requerimientos["id_personal_solicitado"], $dbm_unidadso);
				$requerimientos_ciudad_sede = empresa_cliente($requerimientos["id_personal_solicitado"], $dbm_unidadso);
			} else {
				$personal_solicitado = nombre_personal($requerimientos["id_personal_solicitado"], $dbm);
				$requerimientos_ciudad_sede = "Sede : " . $requerimientos['sede'] . "- " . $requerimientos['ciudad'];
				$nombre_proceso = $nombre_proceso;
			}

			$empresa = $requerimientos["empresa"];
			$id_terceros = $requerimientos["id_terceros"];
			$nombre_prospecto = nombre_prospecto($requerimientos["id_terceros"], $dbm);
			$name_page = "Detalle Requerimiento ID° " . $id_requerimientos;
			$desc_page = "<b> Solicitado por " . $personal_solicitado . "</b>";

			if ($_SESSION["responsable_proceso"] ==  $requerimientos["id_procesos"] && $requerimientos["estado"] == "SOLICITADO") {

				$data = [
					'estado' => 'APERTURADO',
					'fecha_aperturado' => $fecha_registro,
					'id_personal_aperturado' => $_SESSION["id_usuario"],
					'id_requerimientos' => $id_requerimientos

				];

				$sql = "UPDATE `requerimientos` SET 
			        estado = :estado, 
			        fecha_aperturado = :fecha_aperturado, 
			        id_personal_aperturado = :id_personal_aperturado
			        WHERE id = :id_requerimientos";
				$query = $dbm->prepare($sql);
				if ($query->execute($data)) {

								?><script type="text/javascript">
			alert("Datos Actualizados!")
			location.href = '?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>';
		</script><?php

					$avance = "Requerimiento Aperturado por la persona responsable del proceso!";
					$data = [
						'id_requerimientos' => $id_requerimientos,
						'tipo' => "Cambio de Estado: APERTURADO",
						'fecha' => $fecha_registro,
						'detalle' => $avance,
						'id_personal' => $_SESSION["id_usuario"],
						'icono' => "flaticon2-chat text-",
						'color' => "warning",
					];
					$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
					$query = $dbm->prepare($sql);
					$query->execute($data);

					$sql = "SELECT * FROM requerimientos WHERE id = '" . $id_requerimientos . "' ";
					$procesos = $dbm->prepare($sql);
					$procesos->execute();
					$requerimientos = $procesos->fetch();
					if ($email_cliente_bd[0] != "") {
						enviar_email_novedad_requerimiento($id_requerimientos, $email_cliente_bd[0], $avance, $dbm, $id_procesos_enviar, $asunto_correo);
					}
				} else {
					?><script type="text/javascript">
			alert("ERROR: Datos actualizar <? echo $sql ?> ")
		</script><?php
				}
			}

			if ($requerimientos["id_personal_asignado"] == $_SESSION["id_usuario"] && $requerimientos["estado"] == "ASIGNADO") {

				if ($requerimientos["detalle_asignado"] == "AutoRequerimiento") {
					$finalizar = $_SESSION['finalizar'];
				} else {
					$finalizar = "";
				}
				//Validacion de autogestion finaliza automaticamente el requerimiento
				//Se crea el requermiento en gestion data
				$data = [
					'estado' => 'EN GESTION',
					'fecha_gestion' => $fecha_registro,
					'id_personal_gestion' => $_SESSION["id_usuario"],
					'id_requerimientos' => $id_requerimientos

				];

				//Sentencia
				$sql = "UPDATE `requerimientos` SET 
						estado = :estado, 
						fecha_gestion = :fecha_gestion, 
						id_personal_gestion = :id_personal_gestion
						WHERE id = :id_requerimientos";
				$query = $dbm->prepare($sql);
				$query->execute($data);

				//creacion de requerimientos_bitacora 
				$avance = "Requerimiento inicia labores de GESTION por la persona asignada!";
				$data = [
					'id_requerimientos' => $id_requerimientos,
					'tipo' => "Cambio de Estado: EN GESTION",
					'fecha' => $fecha_registro,
					'detalle' => $avance,
					'id_personal' => $_SESSION["id_usuario"],
					'icono' => "flaticon2-chat text-",
					'color' => "info",
				];
				$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
				$query = $dbm->prepare($sql);
				if ($query->execute($data)) {
				} else {
					?>
		<script type="text/javascript">
			alert("ERROR Datos no actualizados! EN GESTION")
		</script>
		<?php
					//********************************************* */
				}

				if ($finalizar == "si") {
					//ENTREGADO
					//********************************************* */
					$data = [
						'estado' => 'ENTREGADO',
						'fecha_entregado' => $fecha_registro,
						'id_personal_entregado' => $_SESSION["id_usuario"],
						'id_requerimientos' => $id_requerimientos

					];

					$sql = "UPDATE `requerimientos` SET 
							estado = :estado, 
							fecha_entregado = :fecha_entregado, 
							id_personal_entregado = :id_personal_entregado
							WHERE id = :id_requerimientos";
					$query = $dbm->prepare($sql);
					$query->execute($data);

					$avance = "Requerimiento ENTREGADO por la persona asignado por el responsable del proceso!";
					$data = [
						'id_requerimientos' => $id_requerimientos,
						'tipo' => "Cambio de Estado: ENTREGADO",
						'fecha' => $fecha_registro,
						'detalle' => $avance,
						'id_personal' => $_SESSION["id_usuario"],
						'icono' => "flaticon2-chat text-",
						'color' => "info",
					];
					$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
					$query = $dbm->prepare($sql);
					if ($query->execute($data)) {
					} else {
		?>
			<script type="text/javascript">
				alert("ERROR Datos no actualizados! ENTREGADO")
			</script>
		<?php
					}
					//FINALIZADO
					//********************************************* */

					$data = [
						'estado' => 'FINALIZADO',
						'fecha_finalizado' => $fecha_registro,
						'id_personal_finalizado' => $_SESSION["id_usuario"],
						'id_requerimientos' => $id_requerimientos,
						'calificacion' => '3'

					];
					$sql = "UPDATE `requerimientos` SET 
							estado = :estado, 
							fecha_finalizado = :fecha_finalizado, 
							id_personal_finalizado = :id_personal_finalizado,
							calificacion = :calificacion
							WHERE id = :id_requerimientos";
					$query = $dbm->prepare($sql);
					$query->execute($data);

					$avance = "Requerimiento FINALIZADO por la persona responsable. Calificacion: 3";
					$data = [
						'id_requerimientos' => $id_requerimientos,
						'tipo' => "Cambio de Estado: FINALIZADO",
						'fecha' => $fecha_registro,
						'detalle' => $avance,
						'id_personal' => $_SESSION["id_usuario"],
						'icono' => "flaticon2-chat text-",
						'color' => "info",
					];
					$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
					$query = $dbm->prepare($sql);
					if ($query->execute($data)) {
					} else {
		?>
			<script type="text/javascript">
				alert("ERROR Datos no actualizados! FINALIZADO")
			</script>
		<?php
						if ($email_cliente_bd[0] != "") {
							enviar_email_novedad_requerimiento($id_requerimientos, $email_cliente_bd[0], $avance, $dbm, $id_procesos_enviar, $asunto_correo);
						}
					}
				}
				$sql = "SELECT * FROM requerimientos WHERE id = '" . $id_requerimientos . "' ";
				$procesos = $dbm->prepare($sql);
				$procesos->execute();
				$requerimientos = $procesos->fetch();
				$id_responsable_proceso = responsable_proceso($email_cliente_bd[2], $dbm);
				$temporal_email = email_personal($id_responsable_proceso, $dbm);

				if ($temporal_email == "") {
					$email = "o";
				} else {
					$email = $temporal_email;
				}

				enviar_email_novedad_requerimiento($id_requerimientos, $email, $avance, $dbm, $id_procesos_enviar, $asunto_correo);
			}


			if ($requerimientos["id_personal_asignado"] == $_SESSION["id_usuario"] && $requerimientos["estado"] == "INCONFORME") {

				$data = [
					'estado' => 'EN GESTION',
					'id_requerimientos' => $id_requerimientos

				];

				$sql = "UPDATE `requerimientos` SET 
			        estado = :estado
			        WHERE id = :id_requerimientos";
				$query = $dbm->prepare($sql);
				if ($query->execute($data)) {

		?><script type="text/javascript">
			alert("Datos Actualizados!")
		</script><?php

					$avance = "Requerimiento inicia labor de GESTION nuevamente luego de ser devuelto por INCONFORME por la persona solicitante!";
					$data = [
						'id_requerimientos' => $id_requerimientos,
						'tipo' => "Cambio de Estado: EN GESTION",
						'fecha' => $fecha_registro,
						'detalle' => $avance,
						'id_personal' => $_SESSION["id_usuario"],
						'icono' => "flaticon2-chat text-",
						'color' => "info",
					];
					$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
					$query = $dbm->prepare($sql);
					$query->execute($data);

					$sql = "SELECT * FROM requerimientos WHERE id = '" . $id_requerimientos . "' ";
					$procesos = $dbm->prepare($sql);
					$procesos->execute();
					$requerimientos = $procesos->fetch();
					if ($email_cliente_bd[0] != "") {
						enviar_email_novedad_requerimiento($id_requerimientos, $email_cliente_bd[0], $avance, $dbm, $id_procesos_enviar, $asunto_correo);
					}
				} else {
					?><script type="text/javascript">
			alert("ERROR: Datos actualizar <? echo $sql ?> ")
		</script><?php
				}
			}


			$activar = variable_exterior("activar");
			if ($activar == 1) {

				$data = [
					'estado' => 'SOLICITADO',
					'id_requerimientos' => $id_requerimientos

				];

				$sql = "UPDATE `requerimientos` SET 
			        estado = :estado
			        WHERE id = :id_requerimientos";
				$query = $dbm->prepare($sql);
				if ($query->execute($data)) {

					?><script type="text/javascript">
			alert("Datos Actualizados!")
		</script><?php

					$data = [
						'id_requerimientos' => $id_requerimientos,
						'tipo' => "Cambio de Estado: SOLICITADO",
						'fecha' => $fecha_registro,
						'detalle' => "Requerimiento cambio de estado a SOLICITAD de nuevo luego de ser RECHAZDO por la persona responsable del proceso!",
						'id_personal' => $_SESSION["id_usuario"],
						'icono' => "flaticon2-chat text-",
						'color' => "danger",
					];
					$sql = "INSERT INTO requerimientos_bitacora(id_requerimientos, tipo, fecha, detalle, id_personal, icono, color) VALUES (:id_requerimientos, :tipo, :fecha, :detalle, :id_personal, :icono, :color)";
					$query = $dbm->prepare($sql);
					$query->execute($data);

					$sql = "SELECT * FROM requerimientos WHERE id = '" . $id_requerimientos . "' ";
					$procesos = $dbm->prepare($sql);
					$procesos->execute();
					$requerimientos = $procesos->fetch();
				} else {
					?><script type="text/javascript">
			alert("ERROR: Datos actualizar <? echo $sql ?> ")
		</script><?php
				}
			}
			$requerimientos_bitacora = "";
			$requerimientos_bitacora_tab = "";
			$requerimientos_padre_estado_1 = "";
			if ($_GET['id_requerimientos'] != "") {
				# code...

				$todos = "'" . $_GET['id_requerimientos'] . "',";

				$sql = "SELECT id FROM requerimientos WHERE id_requerimiento_padre = '" . $_GET['id_requerimientos'] . "' ";
				$requerimientos_hijos = $dbm->prepare($sql);
				$requerimientos_hijos->execute();
				while ($fila = $requerimientos_hijos->fetch()) {
					$todos .= "'" . $fila["id"] . "',";
				}

				$todos = trim($todos, ",");

				$sql_todos = "SELECT * FROM requerimientos_bitacora WHERE id_requerimientos IN (" . $todos . ") order by id DESC";
				$sql = $sql_todos;
				$requerimientos_bitacora = $dbm->prepare($sql);
				$requerimientos_bitacora->execute();
				if (is_numeric($id_requerimiento_padre)) {
					$sql_padre = "SELECT * FROM requerimientos_bitacora WHERE id_requerimientos = $id_requerimiento_padre order by id DESC";
					$requerimientos_bitacora_padre = $dbm->prepare($sql_padre);
					$requerimientos_bitacora_padre->execute();
				} else {
					$requerimientos_bitacora_padre = "";
				}

				$sql = "SELECT estado FROM requerimientos WHERE id = '" . $id_requerimiento_padre . "' ";
				$requerimientos_padre_estado = $dbm->prepare($sql);
				$requerimientos_padre_estado->execute();
				$requerimientos_padre_estado_1 = $requerimientos_padre_estado->fetch();


				// $sql = $sql_todos;
				$requerimientos_bitacora_tab = $dbm->prepare($sql_todos);
				$requerimientos_bitacora_tab->execute();

				// $sql = $sql_todos;
				$requerimientos_bitacora_tab2 = $dbm->prepare($sql_todos);
				$requerimientos_bitacora_tab2->execute();
			}

			$sql = "SELECT * FROM requerimientos WHERE id_requerimiento_padre = '" . $id_requerimientos . "' ";
			$requerimientos_hijos = $dbm->prepare($sql);
			$requerimientos_hijos->execute();

			$sql = "SELECT id, nombre_completo FROM personal WHERE id_procesos = '" . $requerimientos["id_procesos"] . "' and estado = '1' ";
			$integrantes_proceso = $dbm->prepare($sql);
			$integrantes_proceso->execute();

			$dbm_sicuso = conectar_sicuso();

			$sql = "SELECT `empresas`.`idempresa`,`empresas`.`empresa` FROM `empresas` ORDER BY `empresas`.`empresa` ASC";
			$empresas =  $dbm_sicuso->prepare($sql);
			$empresas->execute();


			$sql_cliente = "SELECT email FROM empresas WHERE `empresa` = '" . $requerimientos['empresa'] . "' and `empresa` != 'Unidad De Salud Ocupacional'";
			$cliente = $dbm_unidadso->prepare($sql_cliente);
			$cliente->execute();
			$correo_cliente = $cliente->fetch();


			if ($correo_cliente === false) {
				$correo_cliente['email'] = "";
			} else {
				if ($correo_cliente['email'] != "" && $correo_cliente['email'] != null && !empty($correo_cliente['email']) && !isset($correo_cliente['email'])) {
					$correo_cliente['email'] = $correo_cliente['email'];
				}
			}

			$sql_proveedor = "SELECT email FROM proveedorednacional WHERE empresa = '" . $requerimientos['proveedor_rednacional'] . "' and `empresa` != 'Unidad De Salud Ocupacional'";
			$proveedor = $dbm_unidadso->prepare($sql_proveedor);
			$proveedor->execute();
			$correo_proveedor = $proveedor->fetch();

			if ($correo_proveedor === false) {
				$correo_proveedor['email'] = "";
			} else {
				if ($correo_proveedor['email'] != "" && $correo_proveedor['email'] != null && !empty($correo_proveedor['email']) && !isset($correo_proveedor['email'])) {
					$correo_proveedor['email'] = $correo_proveedor['email'];
				}
			}

					?>