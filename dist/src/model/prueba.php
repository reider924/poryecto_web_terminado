<?
    $observacion = variable_exterior("observacion");
    $id = variable_exterior("id");
if ($formulario == "programada") {
    $fecha_inicio = variable_exterior("fecha_inicio");
    $fecha_final = variable_exterior("fecha_final");

    $data =
        [
            'fecha_ejecucion' => $fecha_inicio,
            'fecha_finalizacion' => $fecha_final,
            'observacion' => $observacion,
        ];

    $sql = "UPDATE
                ordenes_servicio
            SET
                fecha_ejecucion = :fecha_ejecucion,
                fecha_finalizacion = :fecha_finalizacion,
                observacion = :observacion
            WHERE
                id = $id";
    $query = $dbm->prepare($sql);
    if ($query->execute($data)) {
    ?>
        <script type="text/javascript">
            alert("Datos actualizados con exito !");
            location.href = '?url_id=ordenes_detalle&id=<? echo $id ?>';
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("ERROR!");
            location.href = '?url_id=ordenes_detalle&id=<? echo $id ?>';
        </script>
    <?php
    }
} 
else if ($formulario == "ejecucion") 
{
    $inicio_real = variable_exterior("inicio_real");
    $observacion = variable_exterior("observacion");
} 
else if ($formulario == "ejecutada") 
{
    $fin_real = variable_exterior("fin_real");
    $observacion = variable_exterior("observacion");
} 
else if ($formulario == "finalizada") 
{
    $observacion = variable_exterior("observacion");
} 
else if ($formulario == "facturada") 
{
    $n_factura = variable_exterior("n_factura");
    $fecha_factura = variable_exterior("fecha_factura");
    $observacion = variable_exterior("observacion");
} 
else if ($formulario == "cancelada") 
{
    $observacion = variable_exterior("observacion");
} 
else if ($formulario == "suspendida") 
{
    $observacion = variable_exterior("observacion");
}
