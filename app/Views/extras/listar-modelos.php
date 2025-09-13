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
                                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#anadirModelo" aria-controls="anadirModelo">
									<i class="mdi mdi-plus-circle"></i> Añadir nuevo
								</button>
                            </div>
                        </div>
						<div class="card-body">
							<table id="scroll-horizontal" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
								<thead>
									<tr>
										<th class="text-center align-middle">Modelo</th>
										<th class="text-center align-middle">Marca</th>
										<th class="text-center align-middle">Estado</th>
										<th class="text-center align-middle">Fecha de registro</th>
										<th class="text-center align-middle">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($listaModelos as $items){ ?>
									<tr>
										<td class="text-center align-middle"><?= $items['marca'] ?></td>
										<td class="text-center align-middle"><?= $items['modelo'] ?></td>
										<td class="text-center align-middle">
											<?php if($items['eliminacion_logica'] == 1) { echo '<span class="badge bg-success">ACTIVO</span>'; } else { echo '<span class="badge bg-danger">INACTIVO</span>'; } ?>
										</td>
										<td class="text-center align-middle"><?= date("d-m-Y H:i:s", strtotime($items['fecha_registro'])) ?></td>
										<td class="text-center align-middle">
											<?php if($items['eliminacion_logica'] == 1){ ?>
												<a href="javascript:;" role="button" id="editar-modelo" class="btn btn-primary btn-sm" data-id="<?= $items['id_modelo'] ?>" data-bs-toggle="offcanvas" data-bs-target="#editarModelo">
													<i class="ri-edit-line align-bottom text-white"></i>
												</a>
												<a href="javascript:;" role="button" class="btn btn-danger btn-sm removerInfo" data-url="<?= $baseUrl ?>/eliminar-modelo/<?= $items['id_modelo'] ?>" data-response="respuesta">
													<i class="ri-delete-bin-fill align-bottom text-white"></i>
												</a>
											<?php } else { ?>
												<a href="javascript:;" role="button" class="btn btn-success btn-sm removerInfo" data-url="<?= $baseUrl ?>/reactivar-modelo/<?= $items['id_modelo'] ?>" data-response="respuesta">
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
<!-- Offcanvas Añadir Marca -->
<div class="offcanvas offcanvas-end" id="anadirModelo" tabindex="-1" aria-labelledby="exampleanadirModelo" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="exampleanadirModelo">Añadir nueva modelo</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<form class="formulario" action="<?= $baseUrl ?>/grabar-modelo" method="POST" enctype="multipart/form-data">
		<span class="respuesta"></span>
		<div class="offcanvas-body">
			<div class="row">
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="marca" class="form-label">Marca</label>
						<select class="form-control" id="marca" name="marca">
							<option value=""></option>
							<?php foreach($listaMarcas as $items){ ?>
								<option value="<?= $items['id_marca'] ?>"><?= $items['marca'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="nombre_modelo" class="form-label">Modelo</label>
						<input type="text" class="form-control" id="nombre_modelo" name="nombre_modelo">
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> Guardar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- Offcanvas Editar Marca -->
<div class="offcanvas offcanvas-end" id="editarModelo" tabindex="-1" aria-labelledby="exampleeditarModelo" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="exampleeditarModelo">Información de modelo</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<form class="formulario" id="formulario-editar-modelo" action="<?= $baseUrl ?>/actualizar-modelo" method="POST" enctype="multipart/form-data">
		<span class="respuesta"></span>
		<div class="offcanvas-body">
			<div class="row">
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="marca_e" class="form-label">Marca</label>
						<select class="form-control" id="marca_e" name="marca_e">
							<option value=""></option>
							<?php foreach($listaMarcas as $items){ ?>
								<option value="<?= $items['id_marca'] ?>"><?= $items['marca'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="nombre_modelo_e" class="form-label">Modelo</label>
						<input type="text" class="form-control" id="nombre_modelo_e" name="nombre_modelo_e">
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