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
                                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#anadirVehiculo" aria-controls="anadirVehiculo">
									<i class="mdi mdi-plus-circle"></i> Añadir nuevo
								</button>
                            </div>
                        </div>
						<div class="card-body">
							<table id="scroll-horizontal" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
								<thead>
									<tr>
										<th class="text-center align-middle">Marca</th>
										<th class="text-center align-middle">Modelo</th>
										<th class="text-center align-middle">Placa</th>
										<th class="text-center align-middle">Año de fabricación</th>
										<th class="text-center align-middle">Estado</th>
										<th class="text-center align-middle">Fecha de registro</th>
										<th class="text-center align-middle">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($listaVehiculos as $items){ ?>
									<tr>
										<td class="text-center align-middle"><?= $items['marca'] ?></td>
										<td class="text-center align-middle"><?= $items['modelo'] ?></td>
										<td class="text-center align-middle"><?= $items['placa'] ?></td>
										<td class="text-center align-middle"><?= $items['ano_fabricacion'] ?></td>
										<td class="text-center align-middle">
											<?php if($items['eliminacion_logica'] == 1) { echo '<span class="badge bg-success">ACTIVO</span>'; } else { echo '<span class="badge bg-danger">INACTIVO</span>'; } ?>
										</td>
										<td class="text-center align-middle"><?= date("d-m-Y H:i:s", strtotime($items['fecha_registro'])) ?></td>
										<td class="text-center align-middle">
											<?php if($items['eliminacion_logica'] == 1){ ?>
												<a href="javascript:;" role="button" id="editar-vehiculo" class="btn btn-primary btn-sm" data-id="<?= $items['id_vehiculo'] ?>" data-bs-toggle="offcanvas" data-bs-target="#editarVehiculo">
													<i class="ri-edit-line align-bottom text-white"></i>
												</a>
												<a href="javascript:;" role="button" class="btn btn-danger btn-sm removerInfo" data-url="<?= $baseUrl ?>/eliminar-vehiculo/<?= $items['id_vehiculo'] ?>" data-response="respuesta">
													<i class="ri-delete-bin-fill align-bottom text-white"></i>
												</a>
											<?php } else { ?>
												<a href="javascript:;" role="button" class="btn btn-success btn-sm removerInfo" data-url="<?= $baseUrl ?>/reactivar-vehiculo/<?= $items['id_vehiculo'] ?>" data-response="respuesta">
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
<div class="offcanvas offcanvas-end" id="anadirVehiculo" tabindex="-1" aria-labelledby="exampleanadirVehiculo" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="exampleanadirVehiculo">Añadir nueva vehiculo</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<form class="formulario" action="<?= $baseUrl ?>/grabar-vehiculo" method="POST" enctype="multipart/form-data">
		<span class="respuesta"></span>
		<div class="offcanvas-body">
			<div class="row">
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="marca_vehiculo" class="form-label">Marca</label>
						<select class="form-control" id="marca_vehiculo" name="marca_vehiculo">
							<option value=""></option>
							<?php foreach($listaMarcas as $items){ ?>
								<option value="<?= $items['id_marca'] ?>"><?= $items['marca'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="modelo_vehiculo" class="form-label">Modelo</label>
						<select class="form-control" id="modelo_vehiculo" name="modelo_vehiculo">
							<option value=""></option>
						</select>
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="placa" class="form-label">Placa</label>
						<input type="text" class="form-control" id="placa" name="placa">
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="ano_fabricacion" class="form-label">Año de fabricación</label>
						<input type="number" class="form-control" id="ano_fabricacion" name="ano_fabricacion">
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
<div class="offcanvas offcanvas-end" id="editarVehiculo" tabindex="-1" aria-labelledby="exampleeditarVehiculo" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="exampleeditarVehiculo">Información de vehiculo</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<form class="formulario" id="formulario-editar-vehiculo" action="<?= $baseUrl ?>/actualizar-vehiculo" method="POST" enctype="multipart/form-data">
		<span class="respuesta"></span>
		<div class="offcanvas-body">
			<div class="row">
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="marca_vehiculo_e" class="form-label">Marca</label>
						<select class="form-control" id="marca_vehiculo_e" name="marca_vehiculo_e">
							<option value=""></option>
							<?php foreach($listaMarcas as $items){ ?>
								<option value="<?= $items['id_marca'] ?>"><?= $items['marca'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="modelo_vehiculo_e" class="form-label">Modelo</label>
						<select class="form-control" id="modelo_vehiculo_e" name="modelo_vehiculo_e">
							<option value=""></option>
						</select>
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="placa_e" class="form-label">Placa</label>
						<input type="text" class="form-control" id="placa_e" name="placa_e">
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="ano_fabricacion_e" class="form-label">Año de fabricación</label>
						<input type="number" class="form-control" id="ano_fabricacion_e" name="ano_fabricacion_e">
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