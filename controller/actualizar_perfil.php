<?php 
session_start();
require_once '../model/conexion.php';
require_once '../model/usuarioModelo.php';

// Verifica si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnGcambios'])) {
    // Datos enviados desde el formulario
    $id = $_SESSION['id']; // ID del usuario
    $nuevo_nombre = $conexion->real_escape_string($_POST['nombre']);
    $foto_binaria = null;

    // Procesar la nueva foto si fue cargada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_binaria = addslashes(file_get_contents($foto_tmp));
    }

    // Llamar al modelo para actualizar el perfil
    if (actualizarPerfil($conexion, $id, $nuevo_nombre, $foto_binaria)) {
        // Actualizar datos en la sesión
        $_SESSION['nombre'] = $nuevo_nombre;
        if ($foto_binaria) {
            $_SESSION['foto'] = "data:image/jpeg;base64," . base64_encode($foto_binaria);
        }

        
        header("Location: http://localhost/enfermeria/AdminPa/dist/pages/index.php mensaje=Perfil actualizado correctamente ");
        exit(); // Terminar ejecución después de redirigir
    } else {
        header("Location: ../vista/perfil.php?error=No se pudo actualizar el perfil");
        exit(); // Terminar ejecución después de redirigir
    }
} else {
    header("Location: ../vista/perfil.php?error=Acción no permitida");
    exit(); // Terminar ejecución después de redirigir
}
?>

