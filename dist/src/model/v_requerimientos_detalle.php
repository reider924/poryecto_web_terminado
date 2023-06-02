<!--begin::Hero-->
<style>
	.buttons-colvis {
		border-radius: 0.95rem !important;
		margin: 2px;
	}
</style>
<div class="card card-custom overflow-hidden position-relative mb-8 ">
	<div class="card-header ribbon ribbon-end">
		<div class="ribbon-label bg-warning">
			<b>ESTADO: </b><?php echo $requerimientos["estado"] ?>
		</div>
		<h3 class="card-title">
			Requerimiento ID° <?php echo $id_requerimientos ?>
		</h3>
	</div>
	<!--begin::SVG-->
	<div class="position-absolute bottom-0 left-0 right-0 d-none d-lg-flex flex-row-fluid">
		<span class="svg-icon svg-icon-full flex-row-fluid svg-icon-dark opacity-3">
			<!--begin::Svg Icon | path:assets/media/bg/home-2-bg.svg-->
			<img src="assets/media/bg/home-2-bg.svg">
			<!--end::Svg Icon-->
		</span>
	</div>
	<div class="position-absolute d-flex top-0 right-0 offset-lg-5 col-lg-7 opacity-30 opacity-lg-100">
		<span class="svg-icon svg-icon-full flex-row-fluid p-15">
			<!--begin::Svg Icon | path:assets/media/svg/illustrations/working.svg-->
			<img src="assets/media/svg/illustrations/working.svg">
			<!--end::Svg Icon-->
		</span>
	</div>
	<!--end::SVG-->

	<!--begin::Hero Body-->
	<div class="card-body d-flex justify-content-center flex-column col-lg-6 px-8 py-20 px-lg-20 py-lg-40">
		<!--begin::Heading-->
		<?
		if ($requerimientos["estado"] == "RECHAZADO") {
		?>
			<h2 class="text-dark font-weight-bolder mb-8">Requerimiento Rechazado!</h2>
			<div class="fw-bolder mt-5">Motivo Rechazo:</div>
			<div class="text-gray-600"><? echo $requerimientos["detalle_rechazado"] ?></div>
			<br></br>
			<h2><a class="btn btn-info" href="?url_id=requerimientos_detalle&id_requerimientos=<?php echo $id_requerimientos ?>&activar=1">ENVIAR DE NUEVO EL REQUERIMIENTO!</a></h2>
		<?
		} else if ($requerimientos["estado"] != "FINALIZADO" && $requerimientos["estado"] != "ANULADO") {
		?>
			<h2 class="text-dark font-weight-bolder mb-8">Algun comentario o mensaje?</h2>
			<!--end::Heading-->
			<!--begin::Form-->
			<form class="d-flex position-relative flex-row-fluid" action="?url_id=requerimientos_detalle&id_requerimientos=<?php echo $id_requerimientos ?>" method="POST" id="avance_bitacora" name="avance_bitacora" enctype="multipart/form-data">
				<div class="input-group shadow-sm">
					<!--begin::Icon-->
					<div class="input-group-prepend">
						<span class="input-group-text bg-white border-0 py-7 px-8">
							<span class="svg-icon svg-icon-primary svg-icon-2x">
								<img src="assets/media/svg/icons/Communication/Group-chat.svg" alt="" />
							</span>
						</span>
					</div>
					<!--end::Icon-->
					<!--begin::Input-->
					<input type="text" class="form-control h-auto border-0 py-7 px-1 font-size-lg" placeholder="Agregar en la Bitacora" id="avance" name="avance" required />
					<input type="hidden" name="formulario" id="formulario" value="avance_bitacora">
					<input type="hidden" name="id_requerimientos" id="id_requerimientos" value="<?php echo $id_requerimientos ?>">
					<!--end::Input-->
					<div class="input-group-prepend">
						<span class="input-group-text bg-white border-0 py-7 px-8">
							<span class="svg-icon svg-icon-primary svg-icon-2x">
								<input type="submit" name="enviar" id="enviar" class="btn btn-success" value="Agregar Bitacora">
								<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_api_key">
									Ver Bitcora
								</a>
							</span>
						</span>
					</div>
				</div>
			</form>
			<!--end::Form-->
		<?
		} else {
		?>
			<h2 class="text-dark font-weight-bolder mb-8">Requerimiento Finalizado!</h2>
		<?
		}
		?>

	</div>
	<!--end::Hero Body-->
</div>
<!--end::Hero-->

