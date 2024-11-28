<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-container {
            max-width: 500px;
            margin: 50px auto;
            text-align: center;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container profile-container">
        <h2 class="mb-4">Editar Perfil</h2>

        <!-- Mensajes -->
        <?php if (isset($_GET['mensaje'])): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_GET['mensaje']); ?>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Formulario -->
        <form action="../controller/actualizar_perfil.php" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" 
                       value="<?php echo $_SESSION['nombre']; ?>" 
                       placeholder="Introduce tu nombre">
            </div>

            <!-- Foto actual -->
            <div class="mb-3">
                <label class="form-label">Foto de perfil actual:</label>
                <div>
                    <img id="foto-actual" class="profile-img" 
                        src="<?php echo isset($_SESSION['foto']) ? $_SESSION['foto'] : 'ruta/a/imagen/por-defecto.jpg'; ?>" 
                        alt="Foto de perfil">
                </div>
            </div>

            <!-- Subir nueva foto -->
            <div class="mb-3">
                <label for="foto" class="form-label">Nueva foto de perfil:</label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*" onchange="mostrarPrevisualizacion(event)">
            </div>

            <script>
                function mostrarPrevisualizacion(event) {
                    const imgElement = document.getElementById('foto-actual');
                    imgElement.src = URL.createObjectURL(event.target.files[0]);
                }
            </script>


            <!-- Previsualización -->
            <div id="preview-container" class="mb-3" style="display: none;">
                <label class="form-label">Previsualización:</label>
                <div>
                    <img id="nueva-foto-preview" class="profile-img" src="#" alt="Previsualización de la nueva foto">
                </div>
            </div>

            <!-- Botón para guardar cambios -->
            <button type="submit" name="btnGcambios" class="btn btn-primary w-100">Guardar Cambios</button>
        </form>
    </div>

    <script>
        // Previsualizar nueva imagen
        function mostrarPrevisualizacion(event) {
            const input = event.target;
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('nueva-foto-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
