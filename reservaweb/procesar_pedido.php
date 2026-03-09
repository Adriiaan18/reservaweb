<?php
include 'includes/db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if(isset($data['productos']) && isset($data['total']) && isset($data['nombre']) && isset($data['email'])){
    $productos_json = json_encode($data['productos']);
    $stmt = $conn->prepare("INSERT INTO pedidos (productos, total, nombre_cliente, email_cliente) VALUES (?, ?, ?, ?)");
    $stmt->execute([$productos_json, $data['total'], $data['nombre'], $data['email']]);
    echo json_encode(['mensaje'=>'Pedido registrado con éxito']);
} else {
    echo json_encode(['mensaje'=>'Error al procesar el pedido']);
}
