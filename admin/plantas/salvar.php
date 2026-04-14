<?php
require_once '../../db/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    $sql = "INSERT INTO plantas (
        nome_cientifico, nome_popular, filo, classe, ordem, familia, genero,
        origem, luz_ideal, frequencia_rega, tipo_solo, temperatura_ideal,
        umidade_ar, dificuldade, tamanho_altura, crescimento, floracao, toxico_humanos
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssssssssssssssss",
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
        $toxico_humanos
    );

    if ($stmt->execute()) {
        echo "Planta cadastrada com sucesso!";

        header("Location:../sucesso.html");
    } else {
        echo "Erro ao cadastrar!";
    }
}

?>