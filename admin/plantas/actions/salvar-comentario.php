<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../db/conexao.php';
require_once __DIR__ . '/../../auth.php';
require_once __DIR__ . '/../../includes/log.php';
require_once __DIR__ . '/../../includes/busca-log.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . BASE_URL_PAGES . "listar.php");
    exit();
}

$planta_id = intval($_POST['planta_id']);

/* BUSCAR INFO DA PLANTA (LOG) */
$planta = buscarInformacaoPlanta($planta_id, $conn);

/* DIRETÓRIO DE UPLOAD */
$uploadDir = __DIR__ . '/../../../images/artigos/';

/* CRIA PASTA SE NÃO EXISTIR */
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

/* =========================
   LOOP DE SUBTÍTULOS
========================= */
foreach ($_POST['subtitulos'] as $i => $subtitulo) {

    $titulo = $subtitulo['titulo'] ?? '';
    $ordemSub = intval($subtitulo['ordem'] ?? 0);

    /* INSERT SUBTÍTULO */
    $stmt = $conn->prepare("
        INSERT INTO subtitulos (planta_id, titulo, ordem)
        VALUES (?, ?, ?)
    ");
    $stmt->bind_param("isi", $planta_id, $titulo, $ordemSub);
    $stmt->execute();

    $subtitulo_id = $stmt->insert_id;

    registrarLog(
        "INCLUIR",
        "SUBTITULOS",
        $planta_id,
        "SUBTITULO '{$titulo}' ADICIONADO NA PLANTA {$planta['nome_cientifico']}/{$planta['nome_popular']}"
    );

    /* =========================
       TEXTOS
    ========================= */
    if (!empty($subtitulo['textos'])) {

        foreach ($subtitulo['textos'] as $texto) {

            $conteudo = $texto['conteudo'] ?? '';
            $ordemTexto = intval($texto['ordem'] ?? 0);

            $stmt = $conn->prepare("
                INSERT INTO textos (subtitulo_id, conteudo, ordem)
                VALUES (?, ?, ?)
            ");
            $stmt->bind_param("isi", $subtitulo_id, $conteudo, $ordemTexto);
            $stmt->execute();

            registrarLog(
                "INCLUIR",
                "TEXTOS",
                $planta_id,
                "TEXTO ADICIONADO NA PLANTA {$planta['nome_cientifico']}/{$planta['nome_popular']}"
            );
        }
    }

    /* =========================
       IMAGENS
    ========================= */
    if (isset($_FILES['subtitulos']['name'][$i]['imagens'])) {

        foreach ($_FILES['subtitulos']['name'][$i]['imagens'] as $key => $imgData) {

            $nomeArquivo = $imgData['arquivo'] ?? '';

            if (!empty($nomeArquivo)) {

                $tmp = $_FILES['subtitulos']['tmp_name'][$i]['imagens'][$key]['arquivo'];

                $ordemImg = intval($_POST['subtitulos'][$i]['imagens'][$key]['ordem'] ?? 0);

                /* GERAR NOME ÚNICO */
                $novoNome = uniqid() . "_" . basename($nomeArquivo);

                $caminhoCompleto = $uploadDir . $novoNome;

                if (move_uploaded_file($tmp, $caminhoCompleto)) {

                    $stmt = $conn->prepare("
                        INSERT INTO imagens (subtitulo_id, caminho, ordem)
                        VALUES (?, ?, ?)
                    ");
                    $stmt->bind_param("isi", $subtitulo_id, $novoNome, $ordemImg);
                    $stmt->execute();

                    registrarLog(
                        "INCLUIR",
                        "IMAGENS",
                        $planta_id,
                        "IMAGEM ADICIONADA NA PLANTA {$planta['nome_cientifico']}/{$planta['nome_popular']}"
                    );
                }
            }
        }
    }
}

/* REDIRECIONAMENTO FINAL */
header("Location: " . BASE_URL_INCLUDES . "sucesso-adc-txt.html");
exit();