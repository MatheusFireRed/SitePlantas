<?php

require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../auth.php';
require_once __DIR__ . '/../../../db/conexao.php';

if (!isset($_GET['id'])) {
    echo "ID não informado!";
    exit();
}

$id = intval($_GET['id']);

/* BUSCAR PLANTA */
$sql = "SELECT * FROM plantas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$planta = $stmt->get_result()->fetch_assoc();

if (!$planta) {
    echo "Planta não encontrada!";
    exit();
}

/* BUSCAR SUBTITULOS + TEXTOS */
$subtitulos = [];

$sqlSub = "SELECT * FROM subtitulos WHERE planta_id = ?";
$stmtSub = $conn->prepare($sqlSub);
$stmtSub->bind_param("i", $id);
$stmtSub->execute();
$resultSub = $stmtSub->get_result();

while ($sub = $resultSub->fetch_assoc()) {

    $sqlTxt = "SELECT * FROM textos WHERE subtitulo_id = ?";
    $stmtTxt = $conn->prepare($sqlTxt);
    $stmtTxt->bind_param("i", $sub['id']);
    $stmtTxt->execute();
    $resultTxt = $stmtTxt->get_result();

    $textos = [];

    /*     print_r($textos);
 */
    while ($txt = $resultTxt->fetch_assoc()) {
        $textos[] = $txt;
    }

    $sub['textos'] = $textos;
    print_r($sub);
    $subtitulos[] = $sub;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Planta</title>

    <!-- FOLHA DE ESTILO GLOBAL -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_ADMIN; ?>global.css">

    <!-- ESTILO DA PÁGINA -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_ADMIN; ?>editar-plantas.css">
</head>

<body>

    <?php include "../../includes/menu-admin.php"; ?>

    <main>
        <form action="<?php echo BASE_URL_ACTIONS; ?>atualizar.php" method="POST">

            <div class="linha">

                <input type="hidden" name="id" value="<?= $planta['id']; ?>">

                <div class="coluna">
                    <div class="label-input">
                        <label>Nome Científico:</label>
                        <input type="text" name="nome_cientifico" value="<?= htmlspecialchars($planta['nome_cientifico']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Nome Popular:</label>
                        <input type="text" name="nome_popular" value="<?= htmlspecialchars($planta['nome_popular']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Filo:</label>
                        <input type="text" name="filo" value="<?= htmlspecialchars($planta['filo']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Classe:</label>
                        <input type="text" name="classe" value="<?= htmlspecialchars($planta['classe']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Ordem:</label>
                        <input type="text" name="ordem" value="<?= htmlspecialchars($planta['ordem']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Família:</label>
                        <input type="text" name="familia" value="<?= htmlspecialchars($planta['familia']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Gênero:</label>
                        <input type="text" name="genero" value="<?= htmlspecialchars($planta['genero']); ?>">
                    </div>
                </div>

                <div class="coluna">
                    <div class="label-input">
                        <label>Origem:</label>
                        <input type="text" name="origem" value="<?= htmlspecialchars($planta['origem']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Luz ideal:</label>
                        <input type="text" name="luz_ideal" value="<?= htmlspecialchars($planta['luz_ideal']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Frequência de Rega:</label>
                        <input type="text" name="frequencia_rega" value="<?= htmlspecialchars($planta['frequencia_rega']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Tipo de Solo:</label>
                        <input type="text" name="tipo_solo" value="<?= htmlspecialchars($planta['tipo_solo']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Temperatura Ideal:</label>
                        <input type="text" name="temperatura_ideal" value="<?= htmlspecialchars($planta['temperatura_ideal']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Umidade do Ar:</label>
                        <input type="text" name="umidade_ar" value="<?= htmlspecialchars($planta['umidade_ar']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Dificuldade:</label>
                        <input type="text" name="dificuldade" value="<?= htmlspecialchars($planta['dificuldade']); ?>">
                    </div>
                </div>

                <div class="coluna">
                    <div class="label-input">
                        <label>Altura:</label>
                        <input type="text" name="tamanho_altura" value="<?= htmlspecialchars($planta['tamanho_altura']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Crescimento:</label>
                        <input type="text" name="crescimento" value="<?= htmlspecialchars($planta['crescimento']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Floração:</label>
                        <input type="text" name="floracao" value="<?= htmlspecialchars($planta['floracao']); ?>">
                    </div>

                    <div class="label-input">
                        <label>Tóxico Humanos:</label>
                        <select name="toxico_humanos">
                            <option value="SIM" <?= $planta['toxico_humanos'] == 'SIM' ? 'selected' : '' ?>>Sim</option>
                            <option value="NAO" <?= $planta['toxico_humanos'] == 'NAO' ? 'selected' : '' ?>>Não</option>
                        </select>
                    </div>

                    <div class="label-input">
                        <label>Tóxico Pets:</label>
                        <select name="toxico_pets">
                            <option value="SIM" <?= $planta['toxico_pets'] == 'SIM' ? 'selected' : '' ?>>Sim</option>
                            <option value="NAO" <?= $planta['toxico_pets'] == 'NAO' ? 'selected' : '' ?>>Não</option>
                        </select>
                    </div>
                </div>

            </div>

            <!-- SUBTITULOS -->

            <div class="linha">
                <h1>Subtítulos e Textos</h1>
            </div>

            <?php foreach ($subtitulos as $i => $sub): ?>

                <div class="linha">
                    <div class="bloco-sub">
                        <input type="hidden" name="subtitulos[<?= $i ?>][id]" value="<?= $sub['id'] ?>">

                        <div class="box-input-btns">
                            <input type="text" name="subtitulos[<?= $i ?>][titulo]" value="<?= $sub['titulo'] ?>">

                            <div class="btns">
                                <button>Excluir</button>
                            </div>
                        </div>

                        <?php foreach ($sub['textos'] as $j => $texto): ?>

                            <input type="hidden" name="subtitulos[<?= $i ?>][textos][<?= $j ?>][id]" value="<?= $texto['id'] ?>">

                            <textarea name="subtitulos[<?= $i ?>][textos][<?= $j ?>][conteudo]"><?= $texto['conteudo'] ?></textarea>

                        <?php endforeach; ?>

                    </div>
                </div>

            <?php endforeach; ?>

            <div class="linha linha-btn">
                <input class="btn-cadastrar" type="submit" value="Atualizar Planta">
            </div>

        </form>

    </main>

</body>

</html>