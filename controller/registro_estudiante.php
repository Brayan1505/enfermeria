<?php
include "../../model/conexion.php";


if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["nombres"]) && !empty($_POST["apellidos"]) && !empty($_POST["grado"]) && !empty($_POST["lugar"]) && !empty($_POST["horas"])) {

        $nombres=$_POST["nombres"];
        $apellidos=$_POST["apellidos"];
        $grado=$_POST["grado"];
        $lugar=$_POST["lugar"];
        $horas=$_POST["horas"];

        $sql = $conexion->query("INSERT INTO estudiantes (nombres, apellidos, grado, lugar, horas) 
        VALUES ('$nombres', '$apellidos', '$grado', '$lugar', '$horas')");

        if ($sql == 1) {
            echo "<div class='alert alert-success'>Estudiante Registrado satisfactoriamente</div>";
            echo "<script>
            setTimeout(function() {
                window.location.href = '../../AdminPa/dist/pages/index2.php';
            }, 1000);
          </script>";
        } else {
            echo "<div class='alert alert-danger'>Error al registrar estudiante</div>";
        }
    }else {
        echo "<div class='alert alert-warning'>Alguno de los campos está vacio</div>";
    }
}
?>