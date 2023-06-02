<div class="container-xxl" id="kt_content_container">
    <div class="d-flex flex-column flex-xl-row">
        <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body">
                    <div class="d-flex flex-center flex-column py-5">
                        <h3 class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3" align="center"><? echo "" ?></h3>
                        <div class="symbol symbol-100px symbol-circle mb-7">
                        </div>
                        <div class="mb-4">
                            <img src="assets/media/img/user.png" width="100px" class="rounded-circle">
                        </div>
                    </div>
                    <div class="separator"></div>
                    <div id="kt_user_view_details" class="collapse show">
                        <div class="pb-5 fs-6">
                            <div class="fw-bolder mt-5">Nombre Completo</div>
                            <div class="text-gray-600"><?php echo $usuario['nombre'] ?></div>
                            <br>
                            <div class="fw-bolder mt-5">Número Identificación</div>
                            <div class="text-gray-600"><?php echo $usuario['identificacion'] ?></div>
                            <br>
                            <div class="fw-bolder mt-5">Estado</div>
                            <div class="text-gray-600"><?php echo $usuario['estado'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-column flex-lg-row-auto w-80 w-xl-850px mb-10">
            <div class="card mb-5 mb-xl-8">
                <div class="card-header card-header-tabs-line">
                    <div class="card-toolbar">

                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                            <li class="nav-item mr-3">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_apps_contacts_view_tab_2">
                                    <span class="nav-icon mr-2">
                                        <span class="svg-icon mr-3">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat-check.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                    <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="nav-text font-weight-bold">Datos</span>
                                </a>
                            </li>
                            <li class="nav-item mr-3">
                                <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_apps_contacts_view_tab_3">
                                    <span class="nav-icon mr-2">
                                        <span class="svg-icon mr-3">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Devices/Display1.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z" fill="#000000" opacity="0.3" />
                                                    <path d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z" fill="#000000" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="nav-text font-weight-bold">Adjuntos</span>
                                </a>
                            </li>



                        </ul>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="tab-content pt-5">
                        <!--begin::Tab Content-->
                        <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                            <form class="form" action="?url_id=usuario&id=<?php echo $id ?>" method="POST" id="actualizar_datos" name="actualizar_datos" enctype="multipart/form-data">
                                <input type="hidden" name="formulario" id="formulario" value="actualizar_datos">
                                <br>
                                <h2 class="text-center">
                                    Actualizar Datos
                                </h2>
                                <br>
                                <div class="row">
                                    <div class="col col-sm-6">
                                        <label class="form-label fs-5 fw-bold mb-3">Nombre Completo:</label>
                                        <input id="nombre" name="nombre" type="text" class="form-control form-control-solid" value="<?php echo $usuario['nombre'] ?>" />
                                    </div>
                                    <div class="col col-sm-6">
                                        <label class="form-label fs-5 fw-bold mb-3">Identificación</label>
                                        <input id="identificacion" name="identificacion" type="number" class="form-control form-control-solid" value="<?php echo $usuario['identificacion'] ?>" />
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col col-sm-6">
                                        <label class="form-label fs-5 fw-bold mb-3">Dirección</label>
                                        <input id="direccion" name="direccion" type="text" class="form-control form-control-solid" value="<?php echo $usuario['direccion'] ?>" />
                                    </div>
                                    <div class="col col-sm-6">
                                        <label class="form-label fs-5 fw-bold mb-3">Telefono</label>
                                        <input id="telefono" name="telefono" type="number" class="form-control form-control-solid" value="<?php echo $usuario['telefono'] ?>" />
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col col-sm-6">
                                        <label class="form-label fs-5 fw-bold mb-3">Correo</label>
                                        <input id="correo" name="correo" type="email" class="form-control form-control-solid" value="<?php echo $usuario['correo'] ?>" />
                                    </div>
                                    <div class="col col-sm-6">
                                        <label class="form-label fs-5 fw-bold mb-3">Fecha Creación</label>
                                        <input disabled id="fecha" name="fecha" type="datetime-local" class="form-control form-control-solid" value="<?php echo $usuario['fecha'] ?>" />
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col col-sm-6">
                                        <label class="form-label fs-5 fw-bold mb-3">Usuario</label>
                                        <input id="usuario" name="usuario" type="text" class="form-control form-control-solid" value="<?php echo $usuario['usuario'] ?>" />
                                    </div>
                                    <div class="col col-sm-6">
                                        <label class="form-label fs-5 fw-bold mb-3">Contraseña</label>
                                        <input disabled id="contraseña" name="contraseña" type="text" class="form-control form-control-solid" value="<?php echo $usuario['contraseña'] ?>" />
                                    </div>
                                </div>
                                <br>
                                <input type="file" class="form-control " id="archivo[]" name="archivo[]" multiple>
                                <br>
                                <center>
                                    <input type="submit" name="enviar" value="Actualizar" class="btn btn-success">
                                </center>
                            </form>
                        </div>
                        <div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
                            <div class="row">

                                <?php
                                $ruta = "adjuntos/usuarios/" . $id;
                                if (is_dir($ruta)) {
                                    if ($directorio = opendir($ruta)) {
                                        while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
                                        {
                                            if (is_dir($archivo)) //verificamos si es o no un directorio
                                            {
                                            } else {
                                ?>
                                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                                    <!--begin::Card-->
                                                    <div class="card card-custom gutter-b card-stretch">
                                                        <div class="card-body">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <!--begin: Icon-->
                                                                <img alt="" class="max-h-25px" src="assets/media/img/doc.png" width="70px" />
                                                                <!--end: Icon-->
                                                                <!--begin: Tite-->
                                                                <a href="javascript: void(0)" onClick="window.open('<?php echo $ruta . "/" . $archivo ?>','Documento Adjunto', 'width=500px,height=700px')" class="text-dark-75 font-weight-bold mt-15 font-size-lg">
                                                                    <?php echo $archivo ?>
                                                                </a>
                                                                <!--end: Tite-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end:: Card-->
                                                </div>
                                <?php
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">



                </div>
            </div>
        </div>
    </div>
</div>