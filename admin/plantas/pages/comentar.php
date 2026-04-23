<?php
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../../../db/conexao.php';
require_once __DIR__ . '/../../auth.php';

// 🔹 validar ID primeiro
if (!isset($_GET['id'])) {
    echo "ID da planta não informado!";
    exit();
}

$planta_id = intval($_GET['id']);

// 🔹 buscar planta
$sql = "SELECT nome_popular FROM plantas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $planta_id);
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
    <title>Comentar planta</title>
    
    <!-- FOLHA DE ESTILO GLOBAL -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_ADMIN; ?>global.css">

    <!-- ESTILO DA PÁGINA -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_ADMIN; ?>comentar.css">


</head>

<body>
    <?php include '../../includes/menu-admin.php' ?>
    <main>
        <h2>Adicionando conteúdo para:
            <?php echo htmlspecialchars($planta['nome_popular']); ?>
        </h2>
        <form action="<?php echo BASE_URL_ACTIONS; ?>salvar-comentario.php" method="POST" enctype="multipart/form-data">

            <!-- ID da planta (oculto) -->
            <input type="hidden" name="planta_id" value="<?php echo $planta_id; ?>">

            <!-- Conteúdo dinâmico -->
            <div id="conteudo"></div>

            <button class="adc-subtitulo" type="button" onclick="adicionarSubtitulo()">
                + Adicionar Subtítulo
            </button>

            <br><br>

            <button type="submit" id="btn-salvar">Salvar</button>

        </form>

    </main>

    <script src="<?php echo BASE_URL; ?>js/admin/comentarios.js"></script>
</body>

</html>