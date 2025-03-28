<?php
include "../../model/conexion.php";


if (!empty($_POST["btnregistrarH"])) {
    if (!empty($_POST["insumo"]) && !empty($_POST["apellidos"]) && !empty($_POST["horas"])) {

        $nombres=$_POST["insumo"];
        $horas=$_POST["horas"];

        $sql = $conexion->query("INSERT INTO horas (insumo, horas) 
        VALUES ('$insumo', '$horas')");

        if ($sql == 1) {
            echo "<div class='alert alert-success'>Insumo y horas sociales Registrado satisfactoriamente</div>";
            echo "<script>
            setTimeout(function() {
                window.location.href = '../../AdminPa/dist/pages/index3.php';
            }, 1000);
          </script>";
        } else {
            echo "<div class='alert alert-danger'>Error al registrar insumo y horas sociales</div>";
        }
    }else {
        echo "<div class='alert alert-warning'>Alguno de los campos está vacio</div>";
    }
}
?>