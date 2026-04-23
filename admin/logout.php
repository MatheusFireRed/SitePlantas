<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/includes/log.php';


session_start();

registrarLog("DESLOGAR", "USUARIOS", $_SESSION['id_usuario'], "USUARIO " . $_SESSION['usuario_logado'] . " ENCERROU A SESSAO.", );

$_SESSION = [];
session_destroy();

header("Location: " . BASE_URL . "login-admin.php");
exit();