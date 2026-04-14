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

    <!-- RESET -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/reset.css">

    <!-- ESTILO DO MENU -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_ADMIN; ?>menu-admin.css">

    <!-- ESTILO DA PÁGINA -->
    <link rel="stylesheet" href="<?php echo BASE_URL_CSS_ADMIN; ?>dashboard.css">


</head>
<body>
    <header>
        <?php 
            include 'includes/menu-admin.php';
        ?>
    </header>

    <main>
    </main>
</body>
</html>