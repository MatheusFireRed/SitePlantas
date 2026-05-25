<?php
include 'config.php';
require_once 'db/conexao.php';

$sql = "SELECT id, nome_cientifico 
        FROM plantas
        ORDER BY id DESC
        LIMIT 4";

$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plante-se - </title>

    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_PUBLIC . 'menu-public.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_PUBLIC . 'index.css' ?>">
</head>
<?php

include 'public/includes/menu-public.php';
?>

<body>

    <main>
        <h1 class="linha">Bem-vindo!</h1>

        <div class="linha">
            <?php while ($item = mysqli_fetch_assoc($resultado)): ?>
                <a href="<?php echo BASE_URL_PUBLIC_PAGES ?>detalhes.php?id=<?php echo $item['id']; ?>">

                    <?php echo $item['nome_cientifico']; ?>

                </a>

                <br><br>

            <?php endwhile; ?>
        </div>

    </main>

    <script src="<?php echo BASE_URL_JS_PUBLIC . 'menu-lateral.js' ?>"></script>
</body>

</html>