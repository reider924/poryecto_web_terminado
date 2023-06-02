<div class="row g-5 g-xl-8">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body pt-0">

                <form class="form" action="?url_id=gestion_productos&id=<?php echo $id ?>" method="POST" id="actualizar_datos" name="actualizar_datos" enctype="multipart/form-data">
                    <input type="hidden" name="formulario" id="formulario" value="actualizar_datos">
                    <br>
                    <h2 class="text-center">
                    </h2>
                    <br>
                    <?php
                    $ruta = "adjuntos/productos";
                    if (is_dir($ruta)) {
                        if ($directorio = opendir($ruta)) {
                            $archivo = readdir($directorio); //obtenemos un archivo y luego otro sucesivamente
                            if (is_dir($archivo)) //verificamos si es o no un directorio
                            {
                    ?>
                    <center>
                                <img src="<?php echo $ruta . "/" . $id . '.png' ?>" width="600px" class="rounded-circle">
                                </center>
                    <?php
                            }
                        }
                    } else {
                    }
                    ?>

                    <div class="row">
                        <div class="col col-sm-6">
                            <label class="form-label fs-5 fw-bold mb-3">Marca</label>
                            <input id="marca" name="marca" type="text" class="form-control form-control-solid" value="<?php echo $lavadora['marca'] ?>" />
                        </div>
                        <div class="col col-sm-6">
                            <label class="form-label fs-5 fw-bold mb-3">Modelo</label>
                            <input id="modelo" name="modelo" type="text" class="form-control form-control-solid" value="<?php echo $lavadora['modelo'] ?>" />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col col-sm-12">
                            <label class="form-label fs-5 fw-bold mb-3">Referencia</label>
                            <input id="referencia" name="referencia" type="text" class="form-control form-control-solid" value="<?php echo $lavadora['referencia'] ?>" />
                        </div>
                       
                    </div>
                    <br>
                    <center>
                        <input type="submit" name="enviar" value="Actualizar" class="btn btn-success">
                    </center>
                </form>
            </div>
           
        </div>
    </div>
</div>