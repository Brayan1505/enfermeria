<?php
include "../../model/conexion.php";


if (!empty($_POST["btnregistrarS"])) {
    if (!empty($_POST["insumo"]) && !empty($_POST["socialesh"])) {

        $insumo=$_POST["insumo"];
        $socialesh=$_POST["socialesh"];

        $sql = $conexion->query("INSERT INTO horas (insumo, socialesh) 
        VALUES ('$insumo', '$socialesh')");

        if ($sql == 1) {
            echo "<div class='alert alert-success'>Estudiante Registrado satisfactoriamente</div>";
            echo "<script>
            setTimeout(function() {
                window.location.href = '../../AdminPa/dist/pages/index3.php';
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