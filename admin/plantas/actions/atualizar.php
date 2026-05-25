<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ .  '/../../auth.php';
require_once __DIR__ . '/../../../db/conexao.php';
require_once __DIR__ . '/../../includes/log.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];

    $sql = "UPDATE plantas SET
        nome_cientifico=?, nome_popular=?, filo=?, classe=?, ordem=?, familia=?, genero=?,
        origem=?, luz_ideal=?, frequencia_rega=?, tipo_solo=?, temperatura_ideal=?,
        umidade_ar=?, dificuldade=?, tamanho_altura=?, crescimento=?, floracao=?,
        toxico_humanos=?, toxico_pets=?
        WHERE id=?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssssssssssssssssssi",
        $_POST['nome_cientifico'],
        $_POST['nome_popular'],
        $_POST['filo'],
        $_POST['classe'],
        $_POST['ordem'],
        $_POST['familia'],
        $_POST['genero'],
        $_POST['origem'],
        $_POST['luz_ideal'],
        $_POST['frequencia_rega'],
        $_POST['tipo_solo'],
        $_POST['temperatura_ideal'],
        $_POST['umidade_ar'],
        $_POST['dificuldade'],
        $_POST['tamanho_altura'],
        $_POST['crescimento'],
        $_POST['floracao'],
        $_POST['toxico_humanos'],
        $_POST['toxico_pets'],
        $id
    );
    registrarLog("ATUALIZAR", "PLANTAS", $id, "PLANTA " . $_POST['nome_cientifico'] . "/" . $_POST['nome_popular' . "Atualizada com sucesso."]);
    $stmt->execute();


    /* SUBTITULOS E TEXTOS */
    if (isset($_POST['subtitulos'])) {

        foreach ($_POST['subtitulos'] as $sub) {

            $stmtSub = $conn->prepare("UPDATE subtitulos SET titulo=? WHERE id=?");
            $stmtSub->bind_param("si", $sub['titulo'], $sub['id']);
            registrarLog("ATUALIZAR", "SUBTITULOS", $sub['id'], "Subtitulo " . $sub['titulo'] . " ATUALIZADO COM SUCESSO.");
            $stmtSub->execute();

            if (isset($sub['textos'])) {
                foreach ($sub['textos'] as $txt) {

                    $stmtTxt = $conn->prepare("UPDATE textos SET conteudo=? WHERE id=?");
                    $stmtTxt->bind_param("sii", $txt['conteudo'], $txt['id']);
                    registrarLog("ATUALIZAR", "TEXTOS", $txt['id'], "Texto Atualizado com sucesso.");
                    $stmtTxt->execute();
                }
            }
        }
    }

    header("Location: " . BASE_URL_PAGES . "listar.php?editado=1");
    exit();
}
