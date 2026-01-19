<?php
session_start();
include 'includes/db.php';

// Verificar si el admin está logueado
if(!isset($_SESSION['admin'])) {
    header('Location: admin_login.php');
    exit;
}
?>

<h2>Panel de Administración</h2>
<p>Bienvenido, <?php echo $_SESSION['admin']; ?> | <a href="admin_logout.php">Cerrar sesión</a></p>

<h3>Reservas</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Nombre</th><th>Email</th><th>Teléfono</th><th>Fecha</th><th>Hora</th><th>Personas</th>
    </tr>
    <?php
    $stmt = $conn->query("SELECT * FROM reservas ORDER BY created_at DESC");
    while($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$res['id']}</td>
                <td>{$res['nombre']}</td>
                <td>{$res['email']}</td>
                <td>{$res['telefono']}</td>
                <td>{$res['fecha']}</td>
                <td>{$res['hora']}</td>
                <td>{$res['personas']}</td>
              </tr>";
    }
    ?>
</table>

<h3>Comentarios / Reseñas</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Nombre</th><th>Email</th><th>Comentario</th><th>Valoración</th>
    </tr>
    <?php
    $stmt = $conn->query("SELECT * FROM comentarios ORDER BY created_at DESC");
    while($com = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$com['id']}</td>
                <td>{$com['nombre']}</td>
                <td>{$com['email']}</td>
                <td>{$com['comentario']}</td>
                <td>{$com['valoracion']}</td>
              </tr>";
    }
    ?>
</table>

<h3>Mensajes de Contacto</h3>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Nombre</th><th>Email</th><th>Mensaje</th>
    </tr>
    <?php
    $stmt = $conn->query("SELECT * FROM contacto ORDER BY created_at DESC");
    while($msg = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$msg['id']}</td>
                <td>{$msg['nombre']}</td>
                <td>{$msg['email']}</td>
                <td>{$msg['mensaje']}</td>
              </tr>";
    }
    ?>
</table>
