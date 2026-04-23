<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ .  '/../../auth.php';
require_once __DIR__ . '/../../../db/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];

    $nome_cientifico = $_POST['nome_cientifico'];
    $nome_popular = $_POST['nome_popular'];
    $filo = $_POST['filo'];
    $classe = $_POST['classe'];
    $ordem = $_POST['ordem'];
    $familia = $_POST['familia'];
    $genero = $_POST['genero'];
    $origem = $_POST['origem'];
    $luz_ideal = $_POST['luz_ideal'];
    $frequencia_rega = $_POST['frequencia_rega'];
    $tipo_solo = $_POST['tipo_solo'];
    $temperatura_ideal = $_POST['temperatura_ideal'];
    $umidade_ar = $_POST['umidade_ar'];
    $dificuldade = $_POST['dificuldade'];
    $tamanho_altura = $_POST['tamanho_altura'];
    $crescimento = $_POST['crescimento'];
    $floracao = $_POST['floracao'];
    $toxico_humanos = $_POST['toxico_humanos'];
    $toxico_pets = $_POST['toxico_pets'];

    $sql = "UPDATE plantas SET
        nome_cientifico = ?, nome_popular = ?, filo = ?, classe = ?, ordem = ?, familia = ?, genero = ?,
        origem = ?, luz_ideal = ?, frequencia_rega = ?, tipo_solo = ?, temperatura_ideal = ?,
        umidade_ar = ?, dificuldade = ?, tamanho_altura = ?, crescimento = ?, floracao = ?, toxico_humanos = ?, toxico_pets = ?
        WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssssssssssssssssssi",
        $nome_cientifico,
        $nome_popular,
        $filo,
        $classe,
        $ordem,
        $familia,
        $genero,
        $origem,
        $luz_ideal,
        $frequencia_rega,
        $tipo_solo,
        $temperatura_ideal,
        $umidade_ar,
        $dificuldade,
        $tamanho_altura,
        $crescimento,
        $floracao,
        $toxico_humanos,
        $toxico_pets,
        $id
    );

    if ($stmt->execute()) {
        header("Location: " . BASE_URL_PAGES ."listar.php?editado=1");
        exit();
    } else {
        echo "Erro ao atualizar!";
    }
}