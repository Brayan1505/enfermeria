<?php
// $usuario= $_POST['usuario'];
// $contraseña = $_POST['contraseña'];

// session_start();
// $_SESSION['usuario']=$usuario;

// $conexion=mysqli_connect("localhost","root","12345","enfermeria");

// $consulta="SELECT*FROM usuarios WHERE usuario='$usuario' AND contraseña='$contraaseña'";
// $resultado=mysqli_connect($conexion,$consulta);
// $filas=mysqli_fecth_array($resultado);

// if($filas['id_cargo'==1]){
//     include_once("../AdminPa/dist/pages/index.html")
// }elseif ($filas['idcargo'==2]) {
//     header("location:../AdminPa/dist/pages/index2.html")
// }

// else{
//     include_once("../index.html")
// }
// mysqli_free_result($resultado);
// mysqli_close($conexion);


// Capturar los datos enviados por POST
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

// Iniciar la sesión
session_start();
$_SESSION['usuario'] = $usuario;

// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "12345", "enfermeria");

// Verificar si hubo un error en la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consulta SQL corregida
$consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
$resultado = mysqli_query($conexion, $consulta);

// Verificar si la consulta devolvió resultados
if ($filas = mysqli_fetch_array($resultado)) {
    if ($filas['id_cargo'] == 1) {
        include_once("../views/login.html");
    } elseif ($filas['id_cargo'] == 2) {
        header("Location: ../AdminPa/dist/pages/index2.html");
    }
} else {
    // Si las credenciales son incorrectas, redirigir al login
    header("Location: ../error.html");
}

// Liberar resultados y cerrar la conexión
mysqli_free_result($resultado);
mysqli_close($conexion);
?>






?>