<?php
require_once __DIR__ . '/../../db/conexao.php';

function registrarLog($acao, $tabela, $registro_id, $descricao = null) {

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    } 

    $usuario = $_SESSION['usuario_logado'] ?? 'desconhecido';
    $id_usuario = $_SESSION['id_usuario'] ?? 'desconhecido';

    global $conn;

    $sql = "INSERT INTO logs (usuario_id, usuario_nome, acao, tabela_afetada, registro_id, descricao)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssis", $id_usuario, $usuario, $acao, $tabela, $registro_id, $descricao);

    $stmt->execute();
}