<?php
require_once __DIR__ . '/../../config.php';
require_once '../auth.php';
require_once '../../db/conexao.php';

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- RESET -->
    <link rel="stylesheet" href="<?php echo  BASE_URL; ?>css/reset.css">

    <!-- ESTILO MENU -->
    <link rel="stylesheet" href="<?php echo  BASE_URL_CSS_ADMIN; ?>menu-admin.css">

    <!-- ESTILO PÁGINA -->
    <link rel="stylesheet" href="<?php echo  BASE_URL_CSS_ADMIN; ?>cadastro-plantas.css">
</head>

<body>
    <?php
    include '../includes/menu-admin.php';
    ?>

    <main>
        <form action="salvar.php" method="POST">

            <div class="linha">

                <div class="coluna">
                    <div class="label-input">
                        <label for="nome_cientifico">Nome Ciêntifico:</label>
                        <input type="text" id="nome_cientifico" name="nome_cientifico">
                    </div>

                    <div class="label-input">
                        <label for="nome_popular">Nome Popular:</label>
                        <input type="text" id="nome_popular" name="nome_popular">
                    </div>

                    <div class="label-input">
                        <label for="filo">Filo:</label>
                        <input type="text" id="filo" name="filo">
                    </div>

                    <div class="label-input">
                        <label for="classe">Classe:</label>
                        <input type="text" id="classe" name="classe">
                    </div>

                    <div class="label-input">
                        <label for="ordem">Ordem:</label>
                        <input type="text" id="ordem" name="ordem">
                    </div>

                    <div class="label-input">
                        <label for="familia">Família:</label>
                        <input type="text" id="familia" name="familia">
                    </div>

                    <div class="label-input">
                        <label for="genero">Gênero:</label>
                        <input type="text" id="genero" name="genero">
                    </div>
                </div>

                <div class="coluna">
                    <div class="label-input">
                        <label for="origem">Origem:</label>
                        <input type="text" id="origem" name="origem">
                    </div>

                    <div class="label-input">
                        <label for="luz_ideal">Luz ideal:</label>
                        <input type="text" id="luz_ideal" name="luz_ideal">
                    </div>

                    <div class="label-input">
                        <label for="frequencia_rega">Frequência de Rega:</label>
                        <input type="text" id="frequencia_rega" name="frequencia_rega">
                    </div>

                    <div class="label-input">
                        <label for="tipo_solo">Tipo de Solo:</label>
                        <input type="text" id="tipo_solo" name="tipo_solo">
                    </div>

                    <div class="label-input">
                        <label for="temperatura_ideal">Temperatura Ideal:</label>
                        <input type="text" id="temperatura_ideal" name="temperatura_ideal">
                    </div>

                    <div class="label-input">
                        <label for="umidade_ar">Umidade do Ar:</label>
                        <input type="text" id="umidade_ar" name="umidade_ar">
                    </div>

                    <div class="label-input">
                        <label for="dificuldade">Dificuldade:</label>
                        <input type="text" id="dificuldade" name="dificuldade">
                    </div>
                </div>

                <div class="coluna">
                    <div class="label-input">
                        <label for="tamanho_altura">Altura da Planta:</label>
                        <input type="text" id="tamanho_altura" name="tamanho_altura">
                    </div>

                    <div class="label-input">
                        <label for="crescimento">Crescimento:</label>
                        <input type="text" id="crescimento" name="crescimento">
                    </div>

                    <div class="label-input">
                        <label for="floracao">Floração:</label>
                        <input type="text" id="floracao" name="floracao">
                    </div>

                    <div class="label-input">
                        <label for="toxico_humanos">Tóxico para Humanos:</label>
                        <select name="toxico_humanos" id="toxico_humanos">
                            <option value="SIM">Sim</option>
                            <option value="NAO">Não</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="linha linha-btn">
                <input class="btn-cadastrar" type="submit" value="Cadastrar Planta">
            </div>
        </form>
    </main>

</body>

</html>