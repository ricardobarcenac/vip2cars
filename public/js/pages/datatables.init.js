document.addEventListener("DOMContentLoaded", function () {
    new DataTable("#example", {
        order: []
    })
});
document.addEventListener("DOMContentLoaded", function () {
    new DataTable("#example1", {
        order: []
    })
}), document.addEventListener("DOMContentLoaded", function() {
    new DataTable("#scroll-horizontal", {
        order: [],
        scrollX: !0
    })
}), document.addEventListener("DOMContentLoaded", function() {
    var oTable = new DataTable("#scroll-horizontal-productos", {
        processing: true,
        order: [],
        scrollX: !0,
		autoWidth: false, // Añadido para mejor control del ancho
        stateSave: false,
        initComplete: function (settings, json) {
            // Filter results on select change
            $('#cliente_f').on('change', function () {
                oTable.columns(3).search($(this).val(), true, false, false).draw();
            });
            // Filter results on select change
            $('#linea_producto').on('change', function () {
                oTable.columns(6).search($(this).val(), true, false, false).draw();
            });
            // Filter results on select change
            $('#tipo_anuncio').on('change', function () {
                oTable.columns(7).search($(this).val(), true, false, false).draw();
            });
            // Filter results on select change
            $('#marca_producto').on('change', function () {
                oTable.columns(8).search($(this).val(), true, false, false).draw();
            });
            // Filter results on select change
            $('#modelo').on('input', function () {
                oTable.columns(9).search($(this).val(), true, false, false).draw();
            });
            // Filter results on select change
            $('#ano').on('change', function () {
                oTable.columns(10).search($(this).val(), true, false, false).draw();
            });
            // Filter results on select change
            $('#condicion').on('change', function () {
                oTable.columns(11).search($(this).val(), true, false, false).draw();
            });
            // Filter results on select change
            $('#departamento').on('change', function () {
                oTable.columns(13).search($(this).val(), true, false, false).draw();
            });
            // Filter results on select change
            $('#precio_negociable').on('change', function () {
                oTable.columns(15).search($(this).val(), true, false, false).draw();
            });
            // Filter results on select change
            $('#lote_repuestos').on('change', function () {
                oTable.columns(17).search($(this).val(), true, false, false).draw();
            });
            // Filter results on select change
            $('#estado').on('change', function () {
                oTable.columns(22).search($(this).val(), true, false, false).draw();
            });
            // Filter results on select change
            $('#pais').on('change', function () {
                oTable.columns(13).search($(this).val(), true, false, false).draw();
            });
        }
    })
}), document.addEventListener("DOMContentLoaded", function() {
    var oTable = new DataTable("#scroll-horizontal-contactos", {
        processing: true,
        order: [],
        scrollX: !0,
        stateSave: false,
        initComplete: function (settings, json) {
            // Add select filter
            /*$('#scroll-horizontal-productos').append('<label>&nbsp; App ID:</label>');
            $('#scroll-horizontal-productos').append('<select class="form-control input-sm"  id="am_aplicacion_id"></select>');
            am_aplicacion_ids = [{0: 'Todos'}, {'Ricardo Barcena': 'Ricardo Barcena'}, {1: 'App ID 1'}, {2: 'App ID 2'}];
            for (var key in am_aplicacion_ids) {
                var obj = am_aplicacion_ids[key];
                for (var prop in obj) {
                    if (obj.hasOwnProperty(prop)) {
                        $('#am_aplicacion_id').append('<option value="' + prop + '">' + obj[prop] + '</option>');
                    }
                }
            }*/
            // Filter results on select change
            $('#cliente_f').on('change', function () {
                oTable.columns(1).search($(this).val(), true, false, false).draw();
            });
            // Filter results on select change
            $('#anuncio_f').on('change', function () {
                oTable.columns(0).search($(this).val(), true, false, false).draw();
            });
        }
    })
});
