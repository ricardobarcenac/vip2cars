<?= $this->extend('estructura/header_dashboard'); ?>
<?= $this->section('content'); ?>
<style>
	.currency-converter {
		background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
		border: 1px solid #e9ecef;
	}

	.currency-card {
		transition: all 0.3s ease;
		border: none;
		box-shadow: 0 2px 8px rgba(0,0,0,0.08);
	}

	.currency-card:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 16px rgba(0,0,0,0.12);
	}

	.currency-input {
		background: #f8f9fa !important;
		border: 1px solid #e9ecef !important;
		font-size: 1.2rem;
		font-weight: 500;
		color: #495057;
		min-height: 60px;
	}

	.currency-input:focus {
		background: #ffffff !important;
		border-color: #007bff !important;
		box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25) !important;
	}

	.currency-input::placeholder {
		color: #6c757d;
		font-weight: 400;
	}

	.currency-input:focus::placeholder {
		color: #adb5bd;
	}

	.currency-label {
		font-size: 0.85rem;
		font-weight: 500;
		color: #6c757d;
		margin-bottom: 0.5rem;
	}

	.rate-card {
		border-radius: 12px;
		border: none;
		box-shadow: 0 2px 8px rgba(0,0,0,0.1);
	}

	.flag-img {
		border-radius: 50%;
		object-fit: cover;
	}
</style>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
	<div class="page-content">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-md-5">
					<!-- Cambiador de Divisas -->
					<form class="formulario" action="<?= $baseUrl ?>/iniciar-operacion" method="POST">
						<span class="respuesta"></span>
						<div class="currency-converter rounded-4 p-lg-5 p-3 mb-4">
							<!-- Título -->
							<h1 class="mb-4 fw-bold text-primary text-center">Cotiza</h1>
							
							<!-- Tarjetas de Tipo de Cambio -->
							<div class="row g-3 mb-4">
								<div class="col-6">
									<div class="rate-card compra text-white p-3 text-center">
										<div class="small mb-1 text-dark">Compra</div>
										<div class="h5 mb-0 fw-bold" id="tipo_compra">
											<?php if(isset($tipoCambio['precioCompra'])): ?>
												<?= number_format($tipoCambio['precioCompra'], 4) ?>
											<?php else: ?>
												-
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="col-6">
									<div class="rate-card venta text-white p-3 text-center">
										<div class="small mb-1 text-dark">Venta</div>
										<div class="h5 mb-0 fw-bold" id="tipo_venta">
											<?php if(isset($tipoCambio['precioVenta'])): ?>
												<?= number_format($tipoCambio['precioVenta'], 4) ?>
											<?php else: ?>
												-
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
							
							<!-- Información de actualización -->
							<div class="text-center mb-4">
								<small class="text-muted">El tipo de cambio se actualiza en <span class="fw-medium" id="hora_actualizacion"><?= date('H:i') ?></span></small>
							</div>
							
							<!-- Conversor de Divisas -->
							<div class="mb-4">
								<!-- Inputs hidden para datos del formulario -->
								<input type="hidden" id="moneda_envias_id" name="moneda_envias_id" value="USD">
								<input type="hidden" id="moneda_recibes_id" name="moneda_recibes_id" value="PEN">
								<input type="hidden" id="tipo_cambio_id" name="tipo_cambio_id" value="<?= isset($tipoCambio['precioCompra']) ? $tipoCambio['precioCompra'] : '0' ?>">
								
								<!-- Contenedor de inputs con botón de intercambio -->
								<div class="position-relative mb-4">
									<!-- Campo Envías -->
									<div class="mb-2">
										<div class="position-relative">
											<input type="number" class="currency-input form-control rounded-4 pe-5" id="monto" placeholder="Envías" step="0.01" value="0.00" style="padding-right: 120px; padding-left: 20px; padding-top: 20px; padding-bottom: 20px; font-size: 1.2rem;" name="envias">
											<div class="position-absolute top-50 end-0 translate-middle-y pe-3 d-flex align-items-center">
												<span class="text-muted me-2" id="moneda_origen_text">Dólares</span>
												<img src="https://flagcdn.com/w20/us.png" alt="USD" class="flag-img" id="bandera_origen" style="width: 20px; height: 20px;">
											</div>
										</div>
									</div>
									
									<!-- Botón de intercambio superpuesto -->
									<div class="position-absolute top-50 start-50 translate-middle" style="z-index: 20;">
										<button type="button" class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center shadow" id="swap_currencies" style="width: 45px; height: 45px;">
											<i class="mdi mdi-swap-vertical fs-6"></i>
										</button>
									</div>
									
									<!-- Campo Recibes -->
									<div class="mb-0">
										<div class="position-relative">
											<input type="text" class="currency-input form-control rounded-4 pe-5" id="resultado_conversion" value="0.00" readonly style="padding-right: 120px; padding-left: 20px; padding-top: 20px; padding-bottom: 20px; font-size: 1.2rem;" placeholder="Recibes" name="recibes">
											<div class="position-absolute top-50 end-0 translate-middle-y pe-3 d-flex align-items-center">
												<span class="text-muted me-2" id="moneda_destino_text">Soles</span>
												<img src="https://flagcdn.com/w20/pe.png" alt="PEN" class="flag-img" id="bandera_destino" style="width: 20px; height: 20px;">
											</div>
										</div>
									</div>
								</div>
								
								<!-- Cupón (opcional) -->
								<div class="row g-2 mb-4">
									<div class="col-8">
										<label class="currency-label">Ingresa tu cupón</label>
										<input type="text" class="form-control border-0 bg-light rounded-4" id="cupon" name="cupon" placeholder="Código de cupón" style="padding-top: 20px; padding-bottom: 20px;">
									</div>
									<div class="col-4 d-flex align-items-end">
										<button type="button" class="btn btn-primary rounded-4 w-100" id="aplicar-cupon" style="padding-top: 20px; padding-bottom: 20px;" id="aplicar-cupon">Aplicar cupón</button>
										<input type="hidden" id="codigo_referido_id" name="codigo_referido_id">
									</div>
								</div>
								
								<!-- Botón principal -->
								<button type="submit" class="btn btn-primary btn-lg w-100 rounded-4 py-3">
									Iniciar Operación
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- container-fluid -->
	</div>
	<!-- End Page-content -->
	<footer class="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<script>document.write(new Date().getFullYear())</script> © 
				</div>
				<div class="col-sm-6">
					<div class="text-sm-end d-none d-sm-block">
						Desarrollado por <a href="https://linktr.ee/rbarcenac/">Ricardo Barcena</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
<!-- end main content-->
<?= $this->endSection(); ?>