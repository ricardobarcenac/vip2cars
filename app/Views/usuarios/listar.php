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
                                <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#anadirUsuario">
									<i class="mdi mdi-plus-circle"></i> Añadir nuevo
								</button>
                                <a href="<?= $baseUrl ?>/reporte-usuarios" class="btn btn-primary">
									<i class="mdi mdi-file-excel-box-outline"></i> Reporte
								</a>
                            </div>
                        </div>
						<div class="card-body">
							<table id="scroll-horizontal" class="table table-bordered nowrap table-striped align-middle" style="width:100%">
								<thead>
									<tr>
										<th class="text-center align-middle">Fecha de registro</th>
										<th class="text-center align-middle">Nombres completos</th>
										<th class="text-center align-middle">Correo electrónico</th>
										<th class="text-center align-middle">Teléfono</th>
										<th class="text-center align-middle">Estado</th>
										<th class="text-center align-middle">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($listaUsuarios as $items){ ?>
									<tr>
										<td class="text-center align-middle"><?= date("d-m-Y H:i:s", strtotime($items['fecha_registro'])) ?></td>
										<td class="text-center align-middle"><?= $items['nombres'].' '.$items['apellidos'] ?></td>
										<td class="text-center align-middle"><?= $items['correo_electronico'] ?></td>
										<td class="text-center align-middle"><?= $items['telefono'] ?></td>
										<td class="text-center align-middle"><?php if($items['eliminacion_logica'] == 1) { echo '<span class="badge bg-success">ACTIVO</span>'; } else { echo '<span class="badge bg-danger">INACTIVO</span>'; } ?></td>
										<td class="text-center align-middle">
											<?php if($items['eliminacion_logica'] == 1){ ?>
												<a href="#!" class="btn btn-dark btn-sm" data-bs-toggle="offcanvas" data-bs-target="#editarUsuario" data-id="<?= $items['id_usuario'] ?>" id="editar-usuario">
													<i class="ri-pencil-fill align-bottom"></i>
												</a>
											<?php } ?>
											<?php if($items['eliminacion_logica'] == 1){ ?>
												<a href="javascript:;" role="button" class="btn btn-danger btn-sm removerInfo" data-url="<?= $baseUrl ?>/eliminar-usuario/<?= $items['id_usuario'] ?>" data-response="respuesta">
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
<!-- Offcanvas Añadir Usuario -->
<div class="offcanvas offcanvas-end" id="anadirUsuario" tabindex="-1" aria-labelledby="exampleanadirUsuario" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="exampleanadirUsuario">Añadir nuevo usuario</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<form class="formulario" action="<?= $baseUrl ?>/grabar-usuario" method="POST">
		<span class="respuesta"></span>
		<div class="offcanvas-body">
			<div class="row">
				<div class="col-xxl-12 col-md-6 col-12 mb-3">
					<label for="perfil" class="form-label">Perfil</label>
					<select class="form-select select2" aria-label="Perfil" id="perfil" name="perfil">
						<option value=""></option>
						<?php foreach($listaPerfiles as $itemsP){ ?>
						<option value="<?= $itemsP['id_perfil'] ?>"><?= $itemsP['descripcion'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="nombres" class="form-label">Nombres</label>
						<input type="text" class="form-control" id="nombres" name="nombres">
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="apellidos" class="form-label">Apellidos</label>
						<input type="text" class="form-control" id="apellidos" name="apellidos">
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="correo_electronico" class="form-label">Correo electrónico</label>
						<input type="email" class="form-control" id="correo_electronico" name="correo_electronico">
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="contrasena" class="form-label">Contraseña</label>
						<input type="passowrd" class="form-control" id="contrasena" name="contrasena">
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="telefono" class="form-label">Teléfono</label>
						<input type="tel" class="form-control" id="telefono" name="telefono" />
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> Guardar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- Offcanvas Editar Usuario -->
<div class="offcanvas offcanvas-end" id="editarUsuario" tabindex="-1" aria-labelledby="exampleeditarUsuario" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="exampleeditarUsuario">Editar usuario</h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<form id="formulario-editar-usuario" class="formulario" action="<?= $baseUrl ?>/actualizar-usuario" method="POST">
		<span class="respuesta"></span>
		<div class="offcanvas-body">
			<div class="row">
				<div class="col-xxl-12 col-md-6 col-12 mb-3">
					<label for="perfil_e" class="form-label">Perfil</label>
					<select class="form-select select2" aria-label="Perfil" id="perfil_e" name="perfil_e">
						<option value=""></option>
						<?php foreach($listaPerfiles as $itemsP){ ?>
						<option value="<?= $itemsP['id_perfil'] ?>"><?= $itemsP['descripcion'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="nombres_e" class="form-label">Nombres</label>
						<input type="text" class="form-control" id="nombres_e" name="nombres_e">
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="apellidos_e" class="form-label">Apellidos</label>
						<input type="text" class="form-control" id="apellidos_e" name="apellidos_e">
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="correo_electronico_e" class="form-label">Correo electrónico</label>
						<input type="email" class="form-control" id="correo_electronico_e" name="correo_electronico_e">
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<div>
						<label for="telefono_e" class="form-label">Teléfono</label>
						<input type="text" class="form-control" id="telefono_e" name="telefono_e" />
					</div>
				</div>
				<div class="col-xxl-12 col-md-12 col-12 mb-3">
					<button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> Guardar</button>
				</div>
			</div>
		</div>
	</form>
</div>
<?php $this->endSection(); ?>