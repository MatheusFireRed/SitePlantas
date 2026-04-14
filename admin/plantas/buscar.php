<?php
require_once __DIR__ . '/../../db/conexao.php';

$termo = $_GET['termo'] ?? '';

$sql = "SELECT * FROM plantas 
        WHERE nome_popular LIKE ? 
        OR nome_cientifico LIKE ?
        ORDER BY id DESC";

$stmt = $conn->prepare($sql);

$busca = "%" . $termo . "%";

$stmt->bind_param("ss", $busca, $busca);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {

    while ($planta = $resultado->fetch_assoc()) {

        echo "<tr>";
        echo "<td>" . htmlspecialchars($planta['id']) . "</td>";
        echo "<td>" . htmlspecialchars($planta['nome_popular']) . "</td>";
        echo "<td>" . htmlspecialchars($planta['nome_cientifico']) . "</td>";
        echo "<td>
                <a href='editar.php?id={$planta['id']}'>Editar</a> |
                <a href='excluir.php?id={$planta['id']}' onclick='return confirm(\"Excluir?\")'>Excluir</a>
              </td>";
        echo "</tr>";
    }

} else {
    echo "<tr><td colspan='4'>Nenhuma planta encontrada</td></tr>";
}
?>