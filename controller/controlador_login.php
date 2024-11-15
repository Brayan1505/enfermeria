<?php
if(!empty($_POST["btningresar"])){
    if (!empty($_POST["usuario"]) and !empty($_POST["contrasena"])) {
        $usuario=$_POST["usuario"];
        $contrasena=$_POST["contrasena"];
        $sql=$conexion->query ("SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasena='$contrasena'");
        if ($datos = $sql->fetch_object()) {
            //header("location: prueba.php");
            header("location: AdminPa/dist/pages/index.php");
        } else {
            echo("<div class= 'alert alert-danger'> Acceso denegado</div>");
        }
        
    } else {
        echo "campos vacios";
    }
    
}
?>



