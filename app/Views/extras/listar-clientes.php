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
								<li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
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
                                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#anadirCliente">
									<i class="mdi mdi-plus-circle"></i> Añadir nuevo
								</button>
                                <a href="<?= $baseUrl ?>/reporte-clientes" class="btn btn-primary">
									<i class="mdi mdi-file-excel-box-outline"></i> Reporte
								</a>
                            </div>
                        </div>
						<div class="card-body">
							<table id="scroll-horizontal" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
								<thead>
									<tr>
										<th class="text-center align-middle">Tipo de documento</th>
										<th class="text-center align-middle">Número de documento</th>
										<th class="text-center align-middle">Nombres</th>
										<th class="text-center align-middle">Apellidos</th>
										<th class="text-center align-middle">Teléfono</th>
										<th class="text-center align-middle">Correo electrónico</th>
										<th class="text-center align-middle">Estado</th>
										<th class="text-center align-middle">Fecha de registro</th>
										<th class="text-center align-middle">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($listaClientes as $items){ ?>
										<tr>
											<td class="text-center align-middle"><?= $items['tipo_documento'] ?></td>
											<td class="text-center align-middle"><?= $items['numero_documento'] ?></td>
											<td class="text-center align-middle"><?= $items['nombres'] ?></td>
											<td class="text-center align-middle"><?= $items['apellidos'] ?></td>
											<td class="text-center align-middle"><?= $items['telefono'] ?></td>
											<td class="text-center align-middle"><?= $items['correo_electronico'] ?></td>
											<td class="text-center align-middle"><?php if($items['eliminacion_logica'] == 1) { echo '<span class="badge bg-success">ACTIVO</span>'; } else { echo '<span class="badge bg-danger">INACTIVO</span>'; } ?></td>
											<td class="text-center align-middle"><?= date("d-m-Y H:i:s", strtotime($items['fecha_registro'])) ?></td>
											<td class="text-center align-middle">
												<?php if($items['eliminacion_logica'] == 1){ ?>
													<a href="#!" class="btn btn-dark btn-sm" data-bs-toggle="offcanvas" data-bs-target="#editarCliente" data-id="<?= $items['id_cliente'] ?>" id="editar-cliente">
														<i class="ri-pencil-fill align-bottom"></i>
													</a>
												<?php } ?>
												<?php if($items['eliminacion_logica'] == 1){ ?>
													<a href="javascript:;" role="button" class="btn btn-danger btn-sm removerInfo" data-url="<?= $baseUrl ?>/eliminar-cliente/<?= $items['id_cliente'] ?>" data-response="respuesta">
														<i class="ri-delete-bin-fill align-bottom"></i>
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
						Desarrollado por <a href="https://linktr.ee/rbarcenac/">Ricardo Barcena</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
<!-- end main content-->
<!-- Offcanvas Añadir Cliente -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="anadirCliente" aria-labelledby="exampleanadirCliente">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="exampleanadirCliente">Añadir nuevo cliente</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body">
		<form class="formulario" action="<?= $baseUrl ?>/grabar-cliente" method="POST">
			<span class="respuesta"></span>
			<div class="row">
				<div class="col-12 mb-3">
					<label for="tipo_documento" class="form-label">Tipo de documento</label>
                    <select class="form-select select2" aria-label="Perfil" id="tipo_documento" name="tipo_documento">
                        <option value=""></option>
						<?php foreach($listaTipoDocumento as $itemsP){ ?>
						<option value="<?= $itemsP['id_tipo_documento'] ?>"><?= $itemsP['tipo_documento'] ?></option>
						<?php } ?>
                    </select>
                </div>
			</div>
			<div class="row">
				<div class="col-12 mb-3">
                    <div>
                        <label for="numero_documento" class="form-label">Número de documento</label>
                        <input type="text" class="form-control" min="8" max="12" id="numero_documento" name="numero_documento">
                    </div>
                </div>
				<div class="col-12 mb-3">
                    <div>
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombres" name="nombres">
                    </div>
                </div>
				<div class="col-12 mb-3">
                    <div>
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos">
                    </div>
                </div>
				<div class="col-12 mb-3">
                    <div>
                        <label for="correo_electronico" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico">
                    </div>
                </div>
				<div class="col-12 mb-3">
                    <div>
						<label for="telefono" class="form-label">Teléfono</label>
						<input type="tel" class="form-control" id="telefono" name="telefono" />
                    </div>
                </div>
			</div>
			<div class="d-flex gap-2 justify-content-end">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cerrar</button>
				<button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> Guardar</button>
			</div>
		</form>
	</div>
</div>
<!-- Offcanvas Editar Cliente -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="editarCliente" aria-labelledby="exampleeditarCliente">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="exampleeditarCliente">Editar cliente</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body">
		<form id="formulario-editar-cliente" class="formulario" action="<?= $baseUrl ?>/actualizar-cliente" method="POST">
			<span class="respuesta"></span>
			<div class="row">
				<div class="col-12 mb-3">
					<label for="tipo_documento_e" class="form-label">Tipo de documento</label>
                    <select class="form-select select2" aria-label="Perfil" id="tipo_documento_e" name="tipo_documento_e">
                        <option value=""></option>
						<?php foreach($listaTipoDocumento as $itemsP){ ?>
						<option value="<?= $itemsP['id_tipo_documento'] ?>"><?= $itemsP['tipo_documento'] ?></option>
						<?php } ?>
                    </select>
                </div>
			</div>
			<div class="row">
				<div class="col-12 mb-3">
                    <div>
                        <label for="numero_documento_e" class="form-label">Número de documento</label>
                        <input type="text" class="form-control" min="8" max="12" id="numero_documento_e" name="numero_documento_e">
                    </div>
                </div>
				<div class="col-12 mb-3">
                    <div>
                        <label for="nombres_e" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombres_e" name="nombres_e">
                    </div>
                </div>
				<div class="col-12 mb-3">
                    <div>
                        <label for="apellidos_e" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos_e" name="apellidos_e">
                    </div>
                </div>
				<div class="col-12 mb-3">
                    <div>
                        <label for="correo_electronico_e" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo_electronico_e" name="correo_electronico_e">
                    </div>
                </div>
				<div class="col-12 mb-3">
                    <div>
						<label for="telefono_e" class="form-label">Teléfono</label>
						<input type="text" class="form-control" id="telefono_e" name="telefono_e" />
                    </div>
                </div>
			</div>
			<div class="d-flex gap-2 justify-content-end">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cerrar</button>
				<button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> Guardar</button>
			</div>
		</form>
	</div>
</div>
<?php $this->endSection(); ?>