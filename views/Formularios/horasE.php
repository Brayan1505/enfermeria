<?php
session_start();
include "../../model/conexion.php";

$id = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

// Ejecutar la consulta y verificar errores
$sql = $conexion->query("SELECT * FROM insumos WHERE id = $id");

if (!$sql) {
    die("<div class='alert alert-danger'>Error en la consulta: " . $conexion->error . "</div>");
}

$datos = $sql->fetch_object();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR INSUMOS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid d-flex justify-content-center">
        <form class="col-10 col-md-6 p-3" method="POST">
            <h3 class="text-center alert alert-secondary">EDITAR DATOS DE INSUMOS</h3>
            <input type="hidden" name="id" value="<?= $id ?>">

            <?php require_once __DIR__ . "/../../controller/editar_insumo.php"; ?>

            <?php if ($datos): ?>
                <div class="mb-3">
                    <label for="insumo" class="form-label">Insumo</label>
                    <input type="text" class="form-control" name="insumo" value="<?= htmlspecialchars($datos->insumo) ?>">
                </div>
                <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="text" class="form-control" name="cantidad" value="<?= htmlspecialchars($datos->cantidad) ?>">
            </div>
                <div class="mb-3">
                    <label for="unidad" class="form-label">Unidad de medida</label>
                    <input type="text" class="form-control" name="unidad" value="<?= htmlspecialchars($datos->unidad) ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="btnEditarH" value="ok">Actualizar datos</button>
            <?php else: ?>
                <div class="alert alert-warning">No se encontró el insumo.</div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
