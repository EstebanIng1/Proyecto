
//  INICIO MODAL DE REGISTRO
$(document).ready(function() {
    $('#modalContainer').load('Modal/RegistroModal.php');
});

function abrirModal() {
    $('#modalRegistrar').modal('show');
}

// FIN



// INICIO FUNCION ELIMINAR

var colegioIdToDelete;

// Función para almacenar el ID del colegio a eliminar
$('#modalEliminar').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
colegioIdToDelete = button.data('id');
});

// Función para eliminar el colegio
function eliminarColegio() {
// Redirigir a eliminar_colegio.php con el ID del colegio
window.location.href = "eliminar_colegio.php?id=" + colegioIdToDelete;
}
// FIN




//INICIO SCRIPT PARA BARRA DE BUSQUEDA

$(document).ready(function() {
    const itemsPerPage = 5;  // Número de elementos por página

    $('#searchInput').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();

        // Ocultar todas las filas
        $('#tablaColegios tbody tr').hide();

        // Filtrar y mostrar las filas que coincidan con la búsqueda
        $('#tablaColegios tbody tr').filter(function() {
            return $(this).text().toLowerCase().includes(searchTerm);
        }).slice(0, itemsPerPage).show();  // Mostrar solo el número acordado de resultados por página
    });
});


//FIN


//INICIO PARA PAGINACION

const itemsPerPage = 5;  // Número de elementos por página
let currentPage = 1;  // Página actual

// Función para actualizar los botones de paginación
function updatePagination() {
    $('#currentPage').text('Página ' + currentPage);
    $('#prevPage').prop('disabled', currentPage === 1);
}

// Función para cargar datos de la página actual
function loadPageData() {
    const startIdx = (currentPage - 1) * itemsPerPage;
    const endIdx = startIdx + itemsPerPage;

    // Oculta todas las filas de la tabla
    $('#tablaColegios tbody tr').hide();

    // Muestra solo las filas correspondientes a la página actual
    $('#tablaColegios tbody tr').slice(startIdx, endIdx).show();

    updatePagination();
}

// Manejador de eventos para el botón "Siguiente"
$('#nextPage').on('click', function () {
    currentPage++;
    loadPageData();
});

// Manejador de eventos para el botón "Anterior"
$('#prevPage').on('click', function () {
    if (currentPage > 1) {
        currentPage--;
        loadPageData();
    }
});

// Carga los datos de la primera página al cargar la página
$(document).ready(function () {
    loadPageData();
});

//FIN

