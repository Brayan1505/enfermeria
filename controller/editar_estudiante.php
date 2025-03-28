<?php

if (!empty($_POST["btnEditar"])) {
    if (!empty($_POST["nombres"]) and !empty($_POST["apellidos"]) and !empty($_POST["grado"]) and !empty($_POST["lugar"]) and !empty($_POST["horas"]) ) {
        $id=$_POST["id"];
        $nombres=$_POST["nombres"];
        $apellidos=$_POST["apellidos"];
        $grado=$_POST["grado"];
        $lugar=$_POST["lugar"];
        $horas=$_POST["horas"];
        $sql=$conexion->query("UPDATE estudiantes SET nombres='$nombres', apellidos='$apellidos', grado='$grado', lugar='$lugar', horas='$horas' WHERE id=$id");
        if ($sql==1) {
            echo "<div class='alert alert-success'>Estudiante actulizado satisfactoriamente</div>";
            echo "<script>
            setTimeout(function() {
                window.location.href = '../../AdminPa/dist/pages/index2.php';
            }, 1000);
          </script>";
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar datos del estudiante</div>";
        }
        
    }else{
        echo "<div class='alert alert-warning'>Alguno de los campos está vacio</div>";
    }
}


?>