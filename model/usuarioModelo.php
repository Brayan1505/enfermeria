<?php

function actualizarPerfil($conexion, $id, $nombre, $foto_binaria = null) {
    if ($foto_binaria) {
        $query = $conexion->prepare("UPDATE usuarios SET nombre = ?, foto = ? WHERE id = ?");
        $query->bind_param("sbi", $nombre, $foto_binaria, $id);
        $query->send_long_data(1, $foto_binaria); // Enviar datos largos
    } else {
        $query = $conexion->prepare("UPDATE usuarios SET nombre = ? WHERE id = ?");
        $query->bind_param("si", $nombre, $id);
    }
    return $query->execute();
}
