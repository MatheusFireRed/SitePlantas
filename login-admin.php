<?php
    include 'config.php';
    include 'db/conexao.php';
    require_once __DIR__ . '/admin/includes/log.php';

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['username'];
    $senha = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $user = $resultado->fetch_assoc();

        if (password_verify($senha, $user['senha'])) {

            $_SESSION['usuario_logado'] = $user['username'];
            $_SESSION['id_usuario'] = $user['id'];

            registrarLog("LOGAR", "USUARIOS", $_SESSION['id_usuario'], "USUARIO " . $usuario ." INICIOU A SESSAO...", "");

            header("Location: admin/dashboard.php");
            exit();

        } else {
            echo "Senha incorreta!";
        }

    } else {
        echo "Usuário não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login para Administradores.</title>

    <!-- RESET CSS!-->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/reset.css">

    <!-- FOLHA DE ESTILO DA PÁGINA!-->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/admin/admin.css">
</head>
<body class="display-flex flex-column">
    
    <main>
        <div class="card display-flex flex-column">
            <form method="POST" action="" class="display-flex flex-column width100">
                <label for="username">Login</label>
                <input type="text" id="username" name="username">

                <label for="password">Senha</label>
                <input type="password" id="password" name="password">

                <input type="submit" id="logar" value="Entrar">
            </form>

            <!-- COLOCAR O ENDEREÇO DA PÁGINA INDEX DO SITE -->
            <a href="#">Não é administrador? Clique aqui!</a>
        </div>
    </main>
    
</body>
</html>