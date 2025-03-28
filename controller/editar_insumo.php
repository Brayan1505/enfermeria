<?php

if (!empty($_POST["btnEditarH"])) {
    if (!empty($_POST["insumo"]) and !empty($_POST["cantidad"]) and !empty($_POST["unidad"]) ) {
        $id=$_POST["id"];
        $insumo=$_POST["insumo"];
        $cantidad=$_POST["cantidad"];
        $unidad=$_POST["unidad"];
        $sql=$conexion->query("UPDATE insumos SET insumo='$insumo', cantidad='$cantidad', unidad='$unidad' WHERE id=$id");
        if ($sql==1) {
            echo "<div class='alert alert-success'>Insumo actualizado satisfactoriamente</div>";
            echo "<script>
            setTimeout(function() {
                window.location.href = '../../AdminPa/dist/pages/index4.php';
            }, 1000);
          </script>";
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar datos del insumo</div>";
        }
        
    }else{
        echo "<div class='alert alert-warning'>Alguno de los campos está vacio</div>";
    }
}


?>