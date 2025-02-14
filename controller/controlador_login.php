<?php
session_start();
require_once(__DIR__ . "/../model/conexion.php"); // Incluir conexión a la BD

if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usuario"]) && !empty($_POST["contrasena"])) {
        $usuario = trim($_POST["usuario"]);
        $contrasena = trim($_POST["contrasena"]);

        // Consulta segura con prepared statements
        $sql = $conexion->prepare("SELECT id, nombre, foto, contrasena FROM usuarios WHERE usuario = ?");
        $sql->bind_param("s", $usuario);
        $sql->execute();
        $resultado = $sql->get_result();

        if ($datos = $resultado->fetch_assoc()) {
            // Verificar la contraseña encriptada
            if (password_verify($contrasena, $datos['contrasena'])) {
                $_SESSION["id"] = $datos["id"];
                $_SESSION["nombre"] = htmlspecialchars($datos["nombre"], ENT_QUOTES, 'UTF-8');

                // Manejo de imagen de perfil
                if (!empty($datos['foto'])) {
                    $_SESSION["foto"] = "data:image/jpeg;base64," . base64_encode($datos["foto"]);
                } else {
                    $_SESSION["foto"] = "../AdminPa/dist/assets/img/RP.png"; // Imagen por defecto
                }

                header("location: /enfermeria/AdminPa/dist/pages/index.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>❌ Contraseña incorrecta</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>⚠️ Usuario no encontrado</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>⚠️ Por favor, completa todos los campos</div>";
    }
}
?>
