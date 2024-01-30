// Función para configurar DataTable y botones
function configurarTabla(idTabla, rutaExcel) {
    $('#' + idTabla).DataTable({
        "language": {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        },
        dom: '<"row"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4"<"dt-buttons btn-group flex-wrap"B>><"col-sm-12 col-md-4"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o">Descargar en Excel</i>',
                titleAttr: 'Exportar a Excel',
                className: 'btn btn-success',
                action: function(e, dt, node, config) {
                    top.location.href = rutaExcel;
                }
            },
        ],
        "bProcessing": true
    });
}

// Llama a la función para configurar la tabla de libros
$(document).ready(function() {
    configurarTabla('tblLibros', 'informes/informe_excel_libros.php');
});

// Llama a la función para configurar la tabla de autores
$(document).ready(function() {
    configurarTabla('tblAutores', 'informes/informe_excel_autores.php');
});

// Llama a la función para configurar la tabla de estudiantes
$(document).ready(function() {
    configurarTabla('tblEst', 'informes/informe_excel_estudiantes.php');
});

// Llama a la función para configurar la tabla de Usuarios
$(document).ready(function() {
    configurarTabla('tblUsuarios', 'informes/informe_excel_usuarios.php');
});

// Llama a la función para configurar la tabla de Prestamos
$(document).ready(function() {
    configurarTabla('tblPrestamos', 'informes/informe_excel_prestamos.php');
});

