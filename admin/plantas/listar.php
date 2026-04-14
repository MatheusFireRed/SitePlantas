<?php
require_once __DIR__ . '/../../config.php';
require_once '../auth.php';
require_once '../../db/conexao.php';

$sql = "SELECT * FROM plantas ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Plantas Cadastradas</title>

    <!-- RESET -->
    <link rel="stylesheet" href="<?php echo  BASE_URL; ?>css/reset.css">

    <!-- ESTILO MENU -->
    <link rel="stylesheet" href="<?php echo  BASE_URL_CSS_ADMIN; ?>menu-admin.css">


    <!-- ESTILO PÁGINA -->
    <link rel="stylesheet" href="<?php echo  BASE_URL_CSS_ADMIN; ?>listar-plantas.css">

</head>

<body>
    <?php
    include '../includes/menu-admin.php';
    ?>

    <main>
        <input type="text" id="busca" placeholder="Buscar planta...">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome Popular</th>
                    <th>Nome Científico</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="resultado">

                <?php if ($resultado->num_rows > 0): ?>

                    <?php while ($planta = $resultado->fetch_assoc()): ?>

                        <tr>
                            <td><?php echo htmlspecialchars($planta['id']); ?></td>
                            <td><?php echo htmlspecialchars($planta['nome_popular']); ?></td>
                            <td><?php echo htmlspecialchars($planta['nome_cientifico']); ?></td>

                            <td>
                                <a href="editar.php?id=<?php echo $planta['id']; ?>">Editar</a>
                                |
                                <a href="excluir.php?id=<?php echo $planta['id']?>;" onclick="return confirm('Tem certeza que deseja excluir ?')">Excluir</a>
                                |
                                <a href="#">Escrever</a>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="6">Nenhuma planta cadastrada.</td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
    </main>

    <!-- SCRIPT DE BUSCA EM TEMPO REAL -->
    <script>
        document.getElementById("busca").addEventListener("keyup", function() {

            let termo = this.value;

            fetch("buscar.php?termo=" + termo)
                .then(response => response.text())
                .then(data => {
                    document.getElementById("resultado").innerHTML = data;
                });

        });
    </script>
</body>

</html>