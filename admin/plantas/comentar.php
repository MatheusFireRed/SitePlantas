<?php
require_once '../../config.php';
require_once '../../db/conexao.php';
require_once '../auth.php';

/* Selecionando nome da planta para mostrar na página */
$sql = "SELECT nome_popular FROM plantas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $planta_id);
$stmt->execute();

$resultado = $stmt->get_result();
$planta = $resultado->fetch_assoc();

if (!isset($_GET['id'])) {
    echo "ID da planta não informado!";
    exit();
}

$planta_id = intval($_GET['id']);


$sql = "SELECT nome_popular FROM plantas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $planta_id);
$stmt->execute();

$resultado = $stmt->get_result();
$planta = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentar planta</title>

    <!-- RESET -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/reset.css">

    <!-- ESTILO MENU -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_ADMIN; ?>menu-admin.css">

    <!-- ESTILO DA PÁGINA -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_ADMIN; ?>comentar.css">


</head>

<body>
    <?php include '../includes/menu-admin.php' ?>
    <main>
        <h2>Adicionando conteúdo para:
            <?php echo htmlspecialchars($planta['nome_popular']); ?>
        </h2>
        <form action="salvar-comentario.php" method="POST">

            <!-- ID da planta (oculto) -->
            <input type="hidden" name="planta_id" value="<?php echo $planta_id; ?>">

            <!-- Conteúdo dinâmico -->
            <div id="conteudo"></div>

            <button type="button" onclick="adicionarSubtitulo()">
                + Adicionar Subtítulo
            </button>

            <br><br>

            <button type="submit">Salvar Conteúdo</button>

        </form>

    </main>

    <script src="<?php echo BASE_URL; ?>js/admin/comentarios.js"></script>
</body>

</html>