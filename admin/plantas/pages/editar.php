<?php

require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../auth.php';
require_once __DIR__ . '/../../../db/conexao.php';

if (!isset($_GET['id'])) {
    echo "ID não informado!";
    exit();
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM plantas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    echo "Planta não encontrada!";
    exit();
}

$planta = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- FOLHA DE ESTILO GLOBAL -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_ADMIN; ?>global.css">


    <!-- ESTILO PÁGINA -->
    <link rel="stylesheet" href="<?php echo  BASE_URL_CSS_ADMIN; ?>editar-plantas.css">

</head>

<body>


    <?php
    include "../../includes/menu-admin.php";
    ?>

    <main>
        <form action="<?php echo BASE_URL_ACTIONS; ?>atualizar.php" method="POST">

            <div class="linha">
                <input type="hidden" name="id" value="<?php echo $planta['id']; ?>">

                <div class="coluna">
                    <div class="label-input">
                        <label for="nome_cientifico">Nome Ciêntifico:</label>
                        <input type="text" id="nome_cientifico" name="nome_cientifico" value="<?php echo htmlspecialchars($planta['nome_cientifico']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="nome_popular">Nome Popular:</label>
                        <input type="text" id="nome_popular" name="nome_popular" value="<?php echo htmlspecialchars($planta['nome_popular']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="filo">Filo:</label>
                        <input type="text" id="filo" name="filo" value="<?php echo htmlspecialchars($planta['filo']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="classe">Classe:</label>
                        <input type="text" id="classe" name="classe" value="<?php echo htmlspecialchars($planta['classe']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="ordem">Ordem:</label>
                        <input type="text" id="ordem" name="ordem" value="<?php echo htmlspecialchars($planta['ordem']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="familia">Família:</label>
                        <input type="text" id="familia" name="familia" value="<?php echo htmlspecialchars($planta['familia']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="genero">Gênero:</label>
                        <input type="text" id="genero" name="genero" value="<?php echo htmlspecialchars($planta['genero']); ?>">
                    </div>
                </div>

                <div class="coluna">
                    <div class="label-input">
                        <label for="origem">Origem:</label>
                        <input type="text" id="origem" name="origem" value="<?php echo htmlspecialchars($planta['origem']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="luz_ideal">Luz ideal:</label>
                        <input type="text" id="luz_ideal" name="luz_ideal" value="<?php echo htmlspecialchars($planta['luz_ideal']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="frequencia_rega">Frequência de Rega:</label>
                        <input type="text" id="frequencia_rega" name="frequencia_rega" value="<?php echo htmlspecialchars($planta['frequencia_rega']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="tipo_solo">Tipo de Solo:</label>
                        <input type="text" id="tipo_solo" name="tipo_solo" value="<?php echo htmlspecialchars($planta['tipo_solo']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="temperatura_ideal">Temperatura Ideal:</label>
                        <input type="text" id="temperatura_ideal" name="temperatura_ideal" value="<?php echo htmlspecialchars($planta['temperatura_ideal']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="umidade_ar">Umidade do Ar:</label>
                        <input type="text" id="umidade_ar" name="umidade_ar" value="<?php echo htmlspecialchars($planta['umidade_ar']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="dificuldade">Dificuldade:</label>
                        <input type="text" id="dificuldade" name="dificuldade" value="<?php echo htmlspecialchars($planta['dificuldade']); ?>">
                    </div>
                </div>

                <div class="coluna">
                    <div class="label-input">
                        <label for="tamanho_altura">Altura da Planta:</label>
                        <input type="text" id="tamanho_altura" name="tamanho_altura" value="<?php echo htmlspecialchars($planta['tamanho_altura']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="crescimento">Crescimento:</label>
                        <input type="text" id="crescimento" name="crescimento" value="<?php echo htmlspecialchars($planta['crescimento']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="floracao">Floração:</label>
                        <input type="text" id="floracao" name="floracao" value="<?php echo htmlspecialchars($planta['floracao']); ?>">
                    </div>

                    <div class="label-input">
                        <label for="toxico_humanos">Tóxico para Humanos:</label>
                        <select name="toxico_humanos" id="toxico_humanos">
                            <option value="">Selecionar</option>
                            <option value="SIM" <?php if ($planta['toxico_humanos'] == 'SIM') echo 'selected' ?>>Sim</option>
                            <option value="NAO" <?php if ($planta['toxico_humanos'] == 'NAO') echo 'selected' ?>>Não</option>
                        </select>
                    </div>

                    <!-- FALTA ADICIONAR A COLUNA NO BANCO DE DADOS 
                         FALTA ADICIONAR NÓ CRUD  
                    -->
                    <div class="label-input">
                        <label for="toxico_pets">Tóxico para Pets:</label>
                        <select name="toxico_pets" id="toxico_pets">
                            <option value="">Selecionar</option>
                            <option value="SIM" <?php if ($planta['toxico_pets'] == 'SIM') echo 'selected' ?>>Sim</option>
                            <option value="NAO" <?php if ($planta['toxico_pets'] == 'NAO') echo 'selected' ?>>Não</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="linha linha-btn">
                <input class="btn-cadastrar" type="submit" value="Atualizar Planta">
            </div>
        </form>
    </main>

</body>

</html>