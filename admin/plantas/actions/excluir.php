<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../auth.php';
require_once __DIR__ . '/../../../db/conexao.php';
require_once __DIR__ . '/../../includes/log.php';

if (isset($_GET['id'])) {

    $id = intval($_GET['id']); // segurança básica

    /* PREPARA A CONSULTA PARA PEGAR AS INFORMAÇÕES PARA O LOG*/
    $sql_inf_log = "SELECT * FROM plantas WHERE id = ?";
    $stmt = $conn->prepare($sql_inf_log);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $planta = $resultado->fetch_assoc();

    $id_planta = $planta['id'];
    $nome_popular = $planta['nome_popular'];
    $nome_cientifico = $planta['nome_cientifico'];


    /* PREPARA A CONSULTA PARA TELETAR DO BANCO DE DADOS  */
    $sql = "DELETE FROM plantas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    registrarLog("EXCLUIR", "PLANTAS", $id, "PLANTA " . $nome_cientifico . "/" . $nome_popular . " FOI EXCLUIDA DO BANCO DE DADOS.");


    if ($stmt->execute()) {

        header("Location: " . BASE_URL_PAGES . "listar.php?excluido=1");
        exit();
    } else {
        echo "Erro ao excluir planta!";
    }
} else {
    echo "ID não informado!";
}
