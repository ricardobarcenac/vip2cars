<?= $this->extend('estructura/header_dashboard'); ?>
<?= $this->section('content'); ?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
	<div class="page-content">
		<div class="container-fluid">
			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box d-sm-flex align-items-center justify-content-between">
						<h4 class="mb-sm-0"><?= $breadcrumb ?></h4>
						<div class="page-title-right">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="<?= $baseUrl ?>">Inicio</a></li>
								<li class="breadcrumb-item active"><?= $breadcrumb ?></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header d-flex align-items-center">
                            <h5 class="card-title mb-0 flex-grow-1"><?= $breadcrumb ?></h5>
                            <div>
                                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#anadirVehiculoCliente" aria-controls="anadirVehiculoCliente">
									<i class="mdi mdi-plus-circle"></i> Añadir nuevo
								</button>
                            </div>
                        </div>
						<div class="card-body">
							<table id="scroll-horizontal" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
								<thead>
									<tr>
										<th class="text-center align-middle">Vehiculo</th>
										<th class="text-center align-middle">Cliente</th>
										<th class="text-center align-middle">Documento cliente</th>
										<th class="text-center align-middle">Correo electrónico cliente</th>
										<th class="text-center align-middle">Teléfono cliente</th>
										<th class="text-center align-middle">Estado</th>
										<th class="text-center align-middle">Fecha de registro</th>
										<th class="text-center align-middle">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($listaVehiculoClientes as $items){ ?>
									<tr>
										<td class="text-center align-middle">
											<div class="card border border-primary mb-0">
												<div class="card-body p-2">
													<p class="mb-0 text-dark fw-medium small"><?= $items['marca'] ?> <?= $items['modelo'] ?></p>
													<p class="mb-0 text-dark fw-medium small"><?= $items['placa'] ?></p>
													<p class="mb-0 text-dark fw-medium small"><?= $items['ano_fabricacion'] ?></p>
												</div>
											</div>
										</td>
										<td class="text-center align-middle"><?= $items['nombres'] ?> <?= $items['apellidos'] ?></td>
										<td class="text-center align-middle"><?= $items['tipo_documento'] ?> <?= $items['numero_documento'] ?></td>
										<td class="text-center align-middle"><?= $items['correo_electronico'] ?></td>
										<td class="text-center align-middle"><?= $items['telefono'] ?></td>
										<td class="text-center align-middle">
											<?php if($items['eliminacion_logica'] == 1) { echo '<span class="badge bg-success">ACTIVO</span>'; } else { echo '<span class="badge bg-danger">INACTIVO</span>'; } ?>
										</td>
										<td class="text-center align-middle"><?= date("d-m-Y H:i:s", strtotime($items['fecha_registro'])) ?></td>
										<td class="text-center align-middle">
											<?php if($items['eliminacion_logica'] == 1){ ?>
												<a href="javascript:;" role="button" id="editar-vehiculo-cliente" class="btn btn-primary btn-sm" data-id="<?= $items['id_vehiculo_cliente'] ?>" data-bs-toggle="offcanvas" data-bs-target="#editarVehiculoCliente">
													<i class="ri-edit-line align-bottom text-white"></i>
												</a>
												<a href="javascript:;" role="button" class="btn btn-danger btn-sm removerInfo" data-url="<?= $baseUrl ?>/eliminar-vehiculo-cliente/<?= $items['id_vehiculo_cliente'] ?>" data-response="respuesta">
													<i class="ri-delete-bin-fill align-bottom text-white"></i>
												</a>
											<?php } else { ?>
												<a href="javascript:;" role="button" class="btn btn-success btn-sm removerInfo" data-url="<?= $baseUrl ?>/reactivar-vehiculo-cliente/<?= $items['id_vehiculo_cliente'] ?>" data-response="respuesta">
													<i class="ri-check-line align-bottom text-white"></i>
												</a>
											<?php } ?>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
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
						Desarrollado por <a href="https://linktr.ee/rbarcenac">Ricardo Barcena</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
<!-- end main content-->
<!-- Offcanvas Añadir Vehiculo -->
<div class="offcanvas offcanvas-end" id="anadirVehiculoCliente" tabindex="-1" aria-labelledby="exampleanadirVehiculoCliente" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="exampleanadirVehiculoCliente">Añadir nuevo vehiculo cliente</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<form class="formulario" action="<?= $baseUrl ?>/grabar-vehiculo-cliente" method="POST" enctype="multipart/form-data">
		<span class="respuesta"></span>
		<div class="offcanvas-body">
			<div class="row">
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="vehiculo" class="form-label">Vehiculo</label>
						<select class="form-control" id="vehiculo" name="vehiculo">
							<option value=""></option>
							<?php foreach($listaVehiculos as $items){ ?>
								<option value="<?= $items['id_vehiculo'] ?>">[<?= $items['placa'] ?>] - <?= $items['marca'] ?> <?= $items['modelo'] ?> <?= $items['ano_fabricacion'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="cliente" class="form-label">Cliente</label>
						<select class="form-control" id="cliente" name="cliente">
							<option value=""></option>
							<?php foreach($listaClientes as $items){ ?>
								<option value="<?= $items['id_cliente'] ?>">[<?= $items['tipo_documento'] ?> <?= $items['numero_documento'] ?>] - <?= $items['nombres'] ?> <?= $items['apellidos'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> Guardar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- Offcanvas Editar Vehiculo -->
<div class="offcanvas offcanvas-end" id="editarVehiculoCliente" tabindex="-1" aria-labelledby="exampleeditarVehiculoCliente" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="exampleeditarVehiculoCliente">Información de vehiculo cliente</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<form class="formulario" id="formulario-editar-vehiculo-cliente" action="<?= $baseUrl ?>/actualizar-vehiculo-cliente" method="POST" enctype="multipart/form-data">
		<span class="respuesta"></span>
		<div class="offcanvas-body">
			<div class="row">
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="vehiculo_e" class="form-label">Vehiculo</label>
						<select class="form-control" id="vehiculo_e" name="vehiculo_e">
							<option value=""></option>
							<?php foreach($listaVehiculos as $items){ ?>
								<option value="<?= $items['id_vehiculo'] ?>">[<?= $items['placa'] ?>] - <?= $items['marca'] ?> <?= $items['modelo'] ?> <?= $items['ano_fabricacion'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="cliente_e" class="form-label">Cliente</label>
						<select class="form-control" id="cliente_e" name="cliente_e">
							<option value=""></option>
							<?php foreach($listaClientes as $items){ ?>
								<option value="<?= $items['id_cliente'] ?>">[<?= $items['tipo_documento'] ?> <?= $items['numero_documento'] ?>] - <?= $items['nombres'] ?> <?= $items['apellidos'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> Actualizar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<?php $this->endSection(); ?>