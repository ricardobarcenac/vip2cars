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
                            <!--<div>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#anadirAlmacen">
									<i class="mdi mdi-plus-circle"></i> Añadir nuevo perfil
								</button>
                            </div>-->
                        </div>
						<div class="card-body">
							<table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
								<thead>
									<tr>
										<!--<th scope="col" style="width: 10px;">
											<div class="form-check">
												<input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
											</div>
										</th>-->
										<th class="text-center align-middle">Código</th>
										<th class="text-center align-middle">Rol</th>
										<th class="text-center align-middle">Estado</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($listaPerfiles as $items){ ?>
									<tr>
										<!--<th scope="row">
											<div class="form-check">
												<input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
											</div>
										</th>-->
										<td class="text-center align-middle"><?= $items['id_perfil'] ?></td>
										<td class="text-center align-middle"><?= $items['descripcion'] ?></td>
										<td class="text-center align-middle"><?php if($items['eliminacion_logica'] == 1) { echo '<span class="badge bg-success">ACTIVO</span>'; } else { echo '<span class="badge bg-danger">INACTIVO</span>'; } ?></td>
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
					<script>document.write(new Date().getFullYear())</script> © RMEventos.
				</div>
				<div class="col-sm-6">
					<div class="text-sm-end d-none d-sm-block">
						Desarrollado por <a href="https://loovusperu.com">Loovus Perú</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
<!-- end main content-->
<!-- Modal Añadir Perfil -->
<div class="modal fade" id="editarPerfil" tabindex="-1" role="dialog" aria-labelledby="exampleeditarPerfil" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleeditarPerfil">Información de rol</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form class="formulario" id="formulario-editar-perfil" action="<?= $baseUrl ?>/actualizar-perfil" method="POST">
				<span class="respuesta"></span>
				<div class="modal-body">
					<div class="row">
						<div class="col-xxl-12 col-md-12 col-12 mb-3">
                            <div>
                                <label for="codigo_e" class="form-label">Código</label>
                                <input type="number" class="form-control" id="codigo_e" name="codigo_e" disabled>
                            </div>
                        </div>
						<div class="col-xxl-12 col-md-12 col-12 mb-3">
                            <div>
                                <label for="nombre_perfil_e" class="form-label">Nombre perfil</label>
                                <input type="text" class="form-control" id="nombre_perfil_e" name="nombre_perfil_e">
                            </div>
                        </div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> Actualizar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->endSection(); ?>