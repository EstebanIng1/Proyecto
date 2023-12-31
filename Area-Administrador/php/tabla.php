<?php
            
include "conexion.php";

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;  // Página actual
$itemsPerPage = 100000;  // Número de elementos por página
$offset = ($page - 1) * $itemsPerPage;  // Calcular el desplazamiento


// Consulta SQL para obtener los datos de los colegios y sus jornadas
$sql = "SELECT colegios.id_colegios, colegios.nombre, colegios.tipo_de_colegio, colegios.total_estudiantes, 
jornada_manana.estudiantes_manana, jornada_tarde.estudiantes_tarde, 
jornada_noche.estudiantes_noche, jornada_sabatina.estudiantes_sabatina, jornada_completa.estudiantes_completa,
colegios.logo
FROM colegios
LEFT JOIN jornada_manana ON colegios.id_colegios = jornada_manana.id_colegios
LEFT JOIN jornada_tarde ON colegios.id_colegios = jornada_tarde.id_colegios
LEFT JOIN jornada_noche ON colegios.id_colegios = jornada_noche.id_colegios
LEFT JOIN jornada_sabatina ON colegios.id_colegios = jornada_sabatina.id_colegios
LEFT JOIN jornada_completa ON colegios.id_colegios = jornada_completa.id_colegios
LIMIT $offset, $itemsPerPage";



$result = $conn->query($sql);

if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $x = $row["logo"];
        echo "<tr>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["tipo_de_colegio"] . "</td>";
        echo "<td>" . $row["total_estudiantes"] . "</td>";
        echo "<td>" . $row["estudiantes_manana"] . "</td>";
        echo "<td>" . $row["estudiantes_tarde"] . "</td>";
        echo "<td>" . $row["estudiantes_completa"] . "</td>";
        echo "<td>" . $row["estudiantes_noche"] . "</td>";
        echo "<td>" . $row["estudiantes_sabatina"] . "</td>";
        echo "<td><img src='$x' alt='Logo' style='width: 70px; height: 70px;'></td>";
        echo "<td><a href='php/editar.php?id=" . $row['id_colegios'] . "&page=" . $page . "'type='button' class='btn btn-primary'><i class='fa-solid fa-pen-to-square'></i>Editar</a>
        </td>";
        echo '<td><button class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar" data-id="' . $row["id_colegios"] . '&page=' . $page . '"><i class="fa-solid fa-trash-can"></i>Eliminar</button>
        </td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='10'>No se encontraron registros.</td></tr>";
}

// Cierra la conexión a la base de datos
$conn->close();
