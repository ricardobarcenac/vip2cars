<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
	<head>
		<meta charset="utf-8">
		<title><?= $titulo ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="cambiazo.pe - Plataforma de Cambio de Moneda" name="description">
		<meta content="cambiazo.pe" name="author">
		<!-- App favicon -->
		<link rel="shortcut icon" href="<?= $baseUrl ?>/public/images/favicon.png">
		<!-- Layout config Js -->
		<script src="<?= $baseUrl ?>/public/js/layout.js"></script>
		<!-- Bootstrap Css -->
		<link href="<?= $baseUrl ?>/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<!-- Icons Css -->
		<link href="<?= $baseUrl ?>/public/css/icons.min.css" rel="stylesheet" type="text/css">
		<!-- App Css-->
		<link href="<?= $baseUrl ?>/public/css/app.min.css" rel="stylesheet" type="text/css">
		<!-- custom Css-->
		<link href="<?= $baseUrl ?>/public/css/custom.min.css" rel="stylesheet" type="text/css">
		<!-- SweetAlert -->
		<link rel="stylesheet" href="<?= $baseUrl ?>/public/js/pages/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
		<style>
			/* Reducir tamaño del placeholder */
			.form-control::placeholder {
				font-size: 0.75rem;
				color: #6c757d;
			}
			
			/* Mejorar estética del botón del ojo */
			.password-addon {
				right: 12px !important;
				top: 50% !important;
				transform: translateY(-50%) !important;
				width: 24px !important;
				height: 24px !important;
				display: flex !important;
				align-items: center !important;
				justify-content: center !important;
				border: none !important;
				background: none !important;
				padding: 0 !important;
				z-index: 10;
			}
			
			.password-addon:hover {
				background: none !important;
			}
			
			.password-addon i {
				font-size: 16px !important;
				color: #6c757d !important;
				transition: color 0.2s ease;
			}
			
			.password-addon:hover i {
				color: #495057 !important;
			}
			
			/* Ajustar padding del input para el botón */
			.auth-pass-inputgroup .form-control {
				padding-right: 45px !important;
			}
		</style>
	</head>
	<body>
		<!-- auth-page wrapper -->
		<div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
			<div class="bg-overlay"></div>
			<!-- auth-page content -->
			<div class="auth-page-content overflow-hidden pt-lg-5">
				<div class="container">
					<div class="row align-items-center justify-content-center">
						<div class="col-lg-6">
							<div class="card overflow-hidden">
								<div class="row g-0">
									<div class="col-lg-12">
										<div class="p-lg-5 p-4">
											<div class="mt-5">
												<form class="formulario" action="<?= $baseUrl ?>/entrar" method="POST">
													<span class="respuesta"></span>
													<div class="mb-3">
														<label for="username" class="form-label">Correo electrónico</label>
														<input type="text" class="form-control form-control-lg rounded-4" id="usuario" name="usuario" placeholder="Ingresa tu correo electrónico">
													</div>
													<div class="mb-3">
														<label class="form-label" for="password-input">Contraseña</label>
														<div class="position-relative auth-pass-inputgroup mb-3">
															<input type="password" class="form-control form-control-lg rounded-4 pe-5 password-input" placeholder="Ingresa tu contraseña" id="contrasena" name="contrasena">
															<button class=" btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon">
																<i class="ri-eye-fill align-middle"></i>
															</button>
														</div>
													</div>
													<a href="<?= $baseUrl ?>" class="float-end mb-3">¿Olvidaste tu contraseña?</a>
													<div class="mt-4">
														<button class="btn btn-dark btn-lg w-100 rounded-4" type="submit">Ingresar</button>
													</div>
													<div class="mt-3 text-center">
														<a href="<?= $baseUrl ?>/crear-cuenta">¿No tienes una cuenta? Regístrate aquí</a>
													</div>
												</form>
											</div>
										</div>
									</div>
									<!-- end col -->
								</div>
								<!-- end row -->
							</div>
							<!-- end card -->
						</div>
						<!-- end col -->
					</div>
					<!-- end row -->
				</div>
				<!-- end container -->
			</div>
			<!-- end auth page content -->
			<!-- footer -->
			<footer class="footer">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="text-center">
								<p class="mb-0">
									&copy;
									<script>document.write(new Date().getFullYear())</script>  Desarrollado por Ricardo Barcena
								</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- end Footer -->
		</div>
		<!-- end auth-page-wrapper -->
     	<script> window.baseUrl = "<?= base_url(); ?>"</script>
		<!-- jQuery -->
		<script src="<?= $baseUrl ?>/public/js/pages/plugins/jquery/jquery.min.js"></script>
		<!-- JAVASCRIPT -->
		<script src="<?= $baseUrl ?>/public/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="<?= $baseUrl ?>/public/js/plugins.js"></script>
		<!-- App js -->
		<script src="<?= $baseUrl ?>/public/js/app.js"></script>
		<!-- SweetAlert -->
		<script src="<?= $baseUrl ?>/public/js/pages/plugins/sweetalert2/sweetalert2.min.js"></script>
		<!-- Proceso -->
		<script>
			// Toggle de visibilidad de contraseña
			document.getElementById('password-addon').addEventListener('click', function() {
				const passwordInput = document.getElementById('contrasena');
				const icon = this.querySelector('i');
				
				if (passwordInput.type === 'password') {
					passwordInput.type = 'text';
					icon.classList.remove('ri-eye-fill');
					icon.classList.add('ri-eye-off-fill');
				} else {
					passwordInput.type = 'password';
					icon.classList.remove('ri-eye-off-fill');
					icon.classList.add('ri-eye-fill');
				}
			});
			
			$(document).on('submit', '.formulario', function() {
				var formulario = $(this);
				var metodoEnvio = formulario.attr('method');
				var formulario_id = formulario.attr('id');

				$.ajax({        
					url: formulario.attr('action'),
					type: metodoEnvio,
					data: formulario.serialize(),
					data: new FormData(this),
					contentType: false,
					cache: false,
					processData: false,
					success: function(response) {
						formulario.find('.respuesta').html(response);
					}, 
					error: function(){
						//$.unblockUI({});
						alert('Ha ocurrido un error interno.');
					}
				});
				return false;
			});
		</script>
	</body>
</html>