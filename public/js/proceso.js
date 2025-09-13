$('#marca').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#anadirModelo"),
});

$('#marca_e').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#editarModelo"),
});

$('#tipo_documento').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#anadirCliente"),
});

$('#tipo_documento_e').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#editarCliente"),
});

$('#marca_vehiculo').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#anadirVehiculo"),
});

$('#modelo_vehiculo').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#anadirVehiculo"),
});

$('#modelo_vehiculo_e').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#editarVehiculo"),
});

$('#marca_vehiculo_e').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#editarVehiculo"),
});

$('#vehiculo').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#anadirVehiculoCliente"),
});

$('#cliente').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#anadirVehiculoCliente"),
});

$('#vehiculo_e').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#editarVehiculoCliente"),
});

$('#cliente_e').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#editarVehiculoCliente"),
});

$('#perfil').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#anadirUsuario"),
});

$('#perfil_e').select2({
    placeholder: "Selecciona una opción",
    allowClear: true,
    dropdownParent: $("#editarUsuario"),
});

/* ------------------------------- */
$(document).on('submit', '.formulario', function() {
    //$.blockUI({css: {border: 'none', overflow: 'hidden !important', padding: '15px', backgroundColor: '#000', '-webkit-border-radius': '10px', '-moz-border-radius': '10px', opacity: .5, color: '#fff'}});
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

/* ------------------------------- */
$(document).on('click', '.removerInfo', function(e) {
    e.preventDefault();
    vinculo = $(this).attr("data-url");
    respuesta = $(this).attr("data-response");

    Swal.fire({
        title: '¿Estas seguro que deseas continuar?',
        text: "Recuerda que esta acción es permanente.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#282e38',
        cancelButtonColor: '#f35d5d',
        confirmButtonText: 'Confirmar',
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(vinculo, 
                { }, 
                function (response) {
                    $('.'+respuesta).html(response);
                });
                return false;
            }
    });
});

/* MARCAS */
/* ------------------------------- */
$(document).on('click', '#editar-marca', function(e) {
    var marca = $(this).data('id');
    
    $.post(baseUrl + '/obtener-info-marca', 
        {         
            marca : marca
        }, 
        function(response) {
            var total = Object.keys(response).length;
            for (var i = 0; i < total; i++) {
                if (response[i].descripcion === 0) {
                    alert("Ocurrió un error al obtener los datos.");
                } else {
                    $esInmediata = response[i].inmediata == 1;
                    $('#formulario-editar-marca').attr('action', baseUrl + '/actualizar-marca/' + marca);
                    $("#nombre_marca_e").val(response[i].marca);
                }
            }
        }, 'json');
});

/* MODELOS */
/* ------------------------------- */
$(document).on('click', '#editar-modelo', function(e) {
    var modelo = $(this).data('id');
    
    $.post(baseUrl + '/obtener-info-modelo', 
        {         
            modelo : modelo
        }, 
        function(response) {
            var total = Object.keys(response).length;
            for (var i = 0; i < total; i++) {
                if (response[i].descripcion === 0) {
                    alert("Ocurrió un error al obtener los datos.");
                } else {
                    $esInmediata = response[i].inmediata == 1;
                    $('#formulario-editar-modelo').attr('action', baseUrl + '/actualizar-modelo/' + modelo);
                    $("#marca_e").select2("trigger", "select", {data: { id: response[i].marca_id ,text: response[i].marca_id}});
                    $("#nombre_modelo_e").val(response[i].modelo);
                }
            }
        }, 'json');
});

/* CLIENTES */
/* ------------------------------- */
$(document).on('click', '#editar-cliente', function(e) {
    var cliente = $(this).data('id');
    
    $.post(baseUrl + '/obtener-info-cliente', 
        {         
            cliente : cliente
        }, 
        function(response) {
            var total = Object.keys(response).length;
            for (var i = 0; i < total; i++) {
                if (response[i].descripcion === 0) {
                    alert("Ocurrió un error al obtener los datos.");
                } else {
                    $('#formulario-editar-cliente').attr('action', baseUrl + '/actualizar-cliente/' + cliente);
                    $("#tipo_documento_e").select2("trigger", "select", {data: { id: response[i].tipo_documento_id ,text: response[i].tipo_documento_id}});
                    $("#numero_documento_e").val(response[i].numero_documento);
                    $("#nombres_e").val(response[i].nombres);
                    $("#apellidos_e").val(response[i].apellidos);
                    $("#correo_electronico_e").val(response[i].correo_electronico);
                    $("#telefono_e").val(response[i].telefono);
                }
            }
        }, 'json');
});

/* VEHICULOS */
/* ------------------------------- */
$(document).on('change', '#marca_vehiculo', function(e) {
    var marca = $(this).val();
    
    $.post(baseUrl + '/obtener-modelos', 
        {         
            marca : marca
        }, 
        function(response) {
            var total = Object.keys(response).length;
            for (var i = 0; i < total; i++) {
                if (response[i].descripcion === 0) {
                    alert("No se encontraron modelos.");
                } else {
                    $('#modelo_vehiculo').append('<option value="' + response[i].id_modelo + '">' + response[i].modelo + '</option>');
                }
            }
        }, 'json');
});

/* ------------------------------- */
$(document).on('click', '#editar-vehiculo', function(e) {
    var vehiculo = $(this).data('id');
    
    $.post(baseUrl + '/obtener-info-vehiculo', 
        {         
            vehiculo : vehiculo
        }, 
        function(response) {
            var total = Object.keys(response).length;
            for (var i = 0; i < total; i++) {
                if (response[i].descripcion === 0) {
                    alert("Ocurrió un error al obtener los datos.");
                } else {
                    // Limpiar opciones previas del select de modelos
                    $('#modelo_vehiculo_e').empty();
                    
                    $.post(baseUrl + '/obtener-modelos', 
                        {         
                            marca : response[i].marca_id
                        }, 
                        function(responseModelos) {
                            var totalModelos = Object.keys(responseModelos).length;
                            for (var j = 0; j < totalModelos; j++) {
                                if (responseModelos[j].descripcion === 0) {
                                    alert("No se encontraron modelos.");
                                } else {
                                    $('#modelo_vehiculo_e').append('<option value="' + responseModelos[j].id_modelo + '">' + responseModelos[j].modelo + '</option>');
                                }
                            }
                        }, 'json');

                    $('#formulario-editar-vehiculo').attr('action', baseUrl + '/actualizar-vehiculo/' + vehiculo);
                    $("#marca_vehiculo_e").select2("trigger", "select", {data: { id: response[i].marca_id ,text: response[i].marca_id}});
                    $("#placa_e").val(response[i].placa);
                    $("#ano_fabricacion_e").val(response[i].ano_fabricacion);
                }
            }
        }, 'json');
});

/* ------------------------------- */
$(document).on('change', '#marca_vehiculo_e', function(e) {
    var marca = $(this).val();
    
    $.post(baseUrl + '/obtener-modelos', 
        {         
            marca : marca
        }, 
        function(response) {
            var total = Object.keys(response).length;
            for (var i = 0; i < total; i++) {
                if (response[i].descripcion === 0) {
                    alert("No se encontraron modelos.");
                } else {
                    $('#modelo_vehiculo_e').append('<option value="' + response[i].id_modelo + '">' + response[i].modelo + '</option>');
                }
            }
        }, 'json');
});

/* VEHICULOS CLIENTES */
/* ------------------------------- */
$(document).on('click', '#editar-vehiculo-cliente', function(e) {
    var vehiculoCliente = $(this).data('id');
    
    $.post(baseUrl + '/obtener-info-vehiculo-cliente', 
        {         
            vehiculoCliente : vehiculoCliente
        }, 
        function(response) {
            var total = Object.keys(response).length;
            for (var i = 0; i < total; i++) {
                if (response[i].descripcion === 0) {
                    alert("Ocurrió un error al obtener los datos.");
                } else {
                    $('#formulario-editar-vehiculo-cliente').attr('action', baseUrl + '/actualizar-vehiculo-cliente/' + vehiculoCliente);
                    $("#vehiculo_e").select2("trigger", "select", {data: { id: response[i].vehiculo_id ,text: response[i].vehiculo_id}});
                    $("#cliente_e").select2("trigger", "select", {data: { id: response[i].cliente_id ,text: response[i].cliente_id}});
                }
            }
        }, 'json');
});

/* USUARIOS */
/* ------------------------------- */
$(document).on('click', '#editar-usuario', function(e) {
    var usuario = $(this).data('id');
    
    $.post(baseUrl + '/obtener-info-usuario', 
        {         
            usuario : usuario
        }, 
        function(response) {
            var total = Object.keys(response).length;
            for (var i = 0; i < total; i++) {
                if (response[i].descripcion === 0) {
                    alert("Ocurrió un error al obtener los datos.");
                } else {
                    $('#formulario-editar-usuario').attr('action', baseUrl + '/actualizar-usuario/' + usuario);
                    $("#perfil_e").select2("trigger", "select", {data: { id: response[i].perfil_id ,text: response[i].perfil_id}});
                    $("#nombres_e").val(response[i].nombres);
                    $("#apellidos_e").val(response[i].apellidos);
                    $("#correo_electronico_e").val(response[i].correo_electronico);
                    $("#telefono_e").val(response[i].telefono);
                }
            }
        }, 'json');
});