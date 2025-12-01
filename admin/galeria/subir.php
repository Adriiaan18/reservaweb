<?php
include '../admin_check.php';
require '../../includes/db.php';

if ($_POST) {

    $titulo = $_POST['titulo'];
    $archivo = $_FILES['imagen'];

    // Verificar que es imagen
    $permitidos = ['image/jpeg', 'image/png', 'image/webp'];

    if (!in_array($archivo['type'], $permitidos)) {
        die("Formato no permitido. Solo JPEG, PNG, WEBP.");
    }

    // Generar nombre único
    $nombreFinal = time() . "_" . basename($archivo['name']);

    // Mover archivo
    move_uploaded_file($archivo['tmp_name'], "../../uploads/galeria/" . $nombreFinal);

    // Guardar en BD
    $stmt = $pdo->prepare("INSERT INTO galeria (titulo, imagen) VALUES (?,?)");
    $stmt->execute([$titulo, $nombreFinal]);

    header("Location: listar.php");
    exit;
}
?>

<h2>Subir imagen</h2>

<form method="POST" enctype="multipart/form-data">
    <label>Título:</label>
    <input type="text" name="titulo">

    <label>Imagen:</label>
    <input type="file" name="imagen" required>

    <button>Subir</button>
</form>
