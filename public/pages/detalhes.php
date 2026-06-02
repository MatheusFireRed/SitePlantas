<?php
include '../../config.php';
require_once '../../db/conexao.php';

/* RECEBE O ID DA PLANTA DA PÁGINA INDEX VIA GET */
if (!isset($_GET['id'])) {
    die("Item não encontrado");
}

$id = intval($_GET['id']);

/* SQL PARA PESQUISAR PLANTA */
$sql = "SELECT id, nome_cientifico, nome_popular, filo, classe, ordem, familia, genero, origem, luz_ideal, frequencia_rega, tipo_solo, temperatura_ideal, umidade_ar, dificuldade, tamanho_altura, crescimento, floracao, toxico_humanos, toxico_pets  
        FROM plantas
        WHERE id = $id";

$resultado = mysqli_query($conn, $sql);

$item = mysqli_fetch_assoc($resultado);

if (!$item) {
    die("Planta não encontrada");
}

/* SQL PARA SELECIONAR SUBTITULOS*/

$sql = "SELECT id, planta_id, titulo, ordem FROM subtitulos WHERE planta_id = $id";

$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $item['nome_cientifico'] . " / " . $item['nome_popular']; ?></title>

    <!-- FOLHA DE ESTILO CSS GLOBAL PUBLIC -->
    <link rel="stylesheet" href=" <?php echo BASE_URL_CSS_PUBLIC . 'global.css' ?>">

    <!-- FOLHA DE ESTILO CSS MENU -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_PUBLIC . 'menu-public.css'?>">

    <!-- FOLHA DE ESTILO CSS PÁGINA -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_PUBLIC . "detalhes.css" ?>">

</head>

<body class="display-flex">

    <?php include '../includes/menu-public.php'; ?>

    <main>
        <h1 id="nome_planta">
            <?php echo $item['nome_cientifico'] . " / " . $item['nome_popular']; ?>
        </h1>

        <p>
            ID da planta:
            <?php echo $item['id']; ?>
        </p>

        <div class="linha display-flex">
            <div class="coluna">
                <table>
                    <tr>
                        <th>
                            Nome Cientifico:
                        </th>
                        <td>
                            <?php echo $item['nome_cientifico'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Nome Popular:
                        </th>
                        <td>
                            <?php echo $item['nome_popular'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Filo:
                        </th>
                        <td>
                            <?php echo $item['filo'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Classe:
                        </th>
                        <td>
                            <?php echo $item['classe'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Ordem:
                        </th>
                        <td>
                            <?php echo $item['ordem'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Familia:
                        </th>
                        <td>
                            <?php echo $item['familia'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Gênero:
                        </th>
                        <td>
                            <?php echo $item['genero'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Origem:
                        </th>
                        <td>
                            <?php echo $item['origem'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Luminosidade Ideal:
                        </th>
                        <td>
                            <?php echo $item['luz_ideal'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Frequência de Rega:
                        </th>
                        <td>
                            <?php echo $item['frequencia_rega'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Tipo de Solo:
                        </th>
                        <td>
                            <?php echo $item['tipo_solo'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Temperatura Ideal:
                        </th>
                        <td>
                            <?php echo $item['temperatura_ideal'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Umidade do Ar:
                        </th>
                        <td>
                            <?php echo $item['umidade_ar'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Dificuldade:
                        </th>
                        <td>
                            <?php echo $item['dificuldade'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Floração:
                        </th>
                        <td>
                            <?php echo $item['floracao'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Tóxico para Humanos:
                        </th>
                        <td>
                            <?php echo $item['toxico_humanos'] ?>
                        </td>
                    </tr>

                    <tr>
                        <th>
                            Tóxico para Pets:
                        </th>
                        <td>
                            <?php echo $item['toxico_pets'] ?>
                        </td>
                    </tr>


                </table>

            </div>

            <div class="coluna">
                <!-- NÃO ESTÁ FUNCIONANDO A IMAGEM  -->
                <img src="<?php echo BASE_URL_IMAGES_PLANTAS . "img-teste.png" ?>" alt="" width="200px">
            </div>
        </div>

        <?php
        while ($subtitulo = mysqli_fetch_assoc($resultado)):
        ?>

            <h2><?php echo $subtitulo['titulo']; ?></h2>

            <?php
            $subtitulo_id = $subtitulo['id'];

            $sqlTexto = "SELECT conteudo FROM textos WHERE subtitulo_id = $subtitulo_id ORDER BY ordem";

            $resultadoTexto = mysqli_query($conn, $sqlTexto);

            while ($texto = mysqli_fetch_assoc($resultadoTexto)):
            ?>

                <p>
                    <?php echo $texto['conteudo'] ?>
                </p>
            <?php endwhile; ?>
        <?php endwhile; ?>
    </main>

    <script src="<?php echo BASE_URL_JS_PUBLIC . "menu-lateral.js" ?>"></script>

</body>

</html>