<div class="d-flex flex-column flex-xl-row">
	<!--begin::Sidebar-->
	<div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
		<!--begin::Card-->
		<div class="card mb-5 mb-xl-8">
			<!--begin::Card body-->
			<div class="card-body ribbon ribbon-top">
				<div class="ribbon-label bg-warning" style="top: -10px;">
					<b>ESTADO: </b><?php echo $requerimientos["estado"] ?>
				</div>
				<!--begin::Summary-->
				<!--begin::User Info-->
				<div class="d-flex flex-center flex-column py-5">

					<!--begin::Name-->
					<h3 class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-3">Fecha Requerida Limite</h3>
					<!--end::Name-->
					<!--begin::Position-->
					<div class="mb-9">
						<!--begin::Badge-->
						<div class="badge badge-lg badge-light-primary d-inline">
							<?php echo $requerimientos["fecha_estimada_entrega"] ?>
						</div>
						<!--begin::Badge-->
					</div>
					<!--end::Position-->
					<!--begin::Avatar-->
					<div class="symbol symbol-100px symbol-circle mb-7">
						<img src="assets/media/svg/avatars/007-boy-2.svg" alt="image" />
					</div>
					<!--end::Avatar-->

					<?php
					?>
					<div class="fw-bolder mb-3 text-center"><?php echo $personal_solicitado ?>
						<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Persona que solicita el requerimiento"></i>
					</div>
					<div class="fw-bolder mb-3 text-center"><?php echo $nombre_proceso ?>
						<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Nombre del proceso del personal"></i>
					</div>
					<div class="fw-bolder mb-3 text-center"><?php echo $requerimientos_ciudad_sede ?>
						<i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Sede y ciudad de la persoana que solicita el requerimiento "></i>
					</div>
					<!--end::Info heading-->
					<div class="d-flex flex-wrap flex-center">
						<!--begin::Stats-->
						<div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3 flex-center">
							<div class="fs-4 fw-bolder text-gray-700 flex-center">
								<span class="w-75px">
									<small>Tipo de Requerimiento</small>
								</span>
								<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
								<span class="svg-icon svg-icon-3 svg-icon-success">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
										<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
										<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
									</svg>
								</span>
								<!--end::Svg Icon-->
							</div>
							<div class="fw-bold text-muted flex-center" style="text-align: center;"><?php echo nombre_tipo($requerimientos["id_tipo"], $dbm) ?></div>
						</div>
						<!--end::Stats-->
					</div>
					<!--end::Info-->
				</div>
				<!--end::User Info-->
				<!--end::Summary-->
				<!--begin::Details toggle-->
				<div class="d-flex flex-stack fs-8 py-3">
					<div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Categoría del requerimiento
						<span class="ms-2 rotate-180">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
							<span class="svg-icon svg-icon-3">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</span>
					</div>
					<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Tipo de Requerimiento">
						<a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_details"><?php echo nombre_categoria($requerimientos["id_requerimientos_categoria"], $dbm) ?></a>
					</span>
				</div>
				<!--end::Details toggle-->
				<div class="separator"></div>
				<!--begin::Details content-->
				<div id="kt_user_view_details" class="collapse show">
					<div class="pb-5 fs-6">
						<!--begin::Details item-->
						<?php if ($id_procesos == 25 || $id_procesos == 4 && $requerimientos["estado"] == "ENTREGADO" || $requerimientos["estado"] == "FINALIZADO" || $requerimientos["estado"] == "EN GESTION") {
							if ($empresa != "") {
						?>
								<?
								if ($empresa != "Unidad De Salud Ocupacional") {
								?>
									<div class="fw-bolder mt-5">Empresa (Cliente)</div>
									<div class="text-gray-600">
										<?
										echo $empresa;

										?>
									</div>
								<?
								} else {
									echo "";
								}
								?>
							<?
							} else if ($id_terceros != "") {
							?>
								<div class="fw-bolder mt-5">Empresa (Prospecto)</div>
								<div class="text-gray-600"><? echo $nombre_prospecto ?></div>
							<?
							}
							?>
						<?php
						} ?>
						<?php
						if ($requerimientos["detalle_entregado"] == "") {
							$requerimientos["detalle_entregado"] = "No hubo comentario";
						} else {
							$requerimientos["detalle_entregado"] = $requerimientos["detalle_entregado"];
						}
						if ($requerimientos["estado"] == "ENTREGADO") {
						?>
							<div class="fw-bolder mt-5">Detalle entregado:</div>
							<div class="text-gray-600"><? echo $requerimientos["detalle_entregado"] ?></div>
						<?php
						} ?>

						<!--begin::Details item-->
						<div class="fw-bolder mt-5">Proceso Asignado:</div>
						<div class="text-gray-600"><? echo nombre_proceso($requerimientos["id_procesos"], $dbm) ?></div>
						<!--begin::Details item-->
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">Responsable Asignado:</div>
						<div class="text-gray-600"><? echo nombre_personal($requerimientos["id_personal_asignado"], $dbm) ?></div>
						<!--begin::Details item-->
						<!--begin::Details item-->
						<div class="fw-bolder mt-5">Solicitud:</div>
						<div class="text-gray-600"><?php echo $requerimientos["detalle"] ?></div>
						<!--begin::Details item-->
						<?
						if ($_SESSION['id_procesos'] == 23) {
							if ($requerimientos['orden'] != "") {
						?>
								<div class="fw-bolder mt-5">Orden Red Nacional:</div>
								<a target="_blank" class="btn btn-info" href="?url_id=orden_detalle&sede=CALI&id=<? echo $requerimientos['orden'] ?>">Ir a orden</a>
						<?
							}
						}
						?>


						<div class="fw-bolder mt-5">Requerimiento padre:</div>
						<div class="text-gray-600">
							<? if ($id_requerimiento_padre != 'Requerimiento Actual') { ?>
								<a target="_blank" href="?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimiento_padre ?>"><? echo $id_requerimiento_padre ?></a>
							<? } else {
								echo $id_requerimiento_padre;
							} ?>
						</div>
						<?php
						if ($requerimientos_bitacora_padre != "") {
						?>
							<div class="input-group-prepend">
								<span class="input-group-text bg-white border-0 py-7 px-8">
									<span class="svg-icon svg-icon-primary svg-icon-2x">
										<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_api_key_2">
											Ver Bitacora
										</a>
										<input type="hidden" id="id_" name="id_" value="<? echo $id_requerimiento_padre ?>">
									</span>
								</span>
							</div>
						<?
						}
						?>

						<!--begin::Details item-->
						</br>
						</br>
						<!--end::Info heading-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
												<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
												<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
												<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<div class="border border-gray-300 border-dashed rounded py-3 px-8 mb-3">
								<div class="fs-4 fw-bolder text-gray-700 flex-center">
									<span class="w-75px">
										<small>Fecha Solicitud</small>
									</span>
									<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
									<span class="svg-icon svg-icon-3 svg-icon-success">

									</span>
									<!--end::Svg Icon-->
								</div>
								<div class="fw-bold text-muted flex-center" style="text-align: center;"><?php echo $requerimientos["fecha_solicitado"] ?></div>
							</div>
							<!--end::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<?php
										echo diferencia_fecha($requerimientos["fecha_solicitado"], date("Y-m-d h:i:s"));
										?>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
						</div>
						<!--end::Info-->

						<!--end::Info heading-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
												<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
												<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
												<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<div class="border border-gray-300 border-dashed rounded py-3 px-8 mb-3">
								<div class="fs-4 fw-bolder text-gray-700 flex-center">
									<span class="w-75px">
										<small>Fecha Apertura</small>
									</span>
									<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
									<span class="svg-icon svg-icon-3 svg-icon-success">

									</span>
									<!--end::Svg Icon-->
								</div>
								<div class="fw-bold text-muted flex-center" style="text-align: center;"><?php echo $requerimientos["fecha_aperturado"] ?></div>
							</div>
							<!--end::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<?php
										echo diferencia_fecha($requerimientos["fecha_solicitado"], $requerimientos["fecha_aperturado"]);
										?>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
						</div>
						<!--end::Info-->


						<!--end::Info heading-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
												<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
												<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
												<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<div class="border border-gray-300 border-dashed rounded py-3 px-8 mb-3">
								<div class="fs-4 fw-bolder text-gray-700 flex-center">
									<span class="w-75px">
										<small>Fecha Rechazado</small>
									</span>
									<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
									<span class="svg-icon svg-icon-3 svg-icon-success">

									</span>
									<!--end::Svg Icon-->
								</div>
								<div class="fw-bold text-muted flex-center" style="text-align: center;"><?php echo $requerimientos["fecha_rechazado"] ?></div>
							</div>
							<!--end::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<?php
										echo diferencia_fecha($requerimientos["fecha_aperturado"], $requerimientos["fecha_rechazado"]);
										?>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
						</div>
						<!--end::Info-->


						<!--end::Info heading-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
												<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
												<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
												<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<div class="border border-gray-300 border-dashed rounded py-3 px-8 mb-3">
								<div class="fs-4 fw-bolder text-gray-700 flex-center">
									<span class="w-75px">
										<small>Fecha Asignado</small>
									</span>
									<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
									<span class="svg-icon svg-icon-3 svg-icon-success">

									</span>
									<!--end::Svg Icon-->
								</div>
								<div class="fw-bold text-muted flex-center" style="text-align: center;"><?php echo $requerimientos["fecha_asignado"] ?></div>
							</div>
							<!--end::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<?php
										echo diferencia_fecha($requerimientos["fecha_aperturado"], $requerimientos["fecha_asignado"]);
										?>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
						</div>
						<!--end::Info-->


						<!--end::Info heading-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
												<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
												<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
												<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<div class="border border-gray-300 border-dashed rounded py-3 px-8 mb-3">
								<div class="fs-4 fw-bolder text-gray-700 flex-center">
									<span class="w-75px">
										<small>Inicio Gestion</small>
									</span>
									<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
									<span class="svg-icon svg-icon-3 svg-icon-success">

									</span>
									<!--end::Svg Icon-->
								</div>
								<div class="fw-bold text-muted flex-center" style="text-align: center;"><?php echo $requerimientos["fecha_gestion"] ?></div>
							</div>
							<!--end::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<?php
										echo diferencia_fecha($requerimientos["fecha_asignado"], $requerimientos["fecha_gestion"]);
										?>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
						</div>
						<!--end::Info-->


						<!--end::Info heading-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
												<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
												<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
												<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<div class="border border-gray-300 border-dashed rounded py-3 px-8 mb-3">
								<div class="fs-4 fw-bolder text-gray-700 flex-center">
									<span class="w-75px">
										<small>Fecha Entregado</small>
									</span>
									<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
									<span class="svg-icon svg-icon-3 svg-icon-success">

									</span>
									<!--end::Svg Icon-->
								</div>
								<div class="fw-bold text-muted flex-center" style="text-align: center;"><?php echo $requerimientos["fecha_entregado"] ?></div>
							</div>
							<!--end::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<?php
										echo diferencia_fecha($requerimientos["fecha_gestion"], $requerimientos["fecha_entregado"]);
										?>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
						</div>
						<!--end::Info-->

						<!--end::Info heading-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
												<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
												<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
												<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<div class="border border-gray-300 border-dashed rounded py-3 px-8 mb-3">
								<div class="fs-4 fw-bolder text-gray-700 flex-center">
									<span class="w-75px">
										<small>Fecha Inconforme</small>
									</span>
									<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
									<span class="svg-icon svg-icon-3 svg-icon-success">

									</span>
									<!--end::Svg Icon-->
								</div>
								<div class="fw-bold text-muted flex-center" style="text-align: center;"><?php echo $requerimientos["fecha_inconforme"] ?></div>
							</div>
							<!--end::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<?php
										echo diferencia_fecha($requerimientos["fecha_entregado"], $requerimientos["fecha_inconforme"]);
										?>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
						</div>
						<!--end::Info-->

						<!--end::Info heading-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
												<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
												<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
												<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<div class="border border-gray-300 border-dashed rounded py-3 px-8 mb-3">
								<div class="fs-4 fw-bolder text-gray-700 flex-center">
									<span class="w-75px">
										<small>Fecha Finalizado</small>
									</span>
									<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
									<span class="svg-icon svg-icon-3 svg-icon-success">

									</span>
									<!--end::Svg Icon-->
								</div>
								<div class="fw-bold text-muted flex-center" style="text-align: center;"><?php echo $requerimientos["fecha_finalizado"] ?></div>
							</div>
							<!--end::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<?php
										echo diferencia_fecha($requerimientos["fecha_entregado"], $requerimientos["fecha_finalizado"]);
										?>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
						</div>
						<!--end::Info-->


						<!--end::Info heading-->
						<div class="d-flex align-items-center pb-9">
							<!--begin::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
											<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
												<rect x="0" y="0" width="24" height="24" />
												<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
												<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
												<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
												<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
											</g>
										</svg>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
							<div class="border border-gray-300 border-dashed rounded py-3 px-8 mb-3">
								<div class="fs-4 fw-bolder text-gray-700 flex-center">
									<span class="w-75px">
										<small>Fecha Anulado</small>
									</span>
									<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
									<span class="svg-icon svg-icon-3 svg-icon-success">

									</span>
									<!--end::Svg Icon-->
								</div>
								<div class="fw-bold text-muted flex-center" style="text-align: center;"><?php echo $requerimientos["fecha_anulado"] ?></div>
							</div>
							<!--end::Stats-->
							<!--begin::Symbol-->
							<div class="symbol symbol-25 symbol-light mr-3">
								<span class="symbol-label">
									<span class="svg-icon svg-icon-2x svg-icon-dark-50">
										<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
										<?php
										echo diferencia_fecha($requerimientos["fecha_solicitado"], $requerimientos["fecha_anulado"]);
										?>
										<!--end::Svg Icon-->
									</span>
								</span>
							</div>
							<!--end::Symbol-->
						</div>
						<!--end::Info-->



					</div>
				</div>
				<!--end::Details content-->
			</div>
			<!--end::Card body-->
		</div>
	</div>

	<div class="flex-lg-row-fluid ms-lg-15">
		<!--begin::Card-->
		<div class="card mb-5 mb-xl-8">
			<!--Begin::Header-->
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
								<span class="nav-text font-weight-bold">Bitacora</span>
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
						<?
						if ($requerimientos["estado"] != "FINALIZADO" && $requerimientos["estado"] != "ANULADO") {
						?>
							<li class="nav-item mr-3">
								<a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_apps_contacts_view_tab_4">
									<span class="nav-icon mr-2">
										<span class="svg-icon mr-3">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero" />
													<circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</span>
									<span class="nav-text font-weight-bold">Gestion</span>
								</a>
							</li>
							<?
							if ($requerimientos["estado"] == "EN GESTION" && $requerimientos["id_personal_asignado"] == $_SESSION["id_usuario"]) {
							?>
								<li class="nav-item">
									<a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_apps_contacts_view_tab_1">
										<span class="nav-icon mr-2">
											<span class="svg-icon mr-3">
												<!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
														<circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>
										</span>
										<span class="nav-text font-weight-bold">R. Terceros</span>
									</a>
								</li>
							<?
							}
							?>
						<?
						}
						?>
						<?
						if ($_SESSION['id_perfil'] != "CLIENTE" && $requerimientos['estado'] != "ENTREGADO" && $requerimientos['estado'] != "FINALIZADO") {
						?>
							<li class="nav-item mr-3">
								<a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_apps_contacts_view_tab_hijos">
									<span class="nav-icon mr-2">
										<span class="svg-icon mr-3">
											<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero" />
													<circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</span>
									<span class="nav-text font-weight-bold">R. Hijos</span>
								</a>
							</li>
						<?
						}

						?>
						<?
						if ($requerimientos["id_personal_asignado"] == $_SESSION['id_usuario'] && $requerimientos["estado"] == "EN GESTION" && $_SESSION["id_perfil"] != "CLIENTE") {
						?>
							<li class="nav-item mr-3">
								<a class="nav-link text-active-primary" data-bs-toggle="tab" href="#kt_apps_contacts_view_tab_seguimiento">
									<span class="nav-icon mr-2">
										<span class="svg-icon mr-3">
											<!--bsegin::Svg Icon | path:assets/media/svg/icons/Communication/Chat-check.svg-->
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
									<span class="nav-text font-weight-bold">Seguimiento</span>
								</a>
							</li>

						<?
						}

						?>

					</ul>
				</div>
			</div>
			<!--end::Header-->
			<!--Begin::Body-->
			<div class="card-body px-0">
				<div class="tab-content pt-5">
					<!--begin::Tab Content-->
					<div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
						<!--begin::Timeline-->
						<?

						if ($requerimientos["estado"] != "FINALIZADO" && $requerimientos["estado"] != "ANULADO") {
						?>
							<div class="card-body">
								<h4 class="text-center"> AVANCES </h4>
								<BR></BR>
								<form action="" method="post" action="?url_id=requerimientos_detalle" method="POST" id="crear_bitacora" name="crear_bitacora" enctype="multipart/form-data">
									<div class="row">
										<div class="col col-sm-6">
											<select class="form-select form-select-solid fw-bolder" id="id_requerimientos_bitacora_tipo" name="id_requerimientos_bitacora_tipo">
												<option value="" selected="selected">Seleccione</option>
												<?php
												$sql = "SELECT * FROM `intranet_uso`.`requerimientos_bitacora_tipo` WHERE id_procesos = '" . $requerimientos['id_procesos'] . "'";
												$categorias = $dbm->prepare($sql);
												$categorias->execute();

												while ($fi = $categorias->fetch()) {
												?>
													<option value="<?php echo $fi["id"] ?>"><?php echo $fi["nombre"] ?> </option>
												<?
												}
												?>
											</select>
										</div>
										<div class="col col-sm-6">
											<select class="form-select form-select-solid fw-bolder" id="categoria_bitacora" name="categoria_bitacora">
												<option value="" selected="selected">Categoria de Requerimiento</option>
											</select>
										</div>
										<br>

										<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
										<script language="javascript">
											$(document).ready(function() {
												$("#id_requerimientos_bitacora_tipo").on('change', function() {
													$("#id_requerimientos_bitacora_tipo option:selected").each(function() {
														tipo_bitacora = $(this).val();
														$.post("src/ajax/a_requerimientos_detalle.php", {
															tipo_bitacora: tipo_bitacora

														}, function(data) {
															console.log(tipo_bitacora);

															$("#categoria_bitacora").html(data);
														});
													});
												});
											});
										</script>

										<script language="javascript">
											$(document).ready(function() {
												$("#id_requerimientos_bitacora_tipo").on('change', function() {
													$("#id_requerimientos_bitacora_tipo option:selected").each(function() {
														final_bitacora = $(this).val();
														$.post("src/ajax/a_requerimientos_detalle.php", {
															final_bitacora: final_bitacora
														}, function(data) {
															$("#categoria_bitacora").html(data);
														});
													});
												});
											});
										</script>

									</div>
									<br>
									<div class="row">
										<div class="col col-sm-12">
											<div class="form-group mb-4">
												<label class="form-label">Observaciones:</label>
												<textarea class="form-control form-control-solid mb-8" name="observaciones" id="observaciones" cols="2" rows="2"></textarea>
												<!-- <input id="" name="observaciones" type="number" class=" form-control form-control-solid" placeholder="Cantidad" required /> -->
											</div>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Adjuntar Soportes:</span>
										</div>
										<input id="archivo_bitacora[]" name="archivo_bitacora[]" type="file" class="form-control form-control-sm dropzone-select btn btn-light-primary font-weight-bold btn-sm" style="width: 100%">
									</div>
									<br>
									<div class="row">
										<label class="form-label" align="center"> 1 correo a:</label>
										<div class="col col-sm-4">
											<div class="form-group mb-4">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" id="check_correo_proveedor" name="check_correo_proveedor" value="si">
													<label class="form-check-label" for="flexCheckDefault">Proveedor</label>
													<br>
												</div>
											</div>
										</div>
										<div class="col col-sm-4">
											<div class="form-group mb-4">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" id="check_correo_cliente" name="check_correo_cliente" value="si">
													<label class="form-check-label" for="flexCheckDefault">Cliente</label>
												</div>
											</div>
										</div>
										<div class="col col-sm-4">
											<div class="form-group mb-4">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" id="check_correo_alterno" name="check_correo_alterno" value="si">
													<label class="form-check-label" for="flexCheckDefault">Alterno</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col col-sm-4">
											<div class="form-group mb-4">
												<div class="form-check">
													<input class="form-control form-control-solid mb-8" type="text" id="correo_proveedor" name="correo_proveedor" value="<? echo $correo_proveedor['email']; ?>">
												</div>
											</div>
										</div>
										<div class="col col-sm-4">
											<div class="form-group mb-4">
												<div class="form-check">
													<input class="form-control form-control-solid mb-8" type="text" id="correo_cliente" name="correo_cliente" value="<? echo $correo_cliente['email']; ?>">

												</div>
											</div>
										</div>
										<div class="col col-sm-4">
											<div class="form-group mb-4">
												<div class="form-check">
													<input class="form-control form-control-solid mb-8" type="text" id="correo_alterno" name="correo_alterno" onkeyup="espacios_coma()">
												</div>
											</div>
										</div>
									</div>
									<br>
									<div align="center">
										<input type="submit" name="enviar" class="btn btn-primary font-weight-bold text-center" value="Enviar">
										<input type="hidden" name="formulario" id="formulario" value="crear_bitacora">
										<input type="hidden" name="id_procesos" id="id_procesos" value="<?php echo $id_procesos ?>">
										<input type="hidden" name="id_requerimientos" id="id_requerimientos" value="<?php echo $id_requerimientos ?>">
									</div>
								</form>
								<div class="separator separator-dashed my-10"></div>
							</div>
						<?
						}
						?>
						<div class="card-body">

							<div class="timeline">
								<?php
								if ($requerimientos_bitacora_tab != "") {
									# code...
									while ($fila = $requerimientos_bitacora_tab->fetch()) {
								?>
										<div class="timeline-item">
											<div class="timeline-line w-40px"></div>
											<div class="timeline-icon symbol symbol-circle symbol-40px">
												<div class="symbol-label bg-light">
													<span class="svg-icon svg-icon-2x svg-icon-<?php echo $fila["color"] ?>">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M8.39961 20.5073C7.29961 20.5073 6.39961 19.6073 6.39961 18.5073C6.39961 17.4073 7.29961 16.5073 8.39961 16.5073H9.89961C11.7996 16.5073 13.3996 14.9073 13.3996 13.0073C13.3996 11.1073 11.7996 9.50732 9.89961 9.50732H8.09961L6.59961 11.2073C6.49961 11.3073 6.29961 11.4073 6.09961 11.5073C6.19961 11.5073 6.19961 11.5073 6.29961 11.5073H9.79961C10.5996 11.5073 11.2996 12.2073 11.2996 13.0073C11.2996 13.8073 10.5996 14.5073 9.79961 14.5073H8.39961C6.19961 14.5073 4.39961 16.3073 4.39961 18.5073C4.39961 20.7073 6.19961 22.5073 8.39961 22.5073H15.3996V20.5073H8.39961Z" fill="black" />
															<path opacity="0.3" d="M8.89961 8.7073L6.69961 11.2073C6.29961 11.6073 5.59961 11.6073 5.19961 11.2073L2.99961 8.7073C2.19961 7.8073 1.7996 6.50732 2.0996 5.10732C2.3996 3.60732 3.5996 2.40732 5.0996 2.10732C7.6996 1.50732 9.99961 3.50734 9.99961 6.00734C9.89961 7.00734 9.49961 8.0073 8.89961 8.7073Z" fill="black" />
															<path d="M5.89961 7.50732C6.72804 7.50732 7.39961 6.83575 7.39961 6.00732C7.39961 5.1789 6.72804 4.50732 5.89961 4.50732C5.07119 4.50732 4.39961 5.1789 4.39961 6.00732C4.39961 6.83575 5.07119 7.50732 5.89961 7.50732Z" fill="black" />
															<path opacity="0.3" d="M17.3996 22.5073H15.3996V13.5073C15.3996 12.9073 15.7996 12.5073 16.3996 12.5073C16.9996 12.5073 17.3996 12.9073 17.3996 13.5073V22.5073Z" fill="black" />
															<path d="M21.3996 18.5073H15.3996V13.5073H21.3996C22.1996 13.5073 22.5996 14.4073 22.0996 15.0073L21.2996 16.0073L22.0996 17.0073C22.6996 17.6073 22.1996 18.5073 21.3996 18.5073Z" fill="black" />
														</svg>
													</span>
												</div>
											</div>
											<div class="timeline-content mb-10 mt-n2">
												<div class="overflow-auto pe-3">
													<div class="d-flex align-items-center mt-1 fs-6">
														<div class="text-muted me-2 fs-8"><?php echo $fila["fecha"] ?></div>
													</div>
													<div class="fs-5 fw-bold mb-2">
														<?php
														echo $fila["detalle"];
														?></div>
													<div class="d-flex align-items-center mt-1 fs-6">
														<div class="text-muted me-2 fs-8"><?php echo nombre_personal($fila["id_personal"], $dbm) ?></div>
														<div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Tipo de Notificacion">
															<small><?php echo $fila["tipo"] ?></small>
														</div>
													</div>
												</div>
											</div>
										</div>
								<?php
									}
								}
								?>

							</div>
						</div>
						<!--end::Timeline-->
					</div>
					<!--end::Tab Content-->
					<!--begin::Tab Content-->
					<div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
						<div class="card-body">
							<h2>Anexar documentos</h2>
							<br>
							<br>
							<?
							$responsable_proceso = responsable_proceso($id_procesos, $dbm);
							// var_dump($requerimientos["estado"]);
							if ($requerimientos["estado"] == "FINALIZADO" || $requerimientos["estado"] == "ENTREGADO") {
								// var_dump($requerimientos['estado']);
							} else {
								if ($_SESSION['id_usuario'] == $email_cliente_bd["id_personal_solicitado"] || $_SESSION['id_usuario'] == $email_cliente_bd["id_personal_asignado"] || $_SESSION['id_usuario'] == $responsable_proceso) {
							?>
									<form class="form" action="?url_id=<? echo $url_id ?>" method="POST" id="cargue_anexos" name="cargue_anexos" enctype="multipart/form-data">
										<input type="hidden" name="formulario" id="formulario" value="cargue_anexos">
										<input type="hidden" name="id_requerimientos" id="id_requerimientos" value="<?php echo $id_requerimientos; ?>">
										<div class="form-group mb-6">
											<input id="archivo[]" name="archivo[]" type="file" class="form-control form-control-sm dropzone-select btn btn-light-primary font-weight-bold btn-sm" data-show-upload="true" data-show-caption="true" multiple>
										</div>
										<div align="center">
											<input type="submit" name="enviar" class="btn btn-primary font-weight-bold" value="Guardar anexo">
											<input type="hidden" name="formulario" id="formulario" value="cargue_anexos">
										</div>
									</form>
							<?
								}
							}
							?>
							<div class="row">
								<?php
								$ruta = "adjuntos/requerimientos/" . $id_requerimientos;
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
																<img alt="" class="max-h-65px" src="assets/media/svg/files/doc.svg" />
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

					<div class="tab-pane" id="kt_apps_contacts_view_tab_seguimiento" role="tabpanel">
						<div class="card-body">
							<h2>Seguimiento</h2>
							<br>
							<div class="card">
								<!--begin::Card header-->
								<div class="card-header border-0 pt-6">
									<!--begin::Card title-->
									<div class="col card-title">
										<!--begin::Search-->
										<div class="d-flex align-items-center position-relative my-1">
											<span class="svg-icon svg-icon-1 position-absolute ms-4">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"></path>
												</svg>
											</span>
											<input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Buscar..." />
										</div>
										<!--end::Search-->
										<!--begin::Export buttons-->
										<div id="kt_datatable_requerimientos_export" class=""></div>
										<!--end::Export buttons-->
									</div>
									<!--begin::Card title-->



									<div id="kt_datatable_requerimientos_export_menu" class="col-1 menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px me-6 py-4" data-kt-menu="true">
										<a type="button" class="btn btn-light-primary me-3 indicator-label btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary" data-kt-export="excel">
											<!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
											<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black"></rect>
													<path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black"></path>
													<path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4"></path>
												</svg>
											</span>
											<!--end::Svg Icon-->Exportar XLS
										</a>
									</div>
								</div>
								<!--end::Card header-->
								<!--begin::Card body-->
								<div class="card-body pt-0">
									<div class="table-responsive">
										<!--begin::Table-->
										<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable_requerimientos">
											<!--begin::Table head-->
											<thead>
												<!--begin::Table row-->
												<tr class="text-start text-gray-400 fw-bolder fs-7 gs-0">
													<th>Ver</th>
													<th class="min-w-125px">Tipo</th>
													<th class="min-w-125px max-w-125px"><b>Detalle</th>
													<th class="min-w-125px max-w-125px"><b>Fecha</th>
													<th class="min-w-125px max-w-125px"><b>Personal</th>
												</tr>
												<!--end::Table row-->
											</thead>
											<!--end::Table head-->
											<!--begin::Table body-->
											<tbody class="fw-bold text-gray-600">
												<!-- Contenido tabla -->

												<?php
												// var_dump($requerimientos_tipo_categoria->fetch());
												while ($fila = $requerimientos_bitacora_seguimiento->fetch()) {
												?>
													<tr>
														<td></td>
														<td style="width: 5px;font-weight: bold;">
															<p>
																<?php echo $fila['tipo'] ?>
															</p>
														</td>
														<td style="width: 5px;">
															<p>
																<?php echo $fila['detalle'] ?>

															</p>
														</td>
														<td style="width: 5px;">
															<p>
																<?php echo $fila['fecha'] ?>
															</p>
														</td>
														<td style="width: 5px;">
															<p>
																<!-- <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger me-3"> -->
																<? echo nombre_personal($fila['id_personal'], $dbm) ?>
																<!-- </button> -->
															</p>
														</td>
													</tr>
												<?php
												}
												?>

											</tbody>
										</table>
										<!--end::Table-->
									</div>
								</div>
								<!--end::Card body-->
							</div>
						</div>
					</div>
					<!--end::Tab Content-->
					<!--begin::Tab Content-->
					<div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
						<div class="container">
							<form class="form" action="?url_id=requerimientos_detalle" method="POST" id="editar_requerimiento" name="editar_requerimiento" enctype="multipart/form-data">
								<input type="hidden" name="formulario" id="formulario" value="editar_requerimiento">
								<input type="hidden" name="id_requerimientos" id="id_requerimientos" value="<?php echo $id_requerimientos ?>">
								<?
								if ($requerimientos["estado"] == "SOLICITADO" && $requerimientos["id_personal_solicitado"] == $_SESSION["id_usuario"]) {
								?>
									<input type="hidden" name="bloque" id="bloque" value="anular">
									<div class="row">
										<div class="col-lg-12 col-xl-12" align="center">
											<h3 class="font-size-h5 mb-5">Anular Requerimiento:</h3>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Anular:</span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="switch">
												<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
													<input class="form-check-input" type="checkbox" id="anular" name="anular" value="SI" />
												</label>
											</span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700"></span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 " align="left">
											<span class="input">
												<label style="background-color: red;">
													<span><? echo $requerimientos["detalle_rechazado"] ?></span>
												</label>
											</span>
										</div>
									</div>
									</br>
									</br>
									<div class="form-group row">
										<div class="col-lg-12 col-xl-12" align="center">
											<span class="input">
												<label>
													<input type="submit" name="enviar" class="btn btn-primary font-weight-bold" value="Enviar">
													<span>-</span>
													<button type="reset" name="reset" class="btn btn-danger font-weight-bold">Borrar</button>
												</label>
											</span>
										</div>
									</div>
									<div class="separator separator-dashed my-10"></div>
								<?
								}
								?>

								<?
								if ($requerimientos["estado"] == "APERTURADO" && ($requerimientos["id_personal_aperturado"] == $_SESSION["id_usuario"]  ||  $_SESSION["responsable_proceso"] == $requerimientos["id_procesos"])) {
								?>
									<input type="hidden" name="bloque" id="bloque" value="aperturado">
									<div class="row">
										<div class="col-lg-12 col-xl-12" align="center">
											<h3 class="font-size-h5 mb-5">Apertura Requerimiento:</h3>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Rechazar:</span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="switch">
												<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
													<input class="form-check-input" type="checkbox" value="SI" id="rechazar" name="rechazar" />
												</label>
											</span>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Comentario:</span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="textarea">
												<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
													<textarea class="md-textarea form-control" rows="3" id="comentario" name="comentario"></textarea>
												</label>
											</span>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Nº Prioridad:</span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="textarea">
												<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
													<input type="number" id="n_prioridad" name="n_prioridad" class="form-control form-control-solid">
												</label>
											</span>
										</div>
									</div>


									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Asignar:</span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="select">
												<select id="id_personal_asignado" name="id_personal_asignado" data-control="select2" data-hide-search="true" data-placeholder="Seleccionar Personal..." class="form-select form-select-solid">
													<option value=""> Seleccionar...</option>

													<?php

													while ($filas = $integrantes_proceso->fetch()) {
														if ($filas['id'] == $requerimientos["id_personal_asignado"]) {
													?>
															<option value="<? echo $filas['id'] ?>" selected><? echo $filas['nombre_completo'] ?></option>
														<?php
														} else {
														?>
															<option value="<? echo $filas['id'] ?>"><? echo $filas['nombre_completo'] ?></option>
													<?php
														}
													}
													?>
												</select>
											</span>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700"></span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="input">
												<label>
													<span></span>
												</label>
											</span>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-lg-12 col-xl-12" align="center">
											<span class="input">
												<label>
													<input type="submit" name="enviar" class="btn btn-primary font-weight-bold" value="Enviar">
													<span>-</span>
													<button type="reset" name="reset" class="btn btn-danger font-weight-bold">Borrar</button>
												</label>
											</span>
										</div>
									</div>
									<div class="separator separator-dashed my-10"></div>
								<?
								}
								?>

								<?
								if ($requerimientos["estado"] == "EN GESTION" && $requerimientos["id_personal_asignado"] == $_SESSION["id_usuario"]) {
								?>
									<input type="hidden" name="bloque" id="bloque" value="entregar">
									<div class="row">
										<div class="col-lg-12 col-xl-12" align="center">
											<h3 class="font-size-h5 mb-5">Entregar Requerimiento:</h3>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Entregar:</span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="switch">
												<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
													<input required class="form-check-input" type="checkbox" id="entregar" name="entregar" value="SI" />
												</label>
											</span>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Comentario:</span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="textarea">
												<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
													<textarea id="form7" class="md-textarea form-control" id="comentario" name="comentario" rows="3"></textarea>
												</label>
											</span>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Adjuntar Soportes:</span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="input">
												<label>
													<input id="archivo[]" name="archivo[]" type="file" class="form-control form-control-sm dropzone-select btn btn-light-primary font-weight-bold btn-sm" data-show-upload="true" data-show-caption="true" multiple style="width: 100%">
												</label>
											</span>
										</div>
									</div>

									<br>

									<!-- <div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Email alternativo:</span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="switch">
												<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
													<input class="form-check-input" type="checkbox" id="check_alterno" name="check_alterno" value="si" />
												</label>
											</span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right"> -->
									<!-- <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Email alternativo:</span> -->
									<!-- </div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="switch">
												<input id="correo_alterno_1" name="correo_alterno_1" type="text" class="form-control form-control-solid" placeholder="Email Alterno" value="<? echo $requerimientos["email_alterno"] ?>" onkeyup="espacios_coma()" />
											</span>
										</div>
									</div> -->
									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700"></span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="input">
												<label>
													<span></span>
												</label>
											</span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700"></span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 " align="left">
											<span class="input">
												<label style="background-color: yellow;">
													<span><? echo $requerimientos["detalle_asignado"] ?></span>
												</label>
											</span>
										</div>
									</div>
									</br>
									</br>
									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700"></span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 " align="left">
											<span class="input">
												<label style="background-color: red;">
													<span><? echo $requerimientos["detalle_inconforme"] ?></span>
												</label>
											</span>
										</div>
									</div>
									</br>
									</br>
									<div class="form-group row">
										<div class="col-lg-12 col-xl-12" align="center">
											<span class="input">
												<label>
													<input type="submit" name="enviar" class="btn btn-primary font-weight-bold" value="Enviar">
													<span>-</span>
													<button type="reset" name="reset" class="btn btn-danger font-weight-bold">Borrar</button>
												</label>
											</span>
										</div>
									</div>
									<div class="separator separator-dashed my-10"></div>
								<?
								}
								?>

								<?
								if ($requerimientos["estado"] == "ENTREGADO" && $requerimientos["id_personal_solicitado"] == $_SESSION["id_usuario"]) {
								?>
									<input type="hidden" name="bloque" id="bloque" value="finalizar">
									<div class="row">
										<div class="col-lg-12 col-xl-12" align="center">
											<h3 class="font-size-h5 mb-5">Finalizar Requerimiento:</h3>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Rechazar y devolver:</span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="switch">
												<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
													<input class="form-check-input" type="checkbox" id="inconforme" name="inconforme" value="SI" />
												</label>
											</span>
											<span class="form-text text-muted">Devolver el requerimiento a etapa EN GESTION!</span>
										</div>
									</div>

									<div class="separator separator-dashed"></br></div>
									<div class="separator separator-dashed"></br></div>

									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Aceptar Requerimiento:</span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">

											<div class="radio-inline">
												<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
													<div class="d-flex my-3 ms-9">
														<label class="form-check form-check-custom form-check-solid me-5">
															<input class="form-check-input" type="radio" name="calificacion" value="3" />
															<span></span>
															Totalmente Satisfecho
														</label>
													</div>
													<div class="d-flex my-3 ms-9">
														<label class="form-check form-check-custom form-check-solid me-5">
															<input class="form-check-input" type="radio" name="calificacion" value="2" />
															<span></span>
															Medianamente Satisfecho
														</label>
													</div>
													<div class="d-flex my-3 ms-9">
														<label class="form-check form-check-custom form-check-solid me-5">
															<input class="form-check-input" type="radio" name="calificacion" value="1" />
															<span></span>
															Insatisfecho, pero igual lo acepto!
														</label>
													</div>
												</label>
												<span class="form-text text-muted">Aceptar el requerimiento y califique su nivel de satisfacción</span>
											</div>
										</div>
									</div>


									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700">Comentario:</span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="textarea">
												<label class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack mb-5">
													<textarea id="comentario" name="comentario" class="md-textarea form-control" rows="3"></textarea>
												</label>
											</span>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" align="right">
											<span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700"></span>
										</div>
										<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-xs-9 ">
											<span class="input">
												<label>
													<span></span>
												</label>
											</span>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-lg-12 col-xl-12" align="center">
											<span class="input">
												<label>
													<input type="submit" name="enviar" class="btn btn-primary font-weight-bold" value="Enviar">
													<span>-</span>
													<button type="reset" name="reset" class="btn btn-danger font-weight-bold">Borrar</button>
												</label>
											</span>
										</div>
									</div>
									<div class="separator separator-dashed my-10"></div>
								<?
								}
								?>
							</form>
						</div>
					</div>
					<!--end::Tab Content-->
					<!--begin::Tab Content-->
					<div class="tab-pane" id="kt_apps_contacts_view_tab_1" role="tabpanel">
						<div class="card pt-2 mb-6 mb-xl-9">
							<!--begin::Card header-->
							<div class="card-header border-0">
								<!--begin::Card title-->
								<div class="card-title flex-column">
									<h2>Terceros Relacionados al Requerimientos</h2>
									<!-- <div class="fs-6 fw-bold text-muted">Choose what messages you’d like to receive for each of your accounts.</div> -->
								</div>
								<!--end::Card title-->
							</div>

							<!--end::Card header-->
							<!--begin::Card body-->
							<div class="card-body">



								<!--begin::Form-->
								<form class="form" id="actualizar_requerimiento_terceros" name="actualizar_requerimiento_terceros" action="?url_id=requerimientos_detalle" method="POST">
									<input type="hidden" name="formulario" id="formulario" value="actualizar_requerimiento_terceros">
									<input type="hidden" name="id_requerimientos" id="id_requerimientos" value="<? echo $id_requerimientos ?>">
									<!--begin::Item-->
									<div class="d-flex mb-9">
										<div class="row justify-content-between">
											<div class="col-6">
												<!--begin::Select-->
												<label class="fs-5 fw-bold mb-2">Empresa:</label>
												<!--end::Label-->
												<!--begin::Select-->
												<link rel="stylesheet" type="text/css" href="../plugins/select2/select2.min.css">
												<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
												<script src="../plugins/select2/select2.min.js"></script>
												<select class="empresa form-select form-select-solid" name="empresa" id="empresa" data-kt-select2="true">
													<option value="">Seleccionar Tercero a Relacionar..</option>
													<?php

													$sql = "SELECT idempresa , empresa  FROM   unidadso.empresas  ORDER BY  empresa ASC";
													$empresas =  $dbm_sicuso->prepare($sql);
													$empresas->execute();
													while ($filas = $empresas->fetch()) {
														if ($filas['empresa'] == $requerimientos["empresa"]) {
													?>
															<option value="<? echo $filas['empresa'] ?>" selected><? echo $filas['empresa'] ?></option>
														<?php
														} else {
														?>
															<option value="<? echo $filas['empresa'] ?>"><? echo $filas['empresa'] ?></option>
													<?php  }
													} ?>
												</select>

												<!--end::Select-->
											</div>
											<div class="col-6">
												<div class="mb-0">
													<label class="fs-5 fw-bold mb-2">Nombre Contacto:</label>
													<input id="empresa_contacto" name="empresa_contacto" type="text" class="form-control form-control-solid" placeholder="Nombre de Contacto" value="<? echo $requerimientos["empresa_contacto"] ?>" />
												</div>
											</div>
											<div class="col-6">
												<div class="mb-0">
													<label class="fs-5 fw-bold mb-2">Nombre Paciente:</label>
													<input id="paciente" name="paciente" type="text" class="form-control form-control-solid" placeholder="Nombre de Paciente" value="<? echo $requerimientos["paciente"] ?>" />
												</div>
											</div>
											<div class="col-6">
												<div class="mb-0">
													<label class="fs-5 fw-bold mb-2">Identificacion Paciente:</label>
													<input id="paciente_identificacion" name="paciente_identificacion" type="number" class="form-control form-control-solid" placeholder="Identificacion de Paciente" value="<? echo $requerimientos["paciente_identificacion"] ?>" />
												</div>
											</div>
											<div class="col-6">
												<div class="mb-0">
													<label class="fs-5 fw-bold mb-2">Cantidad:</label>
													<input id="cantidad" name="cantidad" type="number" class="form-control form-control-solid" placeholder="Cantidad" value="<? echo $requerimientos["cantidad"] ?>" />
												</div>
											</div>
											<div class="form-group row">
												<div class="col-lg-12 col-xl-12" align="center">
													<span class="input">
													</span>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-lg-12 col-xl-12" align="center">
													<span class="input">
														<label>
															<input type="submit" name="enviar" class="btn btn-primary font-weight-bold" value="Actualizar">
														</label>
													</span>
												</div>
											</div>
										</div>
									</div>
									<!--end::Item-->
								</form>
							</div>
							<!--end::Card body-->
							<!--begin::Card footer-->
							<!--end::Card footer-->
						</div>
						<!--end::Card-->
					</div>
					<!--end::Tab Content-->
					<div class="tab-pane" id="kt_apps_contacts_view_tab_hijos" role="tabpanel">
						<div class="container">
							<!--begin::Timeline-->

							<div class="card-body">
								<!--------------------------------------------------------------------->
								<div class="row">
									<div class="col-lg-12 col-xl-12" align="center">
										<h3 class="font-size-h5 mb-5">Requerimientos Hijos</h3>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 col-xl-12" align="center">
										<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_api_key_hijos">
											Crear Requerimiento Hijo
										</a>
									</div>
								</div>
								<!--begin::Table-->
								<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
									<!--begin::Table head-->
									<thead>
										<!--begin::Table row-->
										<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
											<th class="min-w-50px">Nº Req</th>
											<th class="min-w-125px">Solicitud</th>
											<th class="min-w-125px"><b>Mis Requerimientos </b>(Radicados)</th>
											<th class="min-w-125px text-center">Estado</th>
										</tr>

										<!--end::Table row-->
									</thead>
									<!--end::Table head-->
									<!--begin::Table body-->
									<tbody class="fw-bold text-gray-600">

										<?php

										while ($fila = $requerimientos_hijos->fetch()) {
										?>
											<tr>
												<td>
													<a href="?url_id=requerimientos_detalle&id_requerimientos=<?php echo $fila["id"] ?>" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
														<?php echo $fila["id"] ?>
													</a>
												</td>
												<td>
													<div style="width: 100px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-xs">
														<b><?php echo nombre_tipo($fila["id_tipo"], $dbm) ?></b>
													</div>
													<span class="text-muted font-weight-bold d-block font-size-xs">
														<?php echo $fila["fecha_solicitado"] ?>
													</span>
												</td>
												<td>
													<div style="width: 150px; white-space: nowrap; text-overflow: ellipsis; overflow: hidden;" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-xs">
														<?php echo $fila["detalle"] ?>
													</div>
													<span class="text-muted font-weight-bold d-block font-size-sm">
														<b>Prioridad: </b>
														<?php echo $fila["prioridad"] ?>
													</span>
												</td>
												<td class="text-center">
													<?php color_estado($fila["estado"])	?>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
								<!--end::Table-->

							</div>
							<!--end::Timeline-->
						</div>
					</div>
				</div>
			</div>
			<!--end::Body-->
		</div>
		<!--end::Card-->




		<!-- Modal-->


		<div class="modal fade" id="kt_modal_create_api_key" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable" role="document">
				<div class="modal-content">
					<div class="modal-header ribbon ribbon-top">
						<div class="ribbon-target bg-warning" style="top: -1px; right: 40px;">
							ESTADO:<b><?php echo $requerimientos["estado"] ?></b>
						</div>
						<h5 class="modal-title" id="exampleModalLabel">Bitacora Requerimiento ID° <? echo $id_requerimientos ?></h5>
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Close-->
					</div>
					<div class="modal-body" style="height: 300px;">
						<!--begin::Timeline-->

						<div class="card-body">
							<div class="timeline">
								<?php
								if ($requerimientos_bitacora != "") {
									while ($fila = $requerimientos_bitacora->fetch()) {
								?>
										<div class="timeline-item">
											<div class="timeline-line w-40px"></div>
											<div class="timeline-icon symbol symbol-circle symbol-40px">
												<div class="symbol-label bg-light">
													<span class="svg-icon svg-icon-2x svg-icon-<?php echo $fila["color"] ?>">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M8.39961 20.5073C7.29961 20.5073 6.39961 19.6073 6.39961 18.5073C6.39961 17.4073 7.29961 16.5073 8.39961 16.5073H9.89961C11.7996 16.5073 13.3996 14.9073 13.3996 13.0073C13.3996 11.1073 11.7996 9.50732 9.89961 9.50732H8.09961L6.59961 11.2073C6.49961 11.3073 6.29961 11.4073 6.09961 11.5073C6.19961 11.5073 6.19961 11.5073 6.29961 11.5073H9.79961C10.5996 11.5073 11.2996 12.2073 11.2996 13.0073C11.2996 13.8073 10.5996 14.5073 9.79961 14.5073H8.39961C6.19961 14.5073 4.39961 16.3073 4.39961 18.5073C4.39961 20.7073 6.19961 22.5073 8.39961 22.5073H15.3996V20.5073H8.39961Z" fill="black" />
															<path opacity="0.3" d="M8.89961 8.7073L6.69961 11.2073C6.29961 11.6073 5.59961 11.6073 5.19961 11.2073L2.99961 8.7073C2.19961 7.8073 1.7996 6.50732 2.0996 5.10732C2.3996 3.60732 3.5996 2.40732 5.0996 2.10732C7.6996 1.50732 9.99961 3.50734 9.99961 6.00734C9.89961 7.00734 9.49961 8.0073 8.89961 8.7073Z" fill="black" />
															<path d="M5.89961 7.50732C6.72804 7.50732 7.39961 6.83575 7.39961 6.00732C7.39961 5.1789 6.72804 4.50732 5.89961 4.50732C5.07119 4.50732 4.39961 5.1789 4.39961 6.00732C4.39961 6.83575 5.07119 7.50732 5.89961 7.50732Z" fill="black" />
															<path opacity="0.3" d="M17.3996 22.5073H15.3996V13.5073C15.3996 12.9073 15.7996 12.5073 16.3996 12.5073C16.9996 12.5073 17.3996 12.9073 17.3996 13.5073V22.5073Z" fill="black" />
															<path d="M21.3996 18.5073H15.3996V13.5073H21.3996C22.1996 13.5073 22.5996 14.4073 22.0996 15.0073L21.2996 16.0073L22.0996 17.0073C22.6996 17.6073 22.1996 18.5073 21.3996 18.5073Z" fill="black" />
														</svg>
													</span>
												</div>
											</div>
											<div class="timeline-content mb-10 mt-n2">
												<div class="overflow-auto pe-3">
													<div class="d-flex align-items-center mt-1 fs-6">
														<div class="text-muted me-2 fs-8"><?php echo $fila["fecha"] ?></div>
													</div>
													<div class="fs-5 fw-bold mb-2"><?php echo $fila["detalle"] ?></div>
													<div class="d-flex align-items-center mt-1 fs-6">
														<div class="text-muted me-2 fs-8"><?php echo nombre_personal($fila["id_personal"], $dbm) ?></div>
														<div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Tipo de Notificacion">
															<small><?php echo $fila["tipo"] ?></small>
														</div>
													</div>
												</div>
											</div>
										</div>
								<?php
									}
								}
								?>

							</div>
						</div>
						<!--end::Timeline-->
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="kt_modal_create_api_key_2" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable" role="document">
				<div class="modal-content">
					<div class="modal-header ribbon ribbon-top">
						<div class="ribbon-target bg-warning" style="top: -1px; right: 40px;">
							ESTADO:<b><?php echo $requerimientos_padre_estado_1["estado"] ?></b>
						</div>
						<h5 class="modal-title" id="exampleModalLabel">Bitacora Requerimiento ID° <? echo $id_requerimiento_padre ?></h5>
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Close-->
					</div>
					<div class="modal-body" style="height: 300px;">
						<!--begin::Timeline-->

						<div class="card-body">
							<div class="timeline">
								<?php
								if ($requerimientos_bitacora_padre != "") {
									# code...
									while ($fila = $requerimientos_bitacora_padre->fetch()) {
								?>
										<div class="timeline-item">
											<div class="timeline-line w-40px"></div>
											<div class="timeline-icon symbol symbol-circle symbol-40px">
												<div class="symbol-label bg-light">
													<span class="svg-icon svg-icon-2x svg-icon-<?php echo $fila["color"] ?>">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<path d="M8.39961 20.5073C7.29961 20.5073 6.39961 19.6073 6.39961 18.5073C6.39961 17.4073 7.29961 16.5073 8.39961 16.5073H9.89961C11.7996 16.5073 13.3996 14.9073 13.3996 13.0073C13.3996 11.1073 11.7996 9.50732 9.89961 9.50732H8.09961L6.59961 11.2073C6.49961 11.3073 6.29961 11.4073 6.09961 11.5073C6.19961 11.5073 6.19961 11.5073 6.29961 11.5073H9.79961C10.5996 11.5073 11.2996 12.2073 11.2996 13.0073C11.2996 13.8073 10.5996 14.5073 9.79961 14.5073H8.39961C6.19961 14.5073 4.39961 16.3073 4.39961 18.5073C4.39961 20.7073 6.19961 22.5073 8.39961 22.5073H15.3996V20.5073H8.39961Z" fill="black" />
															<path opacity="0.3" d="M8.89961 8.7073L6.69961 11.2073C6.29961 11.6073 5.59961 11.6073 5.19961 11.2073L2.99961 8.7073C2.19961 7.8073 1.7996 6.50732 2.0996 5.10732C2.3996 3.60732 3.5996 2.40732 5.0996 2.10732C7.6996 1.50732 9.99961 3.50734 9.99961 6.00734C9.89961 7.00734 9.49961 8.0073 8.89961 8.7073Z" fill="black" />
															<path d="M5.89961 7.50732C6.72804 7.50732 7.39961 6.83575 7.39961 6.00732C7.39961 5.1789 6.72804 4.50732 5.89961 4.50732C5.07119 4.50732 4.39961 5.1789 4.39961 6.00732C4.39961 6.83575 5.07119 7.50732 5.89961 7.50732Z" fill="black" />
															<path opacity="0.3" d="M17.3996 22.5073H15.3996V13.5073C15.3996 12.9073 15.7996 12.5073 16.3996 12.5073C16.9996 12.5073 17.3996 12.9073 17.3996 13.5073V22.5073Z" fill="black" />
															<path d="M21.3996 18.5073H15.3996V13.5073H21.3996C22.1996 13.5073 22.5996 14.4073 22.0996 15.0073L21.2996 16.0073L22.0996 17.0073C22.6996 17.6073 22.1996 18.5073 21.3996 18.5073Z" fill="black" />
														</svg>
													</span>
												</div>
											</div>
											<div class="timeline-content mb-10 mt-n2">
												<div class="overflow-auto pe-3">
													<div class="d-flex align-items-center mt-1 fs-6">
														<div class="text-muted me-2 fs-8"><?php echo $fila["fecha"] ?></div>
													</div>
													<div class="fs-5 fw-bold mb-2"><?php echo $fila["detalle"] ?></div>
													<div class="d-flex align-items-center mt-1 fs-6">
														<div class="text-muted me-2 fs-8"><?php echo nombre_personal($fila["id_personal"], $dbm) ?></div>
														<div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip" data-bs-boundary="window" data-bs-placement="top" title="Tipo de Notificacion">
															<small><?php echo $fila["tipo"] ?></small>
														</div>
													</div>
												</div>
											</div>
										</div>
								<?php
									}
								}

								?>

							</div>
						</div>
						<!--end::Timeline-->
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="kt_modal_create_api_key_hijos" tabindex="-1" aria-hidden="true">
			<!--begin::Modal dialog-->
			<div class="modal-dialog modal-dialog-centered mw-900px">
				<!--begin::Modal content-->
				<div class="modal-content">
					<!--begin::Modal header-->
					<div class="modal-header">
						<!--begin::Modal title-->
						<h4 align="justify">Requerimiento Hijo</h4>
						<!--end::Modal title-->
						<!--begin::Close-->
						<div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-1">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
						<!--end::Close-->
					</div>
					<!--end::Modal header-->
					<!--begin::Modal body-->
					<div class="modal-body py-lg-10 px-lg-10">

						<div class="alert alert-primary d-flex align-items-center p-5">
							<!--begin::Icon-->
							<span class="svg-icon svg-icon-primary svg-icon-3x">
								<!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Code/Warning-1-circle.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
										<rect fill="#000000" x="11" y="7" width="2" height="8" rx="1" />
										<rect fill="#000000" x="11" y="16" width="2" height="2" rx="1" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>
							<div class="d-flex flex-column">
								<h4></h4>
							</div>
							<!--begin::Wrapper-->
							<div class="d-flex flex-column">
								<!--begin::Title-->
								<h4 class="mb-1 text-dark">Necesitas un requerimiento hijo?</h4>
								<!--end::Title-->
								<!--begin::Content-->
								<span>Diligencia este formulario para radicar tu solicitud</span>
								<!--end::Content-->
							</div>
							<!--end::Wrapper-->
						</div>
						<!--begin::Stepper-->
						<br>
						<form class="form" action="?url_id=requerimientos_detalle&id_requerimientos=<? echo $id_requerimientos ?>" method="POST" id="crear_requerimiento_hijo" name="crear_requerimiento_hijo" enctype="multipart/form-data">
							<?
							if ($_SESSION["id_perfil"] != "CLIENTE") {
								$sql = "SELECT * FROM `intranet_uso`.`procesos` WHERE `estado` = '1' ORDER BY `nombre`";
								$procesos = $dbm->prepare($sql);
								$procesos->execute();
							?>
								<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
								<script language="javascript">
									$(document).ready(function() {
										$("#id_procesos_hijos").on('change', function() {
											$("#id_procesos_hijos option:selected").each(function() {
												elegido = $(this).val();
												console.log(elegido);
												$.post("src/ajax/a_requerimientos_detalle.php", {
													elegido: elegido
												}, function(data) {
													$("#tipo_proceso_hijos").html(data);
												});
											});
										});
									});
								</script>

								<script language="javascript">
									$(document).ready(function() {
										$("#tipo_proceso_hijos").on('change', function() {
											$("#tipo_proceso_hijos option:selected").each(function() {
												final = $(this).val();
												console.log(final);

												$.post("src/ajax/a_requerimientos_detalle.php", {
													final: final
												}, function(data) {
													$("#categoria_proceso_hijos").html(data);
												});
											});
										});
									});
								</script>
								<?

								if (isset($_POST["id_requerimientos"]) && $_POST["id_requerimientos"] != "") {
									$id_requerimientos = $_POST["id_requerimientos"];
								} else if (isset($_GET["id_requerimientos"]) && $_GET["id_requerimientos"] != "") {
									$id_requerimientos = $_GET["id_requerimientos"];
								}

								$id_requerimiento_padre = "";

								if (isset($id_requerimientos) && $id_requerimientos >= 1) {
									$id_requerimiento_padre = $id_requerimientos;
								}
								?>
								<input type="hidden" name="origen" id="origen" value="SICUSO.COM">
								<input type="hidden" name="id_requerimiento_padre" id="id_requerimiento_padre" value="<? echo $id_requerimiento_padre ?>">
								<div class="form-group mb-6">
									<select required class="form-control border-0 form-control-solid text-muted font-size-lg font-weight-bolder pl-5 min-h-50px" id="id_procesos_hijos" name="id_procesos_hijos">
										<option value="" selected="selected">Proceso ó Area</option>
										<?php
										while ($fila = $procesos->fetch()) {
										?>
											<option value="<?php echo $fila["id"] ?>"><?php echo $fila["nombre"] ?> (<?php echo $fila["ciudad"] ?>)</option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="form-group mb-6">
									<select required class="form-control border-0 form-control-solid text-muted font-size-lg font-weight-bolder pl-5 min-h-50px" id="tipo_proceso_hijos" name="tipo_proceso_hijos">
										<option value="" selected="selected">Tipo de Requerimiento</option>
									</select>
								</div>
								<div class="form-group mb-6">
									<select class="form-control border-0 form-control-solid text-muted font-size-lg font-weight-bolder pl-5 min-h-50px" id="categoria_proceso_hijos" name="categoria_proceso_hijos">
										<option value="" selected="selected">Categoria de Requerimiento</option>
									</select>
								</div>
								<input type="hidden" id="requerimiento_enhijo" name="requerimiento_enhijo" value="si">
							<?php
							}
							?>
							<div class="row">
								<div class="col-12 mb-5">
									<div class="form-group mb-6">
										<label class="form-label required fs-5 fw-bold mb-3">Personal asignar : </label>
										<select class=" form-control border-0 form-control-solid text-muted font-size-lg font-weight-bolder pl-5 min-h-50px" data-kt-select2="true" data-dropdown-parent="#kt_modal_create_api_key_hijos" id="id_personal_asignado" name="id_personal_asignado">
											<option value="" selected>Seleccione</option>
											<?php while ($fila = $personal_listado->fetch()) {
											?>
												<option value="<? echo $fila['id']; ?>"><? echo $fila['nombre_completo']; ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>

							<div class="form-group mb-6">
								<select required class="form-control border-0 form-control-solid text-muted font-size-lg font-weight-bolder pl-5 min-h-50px" id="prioridad" name="prioridad">
									<option value="" selected="selected">Prioridad</option>
									<option value="BAJA">BAJA</option>
									<option value="MEDIA">MEDIA</option>
									<option value="ALTA">ALTA</option>
								</select>
							</div>
							<div class="form-group mb-6">
								<textarea required class="form-control border-0 form-control-solid pl-6 font-size-lg font-weight-bolder min-h-130px" name="detalle" id="detalle" rows="4" placeholder="Detalle de Requerimiento!" id="kt_forms_widget_7_2_input"></textarea>
							</div>
							<div class="form-group mb-6">
								<input type="hidden" name="sede" id="sede" value="<? echo $sede ?>" class="form-control form-control-solid">
							</div>
							<div class="form-group mb-6">
								<input type="hidden" name="ciudad" id="ciudad" value="<? echo $ciudad ?>" class="form-control form-control-solid">
							</div>

							<div class="form-group mb-6">
								<input id="archivo_hijos[]" name="archivo_hijos[]" type="file" class="form-control form-control-sm dropzone-select btn btn-light-primary font-weight-bold btn-sm" data-show-upload="true" data-show-caption="true" multiple>
							</div>
							<div align="center">
								<input type="submit" name="enviar" class="btn btn-primary font-weight-bold" value="Crear Requerimiento">
								<input type="hidden" name="fecha_estimada_entrega" value="<?php echo date("Y-m-d") ?>">
								<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
								<input type="hidden" name="id_requerimientos" id="id_requerimientos" value="<?php echo $id_requerimientos ?>">
								<input type="hidden" name="formulario" id="formulario" value="crear_requerimiento_hijo">
								<input type="hidden" name="auto" id="auto" value="NO">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>