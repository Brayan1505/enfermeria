<?php
if (!empty($_GET["id"])) {
    include "../../../model/conexion.php"; 

    $id = $_GET["id"];
    $sql = $conexion->query("DELETE FROM insumos WHERE id=$id");

    if ($sql == 1) {
        echo "<script>
                alert('Estudiante eliminado satisfactoriamente');
                window.location.href = 'index4.php'; // Redirige sin el parámetro id
              </script>";
    } else {
        echo "<script>
                alert('Error al eliminar estudiante');
              </script>";
    }
}
?>
