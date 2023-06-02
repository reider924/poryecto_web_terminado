<div class="row g-5 g-xl-8">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                    </div>
                </div>
                <div class="card-toolbar">
                    <!--begin::Toolbar-->
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <!--begin::Filter-->
                        <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->Filtros
                        </button>
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-4 text-dark fw-bolder">Opciones de Filtros</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Separator-->
                            <!--begin::Content-->


                            <form class="form" action="?url_id=orden" method="POST" id="consultar_orden" name="consultar_orden" enctype="multipart/form-data">
                                <input type="hidden" name="formulario" id="formulario" value="consultar_orden">
                                <div class="scroll-y mh-300px mh-lg-325px">
                                    <div class="px-7 py-5">
                                        <div class="mb-10">
                                            <label class="form-label fs-5 fw-bold mb-3">Modelo del producto:</label>
                                            <select name="producto" id="producto" class="form-select form-select-lg mb-3">
                                                <option value="" selected>Seleccione</option>
                                                <?php
                                                while ($a = $productos_filtro->fetch()) {
                                                ?>
                                                    <option value="<?php echo $a['id'] ?>"><?php echo $a['modelo'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <input type="submit" name="enviar" class="btn btn-primary" value="Filtrar">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <!--begin::Action-->
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_api_key">
                            Crear Orden
                        </a>
                        <!--end::Action-->
                        <!--end::Crear-->
                    </div>

                    <!--begin::Group actions-->
                    <!--end::Group actions-->
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="card-scroll">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                
                                <th class="min-w-185px">Producto</th>
                                <th class="min-w-185px">Servicio</th>
                                <th class="min-w-125px">Dirección</th>
                                <th class="min-w-185px">Observaciones</th>
                                <th class="min-w-125px">Fecha de creación</th>
                                <th class="min-w-125px">Fecha de programación</th>
                                <th class="min-w-185px"></th>
                                <th class="min-w-185px"></th>
                            </tr>
                        </thead>
                        <tbody class="fw-bold text-gray-600">
                            <?php
                            if ($consulta != "") {
                                while ($fila = $consulta->fetch()) {
                            ?>
                                    <tr>
                                        
                                        <td class="min-w-185px"><?= $fila['modelo']  ?></td>
                                        <td class="min-w-185px"><?= $fila['servicio']  ?></td>
                                        <td class="min-w-125px"><?= $fila['direccion']  ?></td>
                                        <td class="min-w-185px"><?= $fila['observaciones']  ?></td>
                                        <td class="min-w-125px"><?= $fila['fecha']  ?></td>
                                        <td class="min-w-125px"><?= $fila['fecha_programacion']  ?></td>
                                        <td class="min-w-185px"><button onclick="delete_order(<?= $fila['id']?>)" class="btn btn-danger"><i class="bi bi-archive-fill"></i></button></td>
                                        <td class="min-w-185px"><button class="btn btn-danger"><i class="bi bi-pencil-square"></i></button></td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="kt_modal_create_api_key" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_create_api_key_header">
                <h2>Crear Orden</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                        </svg>
                    </span>
                </div>
            </div>


            <form id="crear_orden" name="crear_orden" class="form" action="?url_id=orden" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="formulario" id="formulario" value="crear_orden">
                <div class="modal-body py-10 px-lg-17">
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_create_api_key_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_create_api_key_header" data-kt-scroll-wrappers="#kt_modal_create_api_key_scroll" data-kt-scroll-offset="300px">
                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-10 p-6">
                            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black" />
                                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black" />
                                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black" />
                                </svg>
                            </span>
                            <div class="d-flex flex-stack flex-grow-1">
                                <div class="fw-bold">
                                    <h4 class="text-gray-900 fw-bolder">Nota:</h4>
                                    <div class="fs-6 text-gray-700">Por favor!, diligenciar todos los campos</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-10 fv-row">

                            <div class="row">
                                <div class="col-6 mb-10">
                                    <label class="required fs-5 fw-bold mb-2">Nombre</label>
                                    <input required name="nombre" type="text" class="form-control form-control-solid" id="nombre" value="<?php echo $_SESSION['nombre'] ?>" />
                                </div>
                                <div class="col-6 mb-10">
                                    <label class="required fs-5 fw-bold mb-2">Dirección</label>
                                    <input required name="direccion" type="text" class="form-control form-control-solid" id="direccion" value="<?php echo $_SESSION['direccion'] ?>" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-10">
                                    <label class="required fs-5 fw-bold mb-2">Modelo del Producto</label>
                                    <select required name="producto" id="producto" class="form-select form-select-lg mb-3">
                                        <?php
                                        while ($a = $productos->fetch()) {
                                        ?>
                                            <option value="<?php echo $a['id'] ?>"><?php echo $a['modelo'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-6 mb-10">
                                    <label class="required fs-5 fw-bold mb-2">Servicio</label>
                                    <input required name="servicio" type="text" class="form-control form-control-solid" id="servicio" />
                                </div>
                                <div class="col-6 mb-10">
                                    <label class="required fs-5 fw-bold mb-2">Fecha del servicio</label>
                                    <input required name="fecha_programacion" type="datetime-local" class="form-control form-control-solid" id="fecha_programacion" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-10">
                                    <label class="required fs-5 fw-bold mb-2">Observación</label>
                                    <div class="form-floating">
                                        <textarea required class="form-control" placeholder="Leave a comment here" id="observacion" name="observacion"></textarea>
                                        <label for="floatingTextarea2">Comments</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $_SESSION['id_usuario'] ?>">
                        <div class="modal-footer flex-center">
                            <input type="submit" name="enviar" id="enviar" value="Crear Usuario" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

delete_order = (dato) =>{

    var parametros = {
                "delete_order" : dato,
                "formulario":'delete_orden'
                    };
        $.ajax({
                data:  parametros, //datos que se envian a traves de ajax
                url:   '?url_id=orden', //archivo que recibe la peticion
                type:  'post', //método de envio
                beforeSend: function () {
                       console.log("Procesando, espere por favor...");
                },
                success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                            window.location.reload(true);
                        
                        
                }
        });

}

</script>