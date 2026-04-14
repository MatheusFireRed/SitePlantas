<?php
require_once __DIR__ . '/../../config.php';
require_once '../auth.php';
require_once '../../db/conexao.php';

if (isset($_GET['id'])) {

    $id = intval($_GET['id']); // segurança básica

    $sql = "DELETE FROM plantas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: listar.php?excluido=1");
        exit();
    } else {
        echo "Erro ao excluir planta!";
    }

} else {
    echo "ID não informado!";
}