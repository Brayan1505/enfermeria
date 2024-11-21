<?php
function actualizarPerfil($conexion, $id, $nombre, $foto = null) {
    if ($foto) {
        $query = "UPDATE usuarios SET nombre='$nombre', foto='$foto' WHERE id='$id'";
    } else {
        $query = "UPDATE usuarios SET nombre='$nombre' WHERE id='$id'";
    }
    return $conexion->query($query);
}
