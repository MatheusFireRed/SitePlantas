<?php
    require_once '../auth.php';
    require_once __DIR__ . '/../../config.php';
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
    <link rel="stylesheet" href="<?php echo  BASE_URL_CSS_ADMIN; ?>dashboard.css">

</head>

<body>


    <?php
    include '../includes/menu-admin.php';
    ?>


</body>

</html>