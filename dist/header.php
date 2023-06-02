<!--begin::Header tablet and mobile-->
<div class="header-mobile py-3" style="background-color: #31AAB3;" >
	<!--begin::Container-->
	<div class="container d-flex flex-stack">
		<!--begin::Mobile logo-->
		<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
			<a href="" target="_blank">
				<img alt="Logo" src="assets/media/logos/logo.png" class="h-35px" />
			</a>
		</div>
		
		<!--end::Mobile logo-->
		<!--begin::Aside toggle-->
		<button class="btn btn-icon btn-active-color-primary" id="kt_aside_toggle">
			<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
			<span class="svg-icon svg-icon-2x me-n1">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
					<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</button>
		<!--end::Aside toggle-->
	</div>
	<!--end::Container-->
</div>
<!--end::Header tablet and mobile-->
<!--begin::Header-->
<div id="kt_header" data-step="6" data-intro="En la Barra de Herramientas tendremos acceso a aplicaciones y notificaciones rapidas en cualquier momento" style="background-color: #31AAB3" class="header py-6 py-lg-0" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{lg: '300px'}" >
	<!--begin::Container-->
	<div class="header-container container-xxl" >
		<!--begin::Page title-->
		
		<div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-20 py-3 py-lg-0 me-3">
			<!--begin::Heading-->
			<h1 class="d-flex flex-column text-dark fw-bolder my-1" data-step="1" data-intro="Bienvenido! a REPAIR">
				<!--<span ><img src=""><img src="logos/icono/sicusoblanco.png" style="max-height: 30px;"></span>-->
				<span class="text-white fs-1"><?php echo $name_page ?></span>
				<small class="text-gray-600 fs-7 fw-normal pt-2"><?php echo $desc_page ?></small>
				<small class="text-gray-100 fs-9 fw-normal pt-4"><?php //echo $_SESSION["nombre_completo"] ?> - <?php //echo $_SESSION["empresa"] ?></small>
				<!--<small class="text-gray-100 fs-10 fw-normal pt-4">Empresas Asociadas: <?php //echo $_SESSION["empresas_asociadas"] ?></small>-->
				<!--<small class="text-gray-100 fs-10 fw-normal pt-4">NIT Asociados: <?php //echo $_SESSION["nit_asociados"] ?></small>-->
			</h1>
			<!--end::Heading-->
		</div>
		<!--end::Page title=-->
		<!--begin::Wrapper-->
		<div class="d-flex align-items-center flex-wrap">

			<?php include "search_bar.php" ?>

			<?php include "notification.php" ?>

		</div>
		<!--end::Wrapper-->
	</div>
	<!--end::Container-->
	<div class="header-offset"></div>
</div>
					<!--end::Header-->
