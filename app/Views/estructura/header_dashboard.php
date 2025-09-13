<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" translate="no">
	<head>
		<meta charset="utf-8">
		<meta name="google" content="notranslate">
		<meta name="robots" content="noindex, nofollow">
		<title><?= $titulo ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="" name="description">
		<meta content="" name="author">
		<!-- App favicon -->
		<link rel="shortcut icon" href="<?= $baseUrl ?>/public/images/favicon.png">
		<!-- dropzone css -->
		<!--<link rel="stylesheet" href="<?= $baseUrl ?>/public/libs/dropzone/dropzone.css" type="text/css">-->
		<!-- summernote -->
		<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

		<!--datatable css-->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
		<!--datatable responsive css-->
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

		<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

		<!-- Contry Select Css-->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.1.1/build/css/intlTelInput.css">

		<!-- Layout config Js -->
		<script src="<?= $baseUrl ?>/public/js/layout.js"></script>
		<!-- Bootstrap Css -->
		<link href="<?= $baseUrl ?>/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<!-- Icons Css -->
		<link href="<?= $baseUrl ?>/public/css/icons.min.css" rel="stylesheet" type="text/css">
		<!-- App Css-->
		<link href="<?= $baseUrl ?>/public/css/app.min.css?v=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/appcambiazope/public/css/app.min.css'); ?>" rel="stylesheet" type="text/css">
		<!-- custom Css-->
		<link href="<?= $baseUrl ?>/public/css/custom.min.css" rel="stylesheet" type="text/css">
		<!-- Toastr -->
		<link rel="stylesheet" href="<?= $baseUrl ?>/public/js/pages/plugins/toastr/toastr.min.css">
		<!-- SweetAlert -->
		<link rel="stylesheet" href="<?= $baseUrl ?>/public/js/pages/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
		<!-- Fancybox -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
		<!-- Bootstrap File Input CSS -->
		<link href="<?= $baseUrl ?>/public/libs/fileinput/css/fileinput.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
	</head>
	<body>
		<!-- Begin page -->
		<div id="layout-wrapper">
			<header id="page-topbar">
				<div class="layout-width">
					<div class="navbar-header">
						<div class="d-flex">
							<!-- LOGO -->
							<div class="navbar-brand-box horizontal-logo">
								<a href="<?= $baseUrl ?>" class="logo logo-dark">
								<span class="logo-sm">
								<img src="<?= $baseUrl ?>/public/images/favicon.png" alt="" height="40">
								</span>
								<span class="logo-lg">
								<img src="<?= $baseUrl ?>/public/images/logo.webp" alt="">
								</span>
								</a>
								<a href="<?= $baseUrl ?>" class="logo logo-sm">
								<span class="logo-sm">
								<img src="<?= $baseUrl ?>/public/images/favicon.png" alt="" height="40">
								</span>
								<span class="logo-lg">
								<img src="<?= $baseUrl ?>/public/images/logo.webp" alt="" height="50">
								</span>
								</a>
							</div>
							<button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
							<span class="hamburger-icon">
							<span></span>
							<span></span>
							<span></span>
							</span>
							</button>
						</div>
						<div class="d-flex align-items-center">
							<div class="ms-1 header-item d-none d-sm-flex">
								<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" data-toggle="fullscreen">
								<i class='bx bx-fullscreen fs-22'></i>
								</button>
							</div>
							<div class="ms-1 header-item d-none d-sm-flex">
								<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shadow-none">
								<i class='bx bx-moon fs-22'></i>
								</button>
							</div>
							<div class="dropdown ms-sm-3 header-item topbar-user">
								<button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="d-flex align-items-center">
									<img class="rounded-circle header-profile-user" src="<?= $baseUrl ?>/public/images/users/user-dummy-img.jpg" alt="Header Avatar">
									<span class="text-start ms-xl-2">
									<span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?= $nombres.' '.$apellidos ?></span>
									</span>
									</span>
								</button>
								<div class="dropdown-menu dropdown-menu-end">
									<!-- item-->
									<h6 class="dropdown-header">¡Hola <?= $nombres ?>!</h6>
									<!--<a class="dropdown-item" href="auth-lockscreen-basic.html.htm">
										<i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Cambiar contraseña</span>
									</a>-->
									<a class="dropdown-item" href="<?= $baseUrl ?>/salir">
										<i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Cerrar sesión</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<!-- ========== App Menu ========== -->
			<div class="app-menu navbar-menu">
				<!-- LOGO -->
				<div class="navbar-brand-box">
					<!-- Dark Logo-->
					<a href="<?= $baseUrl ?>" class="logo logo-dark">
					<span class="logo-sm">
					<img src="<?= $baseUrl ?>/public/images/logo-sm.png" alt="" height="40">
					</span>
					<span class="logo-lg">
					<img src="<?= $baseUrl ?>/public/images/logo.webp" alt="" height="70">
					</span>
					</a>
					<!-- Light Logo-->
					<a href="<?= $baseUrl ?>" class="logo logo-sm">
					<span class="logo-sm">
					<img src="<?= $baseUrl ?>/public/images/favicon.png" alt="" height="40">
					</span>
					<span class="logo-lg">
					<img src="<?= $baseUrl ?>/public/images/logo.webp" alt="" height="70">
					</span>
					</a>
					<button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
					<i class="ri-record-circle-line"></i>
					</button>
				</div>
				<div id="scrollbar">
					<div class="container-fluid">
						<div id="two-column-menu">
						</div>
						<?php if($perfil == 500 || $perfil == 402){ ?>
							<ul class="navbar-nav" id="navbar-nav">
								<li class="menu-title"><span data-key="t-menu">Gestión Automotriz</span></li>
								<li class="nav-item">
									<a class="nav-link menu-link <?php if($breadcrumb == 'Marcas'){ echo "active"; } ?>" href="<?= $baseUrl ?>/listar-marcas">
									<i class="mdi mdi-view-list"></i> <span data-key="t-widgets">Marcas</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link menu-link <?php if($breadcrumb == 'Modelos'){ echo "active"; } ?>" href="<?= $baseUrl ?>/listar-modelos">
									<i class="mdi mdi-view-list"></i> <span data-key="t-widgets">Modelos</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link menu-link <?php if($breadcrumb == 'Vehiculos'){ echo "active"; } ?>" href="<?= $baseUrl ?>/listar-vehiculos">
									<i class="mdi mdi-view-list"></i> <span data-key="t-widgets">Vehiculos</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link menu-link <?php if($breadcrumb == 'Clientes'){ echo "active"; } ?>" href="<?= $baseUrl ?>/listar-clientes">
									<i class="mdi mdi-view-list"></i> <span data-key="t-widgets">Clientes</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link menu-link <?php if($breadcrumb == 'Vehiculos Clientes'){ echo "active"; } ?>" href="<?= $baseUrl ?>/listar-vehiculos-clientes">
									<i class="mdi mdi-view-list"></i> <span data-key="t-widgets">Vehiculos x Clientes</span>
									</a>
								</li>
								<li class="menu-title"><span data-key="t-menu">Administración</span></li>
								<li class="nav-item">
									<a class="nav-link menu-link <?php if($breadcrumb == 'Perfiles'){ echo "active"; } ?>" href="<?= $baseUrl ?>/listar-perfiles">
									<i class="mdi mdi-scale-balance"></i> <span data-key="t-widgets">Roles</span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link menu-link <?php if($breadcrumb == 'Usuarios'){ echo "active"; } ?>" href="<?= $baseUrl ?>/listar-usuarios">
									<i class="mdi mdi-account"></i> <span data-key="t-widgets">Usuarios</span>
									</a>
								</li>
								<!-- end Dashboard Menu -->
							</ul>
						<?php } ?>
					</div>
					<!-- Sidebar -->
				</div>
				<div class="sidebar-background"></div>
			</div>
			<!-- Left Sidebar End -->
			<!-- Vertical Overlay-->
			<div class="vertical-overlay"></div>

         <?= $this->renderSection('content'); ?>
         
		</div>
		<!-- END layout-wrapper -->
		<!--start back-to-top-->
		<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
		<i class="ri-arrow-up-line"></i>
		</button>
		<!--end back-to-top-->
		<!--preloader-->
		<div id="preloader">
			<div id="status">
				<div class="spinner-border text-primary avatar-sm" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</div>
		</div>
      	<script> window.baseUrl = "<?= base_url(); ?>"</script>
		<!-- jQuery -->
		<script src="<?= $baseUrl ?>/public/js/pages/plugins/jquery/jquery.min.js"></script>
		<!-- JAVASCRIPT -->
		<script src="<?= $baseUrl ?>/public/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?= $baseUrl ?>/public/libs/simplebar/simplebar.min.js"></script>
		<script src="<?= $baseUrl ?>/public/libs/node-waves/waves.min.js"></script>
		<script src="<?= $baseUrl ?>/public/libs/feather-icons/feather.min.js"></script>
		<script src="<?= $baseUrl ?>/public/js/pages/plugins/lord-icon-2.1.0.js"></script>
		<script src="<?= $baseUrl ?>/public/js/plugins.js"></script>
		<script src='<?= $baseUrl ?>/public/libs/choices/choices.min.js'></script>
		<script src="<?= $baseUrl ?>/public/libs/flatpickr/flatpickr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
		<!-- dropzone min -->
		<!--<script src="<?= $baseUrl ?>/public/libs/dropzone/dropzone-min.js"></script>-->
		<!-- summernote -->
		<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

		<!--datatable js-->
		<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
		<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<!-- Select country -->
		<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.1.1/build/js/intlTelInput.min.js"></script>
		<!--select2 cdn-->
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		<script src="<?= $baseUrl ?>/public/js/pages/select2.init.js"></script>
		<!--datatable js-->
		<script src="<?= $baseUrl ?>/public/js/pages/datatables.init.js"></script>      
		<!-- apexcharts -->
		<script src="<?= $baseUrl ?>/public/libs/apexcharts/apexcharts.min.js"></script>
		<!-- Latest Sortable -->
		<!--<script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>-->
		<!--<script src="<?= $baseUrl ?>/public/js/pages/form-file-upload.init.js"></script>-->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<!-- Bootstrap File Input JS -->
		<script src="<?= $baseUrl ?>/public/js/pages/fileinput.min.js"></script>
		<!-- init js -->
		<script src="<?= $baseUrl ?>/public/js/pages/form-editor.init.js"></script>
		<!-- echarts js -->
		<script src="<?= $baseUrl ?>/public/libs/echarts/echarts.min.js"></script>
		<!-- echarts init -->
		<script src="<?= $baseUrl ?>/public/js/pages/echarts.init.js"></script>
		<!-- App js -->
		<script src="<?= $baseUrl ?>/public/js/app.js"></script>  
		<!-- Toastr -->
		<script src="<?= $baseUrl ?>/public/js/pages/plugins/toastr/toastr.min.js"></script>
		<!-- SweetAlert -->
		<script src="<?= $baseUrl ?>/public/js/pages/plugins/sweetalert2/sweetalert2.min.js"></script>
		<!-- PrintThis -->
		<script src="<?= $baseUrl ?>/public/js/pages/printThis.js"></script>
		<!-- Fancybox -->
		<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
		
		<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
			This must be loaded before fileinput.min.js -->
		<script src="<?= $baseUrl ?>/public/libs/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
		
		<!-- the main fileinput plugin script JS file -->
		<script src="<?= $baseUrl ?>/public/libs/fileinput/js/fileinput.min.js"></script>
		
		<!-- following theme script is needed to use the Font Awesome 5.x theme (`fa5`). Uncomment if needed. -->
		<script src="<?= $baseUrl ?>/public/libs/fileinput/themes/fas/theme.min.js"></script>
		
		<!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
		<script src="<?= $baseUrl ?>/public/libs/fileinput/locales/es.js"></script>
		<script src="<?= $baseUrl ?>/public/js/proceso.js?v=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/appcambiazope/public/js/proceso.js'); ?>"></script>

		<script>
			const path = window.location.pathname.split('/');

			if(path[2] == 'dashboard'){
				$(document).ready(function() {
					// Variables para almacenar los tipos de cambio
					var tipoCambioCompra = <?= isset($tipoCambio['precioCompra']) ? $tipoCambio['precioCompra'] : '0' ?>;
					var tipoCambioVenta = <?= isset($tipoCambio['precioVenta']) ? $tipoCambio['precioVenta'] : '0' ?>;
					
					// Estado actual de las monedas
					var monedaOrigen = 'USD';
					var monedaDestino = 'PEN';
					
					// Función para actualizar la interfaz de monedas
					function actualizarInterfazMonedas() {
						if (monedaOrigen === 'USD') {
							$('#moneda_origen_text').text('Dólares');
							$('#bandera_origen').attr('src', 'https://flagcdn.com/w20/us.png').attr('alt', 'USD');
						} else {
							$('#moneda_origen_text').text('Soles');
							$('#bandera_origen').attr('src', 'https://flagcdn.com/w20/pe.png').attr('alt', 'PEN');
						}
						
						if (monedaDestino === 'USD') {
							$('#moneda_destino_text').text('Dólares');
							$('#bandera_destino').attr('src', 'https://flagcdn.com/w20/us.png').attr('alt', 'USD');
						} else {
							$('#moneda_destino_text').text('Soles');
							$('#bandera_destino').attr('src', 'https://flagcdn.com/w20/pe.png').attr('alt', 'PEN');
						}
						
						// Actualizar inputs hidden
						$('#moneda_envias_id').val(monedaOrigen);
						$('#moneda_recibes_id').val(monedaDestino);
					}
					
					// Función para actualizar el tipo de cambio en el input hidden
					function actualizarTipoCambioHidden() {
						var tipoCambioActual = 0;
						
						if (monedaOrigen === 'USD' && monedaDestino === 'PEN') {
							tipoCambioActual = tipoCambioCompra; // Compra para USD->PEN
						} else if (monedaOrigen === 'PEN' && monedaDestino === 'USD') {
							tipoCambioActual = tipoCambioVenta; // Venta para PEN->USD
						} else {
							tipoCambioActual = 1; // Misma moneda
						}
						
						$('#tipo_cambio_id').val(tipoCambioActual);
					}
					
					// Función para convertir divisas
					function convertirDivisa() {
						var monto = parseFloat($('#monto').val());
						var resultado = 0;
						
						if (isNaN(monto) || monto <= 0) {
							$('#resultado_conversion').val('0.00');
							return;
						}
						
						if (monedaOrigen === monedaDestino) {
							resultado = monto;
						} else if (monedaOrigen === 'PEN' && monedaDestino === 'USD') {
							// Convertir de Soles a Dólares (usar tipo de cambio de venta)
							resultado = monto / tipoCambioVenta;
						} else if (monedaOrigen === 'USD' && monedaDestino === 'PEN') {
							// Convertir de Dólares a Soles (usar tipo de cambio de compra)
							resultado = monto * tipoCambioCompra;
						}
						
						$('#resultado_conversion').val(resultado.toFixed(2));
					}
					
					// Función para intercambiar monedas
					function intercambiarMonedas() {
						var temp = monedaOrigen;
						monedaOrigen = monedaDestino;
						monedaDestino = temp;
						
						// Intercambiar valores
						var montoOrigen = $('#monto').val();
						var montoDestino = $('#resultado_conversion').val();
						
						$('#monto').val(montoDestino);
						$('#resultado_conversion').val(montoOrigen);
						
						actualizarInterfazMonedas();
						actualizarTipoCambioHidden();
						convertirDivisa();
					}
					
					// Event listeners
					$('#swap_currencies').click(function() {
						intercambiarMonedas();
					});
					
					// Convertir automáticamente cuando cambie el monto
					$('#monto').on('input', function() {
						var valor = $(this).val();
						if (valor !== '' && valor !== '0.00') {
							convertirDivisa();
						} else {
							$('#resultado_conversion').val('0.00');
						}
					});
					
					// Asegurar que siempre haya un valor mínimo
					$('#monto').on('blur', function() {
						var valor = parseFloat($(this).val());
						if (isNaN(valor) || valor < 0) {
							$(this).val('0.00');
							$('#resultado_conversion').val('0.00');
						} else {
							$(this).val(valor.toFixed(2));
							convertirDivisa();
						}
					});
					
					// Inicializar la interfaz
					actualizarInterfazMonedas();
					actualizarTipoCambioHidden();
					convertirDivisa(); // Convertir con el valor inicial
					
					// Actualizar hora cada minuto
					setInterval(function() {
						var ahora = new Date();
						var hora = ahora.getHours().toString().padStart(2, '0');
						var minuto = ahora.getMinutes().toString().padStart(2, '0');
						$('#hora_actualizacion').text(hora + ':' + minuto);
					}, 60000);
				});
			}

			if(path[2] == 'elige-cuenta'){
				// Datos de las cuentas desde PHP con validación
				const datosOperacion = <?= json_encode($datosOperacion ?? []) ?>;
				const listaCuentaSoles = <?= json_encode($listaCuentaSoles ?? []) ?>;
				const listaCuentaDolares = <?= json_encode($listaCuentaDolares ?? []) ?>;

				// Variables para almacenar las cuentas filtradas
				let cuentasOrigen = [];
				let cuentasDestino = [];

				// Función para actualizar las cuentas disponibles según la moneda
				function actualizarCuentasDisponibles() {
					// Validar que datosOperacion existe y tiene elementos
					if (!datosOperacion || datosOperacion.length === 0) {
						console.warn('No hay datos de operación disponibles');
						cuentasOrigen = [];
						cuentasDestino = [];
						return;
					}
					
					const monedaOrigen = datosOperacion[0]['moneda_envias_id'];
					const monedaDestino = datosOperacion[0]['moneda_recibes_id'];
					
					// Filtrar cuentas de origen con validación
					if (monedaOrigen === 'USD') {
						cuentasOrigen = Array.isArray(listaCuentaDolares) ? listaCuentaDolares : [];
					} else {
						cuentasOrigen = Array.isArray(listaCuentaSoles) ? listaCuentaSoles : [];
					}
					
					// Filtrar cuentas de destino con validación
					if (monedaDestino === 'USD') {
						cuentasDestino = Array.isArray(listaCuentaDolares) ? listaCuentaDolares : [];
					} else {
						cuentasDestino = Array.isArray(listaCuentaSoles) ? listaCuentaSoles : [];
					}
				}

				// Función para crear un elemento de cuenta
				function crearElementoCuenta(cuenta, tipo) {
					const div = document.createElement('div');
					div.className = 'cuenta-item list-group-item list-group-item-action';
					div.innerHTML = `
						<div class="d-flex align-items-center">
							<input type="radio" name="cuenta_${tipo}" value="${cuenta.id_cuenta_bancaria}" class="me-3">
							<div class="cuenta-info flex-grow-1">
								<div class="d-flex align-items-center mb-1">
									<img src="${cuenta.banco_logo}" 
										alt="${cuenta.banco_nombre}" 
										class="me-3" 
										style="width: 20px; height: 20px; object-fit: contain; border-radius: 4px;">
									<div>
										<div class="cuenta-nombre">${cuenta.nombre_cuenta}</div>
										<div class="cuenta-saldo">${cuenta.banco_nombre}</div>
										<div class="text-muted small">${cuenta.numero_cuenta}</div>
									</div>
								</div>
							</div>
						</div>
					`;
					
					// Event listener para selección
					div.addEventListener('click', function() {
						// Desmarcar otros radios del mismo grupo
						const radios = document.querySelectorAll(`input[name="cuenta_${tipo}"]`);
						radios.forEach(radio => radio.checked = false);
						
						// Marcar el seleccionado
						const radio = div.querySelector('input[type="radio"]');
						radio.checked = true;
						
						// Actualizar estado visual
						document.querySelectorAll('.cuenta-item').forEach(item => {
							item.classList.remove('selected');
						});
						div.classList.add('selected');
						
						// Habilitar botón de confirmación
						const botonConfirmar = document.getElementById(`confirmar_cuenta_${tipo}`);
						botonConfirmar.disabled = false;
					});
					
					return div;
				}

				// Función para cargar cuentas en el offcanvas
				function cargarCuentasEnOffcanvas(tipo) {
					const listaId = `lista_cuentas_${tipo}`;
					const lista = document.getElementById(listaId);
					
					if (!lista) {
						console.error(`No se encontró el elemento con ID: ${listaId}`);
						return;
					}
					
					lista.innerHTML = '';
					
					const cuentas = tipo === 'origen' ? cuentasOrigen : cuentasDestino;
					
					// Validar que cuentas es un array
					if (!Array.isArray(cuentas)) {
						console.warn(`No hay cuentas disponibles para ${tipo}`);
						lista.innerHTML = '<div class="text-center text-muted p-3">No hay cuentas disponibles</div>';
						return;
					}
					
					if (cuentas.length === 0) {
						lista.innerHTML = '<div class="text-center text-muted p-3">No hay cuentas disponibles</div>';
						return;
					}
					
					cuentas.forEach(cuenta => {
						// Validar que la cuenta tiene los datos necesarios
						if (cuenta && cuenta.id_cuenta_bancaria) {
							const elemento = crearElementoCuenta(cuenta, tipo);
							lista.appendChild(elemento);
						}
					});
				}

				// Event listeners para los offcanvas
				document.getElementById('offcanvasCuentaOrigen').addEventListener('show.bs.offcanvas', function() {
					cargarCuentasEnOffcanvas('origen');
				});

				document.getElementById('offcanvasCuentaDestino').addEventListener('show.bs.offcanvas', function() {
					cargarCuentasEnOffcanvas('destino');
				});

				// Event listeners para los botones de confirmación
				document.getElementById('confirmar_cuenta_origen').addEventListener('click', function() {
					const radioSeleccionado = document.querySelector('input[name="cuenta_origen"]:checked');
					if (radioSeleccionado) {
						const cuentaId = radioSeleccionado.value;
						const cuenta = Array.isArray(cuentasOrigen) ? cuentasOrigen.find(c => c.id_cuenta_bancaria == cuentaId) : null;
						
						if (cuenta) {
							// Actualizar el botón de selección
							document.getElementById('texto_cuenta_origen').textContent = cuenta.nombre_cuenta || 'Cuenta seleccionada';
							document.getElementById('cuenta_origen').value = cuentaId;
							document.getElementById('btn_cuenta_origen').classList.add('cuenta-seleccionada');
						} else {
							console.error('No se encontró la cuenta seleccionada');
						}
					}
				});

				document.getElementById('confirmar_cuenta_destino').addEventListener('click', function() {
					const radioSeleccionado = document.querySelector('input[name="cuenta_destino"]:checked');
					if (radioSeleccionado) {
						const cuentaId = radioSeleccionado.value;
						const cuenta = Array.isArray(cuentasDestino) ? cuentasDestino.find(c => c.id_cuenta_bancaria == cuentaId) : null;
						
						if (cuenta) {
							// Actualizar el botón de selección
							document.getElementById('texto_cuenta_destino').textContent = cuenta.nombre_cuenta || 'Cuenta seleccionada';
							document.getElementById('cuenta_destino').value = cuentaId;
							document.getElementById('btn_cuenta_destino').classList.add('cuenta-seleccionada');
						} else {
							console.error('No se encontró la cuenta seleccionada');
						}
					}
				});

				// Validación del formulario
				document.querySelector('.formulario').addEventListener('submit', function(e) {
					const cuentaOrigen = document.getElementById('cuenta_origen').value;
					const cuentaDestino = document.getElementById('cuenta_destino').value;
					
					if (!cuentaOrigen || !cuentaDestino) {
						e.preventDefault();
						alert('Por favor selecciona ambas cuentas antes de continuar.');
						return false;
					}
				});

				// Inicializar al cargar la página
				document.addEventListener('DOMContentLoaded', function() {
					actualizarCuentasDisponibles();
				});
			}

			if(path[2] == 'transfiere'){
				function copiarNumeroCuenta() {
					const numeroCuenta = document.getElementById('numero-cuenta').textContent;
					
					// Crear un elemento temporal para copiar
					const tempInput = document.createElement('input');
					tempInput.value = numeroCuenta;
					document.body.appendChild(tempInput);
					tempInput.select();
					document.execCommand('copy');
					document.body.removeChild(tempInput);
					
					// Mostrar notificación
					mostrarNotificacion('Número de cuenta copiado al portapapeles');
				}

				function copiarCCI() {
					const cci = document.getElementById('cci-cuenta').textContent;
					
					// Crear un elemento temporal para copiar
					const tempInput = document.createElement('input');
					tempInput.value = cci;
					document.body.appendChild(tempInput);
					tempInput.select();
					document.execCommand('copy');
					document.body.removeChild(tempInput);
					
					// Mostrar notificación
					mostrarNotificacion('CCI copiado al portapapeles');
				}

				function mostrarNotificacion(mensaje) {
					// Crear elemento de notificación
					const notificacion = document.createElement('div');
					notificacion.className = 'alert alert-success position-fixed';
					notificacion.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
					notificacion.innerHTML = `
						<div class="d-flex align-items-center">
							<i class="mdi mdi-check-circle me-2"></i>
							${mensaje}
						</div>
					`;
					
					// Agregar al DOM
					document.body.appendChild(notificacion);
					
					// Remover después de 3 segundos
					setTimeout(() => {
						notificacion.remove();
					}, 3000);
				}
			}

			if(path[2] == 'historial-operaciones'){
				// Función para abrir el modal de aprobación
				function abrirModalAprobar(operacionId) {
					$('#operacionIdAprobar').val(operacionId);
				}

				// Validar tamaño de archivo
				$('#archivoAprobacion').on('change', function() {
					const file = this.files[0];
					const maxSize = 5 * 1024 * 1024; // 5MB
					
					if (file && file.size > maxSize) {
						alert('El archivo es demasiado grande. El tamaño máximo permitido es 5MB.');
						this.value = '';
					}
				});
			}
		</script>
	</body>
</html>