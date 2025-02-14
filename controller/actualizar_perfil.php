<?php 
session_start();
require_once '../model/conexion.php';
require_once '../model/usuarioModelo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnGcambios'])) {
    $id = $_SESSION['id']; 
    $nuevo_nombre = $conexion->real_escape_string($_POST['nombre']);
    $foto_binaria = null;

    // Validación si se ha subido un archivo
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
        $tipo_archivo = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

        if (in_array(strtolower($tipo_archivo), $extensiones_permitidas)) {
            $foto_tmp = $_FILES['foto']['tmp_name'];
            $foto_binaria = file_get_contents($foto_tmp);
        } else {
            header("Location: ../vista/perfil.php?error=Formato de archivo no permitido");
            exit();
        }
    }

    // Actualizar perfil
    if (actualizarPerfil($conexion, $id, $nuevo_nombre, $foto_binaria)) {
        $_SESSION['nombre'] = $nuevo_nombre;
        
        // Recuperar la imagen después de actualizar
        $stmt = $conexion->prepare("SELECT foto FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($foto_blob);
        $stmt->fetch();
        $stmt->close();

        if ($foto_blob) {
            $_SESSION['foto'] = "data:image/jpeg;base64," . base64_encode($foto_blob);
        }

        header("Location: ../AdminPa/dist/pages/index.php");
        exit(); 
    } else {
        header("Location: ../vista/perfil.php?error=No se pudo actualizar el perfil");
        exit(); 
    }
} else {
    header("Location: ../vista/perfil.php?error=Acción no permitida");
    exit(); 
}
