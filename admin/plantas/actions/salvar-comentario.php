<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../db/conexao.php';
require_once __DIR__ . '/../../auth.php';
require_once __DIR__ . '/../../includes/log.php';
require_once __DIR__ . '/../../includes/busca-log.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: listar.php");
    exit();
}

$planta_id = intval($_POST['planta_id']);

/* BUSCA AS INFORMAÇÕES DA PLANTA PARA INSERIR NO LOG*/
$planta = buscarInformacaoPlanta($planta_id, $conn);

$uploadDir = "../../images/";

foreach ($_POST['subtitulos'] as $i => $subtitulo) {

    //SALVAR SUBTÍTULO
    $titulo = $subtitulo['titulo'];

    $stmt = $conn->prepare("INSERT INTO subtitulos (planta_id, titulo) VALUES (?, ?)");
    $stmt->bind_param("is", $planta_id, $titulo);
    $stmt->execute();

    registrarLog("INCLUIR", "SUBTITULOS", $planta_id, "O SUBTITULO -" . $titulo . " - FOI ADICIONADO A PLANTA " . $planta['nome_cientifico'] . "/" . $planta['nome_popular']);

    $subtitulo_id = $stmt->insert_id;

    //SALVAR TEXTOS
    if (!empty($subtitulo['textos'])) {

        foreach ($subtitulo['textos'] as $texto) {

            $stmt = $conn->prepare("INSERT INTO textos (subtitulo_id, conteudo) VALUES (?, ?)");
            $stmt->bind_param("is", $subtitulo_id, $texto);
            $stmt->execute();

            registrarLog("INCLUIR", "TEXTOS", $planta['id'], "TEXTO ADICIONADO A PLANTA" . $planta['nome_cientifico'] . "/" . $planta['nome_popular']);
        }
    }

    //SALVAR IMAGENS
    if (isset($_FILES['subtitulos']['name'][$i]['imagens'])) {

        foreach ($_FILES['subtitulos']['name'][$i]['imagens'] as $key => $nomeArquivo) {

            if (!empty($nomeArquivo)) {

                $tmp = $_FILES['subtitulos']['tmp_name'][$i]['imagens'][$key];

                // gerar nome único
                $novoNome = uniqid() . "_" . basename($nomeArquivo);

                $caminhoCompleto = $uploadDir . $novoNome;

                if (move_uploaded_file($tmp, $caminhoCompleto)) {

                    // salvar no banco
                    $stmt = $conn->prepare("INSERT INTO imagens (subtitulo_id, caminho) VALUES (?, ?)");
                    $stmt->bind_param("is", $subtitulo_id, $novoNome);
                    $stmt->execute();
                }
            }
        }

        registrarLog("INCLUIR", "IMAGENS", $planta['id'], "FOI VINCULADA A IMAGEM A PLANTA " . $planta['nome_cientifico'] . "/" . $planta['nome_popular']);
    }
}

header("Location: " . BASE_URL_INCLUDES . "sucesso-adc-txt.html");
exit();
