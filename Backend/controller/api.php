<?php
header('Content-Type: application/json');
include 'db.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        // Crear nueva tarea
        $input = json_decode(file_get_contents('php://input'), true);
        $title = $conn->quote($input['title']);
        $description = $conn->quote($input['description']);


        $sql = "INSERT INTO tasks (title, description) VALUES ($title, $description)";
        if ($conn->exec($sql)) {
            echo json_encode(['id' => $conn->lastInsertId(), 'title' => $input['title'], 'description' => $input['description']]);
        } else {
            echo json_encode(['error' => 'No se ha podido crear']);
        }
        break;

    case 'GET':
        // Listar todas las tareas
        $stmt = $conn->query("SELECT * FROM tasks");
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($tasks);
        break;

    case 'PUT':
        // Actualizar una tarea
        $id = intval(basename($_SERVER['REQUEST_URI']));
        $input = json_decode(file_get_contents('php://input'), true);
        $title = $conn->quote($input['title']);
        $description = $conn->quote($input['description']);
        $status = intval($input['status']);

        $sql = "UPDATE tasks SET title = $title, description = $description, status = $status WHERE id = $id";
        if ($conn->exec($sql)) {
            echo json_encode(['message' => 'Tarea actualizada exitosamente']);
        } else {
            echo json_encode(['error' => 'No se ha podido actualizar']);
        }
        break;

    case 'DELETE':
        // Eliminar una tarea
        $id = intval(basename($_SERVER['REQUEST_URI']));
        $sql = "DELETE FROM tasks WHERE id = $id";
        if ($conn->exec($sql)) {
            echo json_encode(['message' => 'Tarea eliminada exitosamente']);
        } else {
            echo json_encode(['error' => 'No se ha podido eliminar la tarea']);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['message' => 'Error, no encontrado']);
        break;
}

$conn = null; // Cerrar conexión.
?>