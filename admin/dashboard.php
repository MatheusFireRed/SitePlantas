<?php
require_once 'auth.php';
include '../config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- FOLHA DE ESTILO GLOBAL -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_ADMIN; ?>global.css">

    <!-- FOLHA DE ESTILO DA PÁGINA -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_ADMIN; ?>dashboard.css">

</head>

<body>

    <?php
    include 'includes/menu-admin.php';
    ?>


    <main>
    </main>
</body>

</html>