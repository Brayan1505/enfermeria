<?php

if (!empty($_POST["btnEditarS"])) {
    if (!empty($_POST["insumo"]) and !empty($_POST["socialesh"]) ) {
        $id=$_POST["id"];
        $insumo=$_POST["insumo"];
        $socialesh=$_POST["socialesh"];
        $sql=$conexion->query("UPDATE horas SET insumo='$insumo', socialesh='$socialesh' WHERE id=$id");
        if ($sql==1) {
            echo "<div class='alert alert-success'>Insumo actulizado satisfactoriamente</div>";
            echo "<script>
            setTimeout(function() {
                window.location.href = '../../AdminPa/dist/pages/index3.php';
            }, 1000);
          </script>";
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar datos</div>";
        }
        
    }else{
        echo "<div class='alert alert-warning'>Alguno de los campos está vacio</div>";
    }
}


?>