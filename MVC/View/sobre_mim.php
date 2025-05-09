<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\Projeto-de-Vida---Roberto\config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    die("Erro: Usuário não autenticado.");
}

$user_id = $_SESSION['usuario_id'];

// Se o formulário for enviado, atualiza o campo 'sobre_mim' na tabela 'users'
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sobre_mim = $_POST['sobre_mim'] ?? '';

    $sql = "UPDATE users SET sobre_mim = :sobre_mim WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':sobre_mim', $sobre_mim);
    $stmt->bindParam(':user_id', $user_id);

    if ($stmt->execute()) {
        header("Location: perfil.php"); // Redireciona para o perfil
        exit;
    } else {
        $erro = "Erro ao atualizar o campo 'Sobre Mim'.";
    }
}

// Buscar o campo 'sobre_mim' da tabela 'users'
$sql = "SELECT sobre_mim FROM users WHERE id = :user_id LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
$sobre_mim_atual = $usuario ? $usuario['sobre_mim'] : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<link rel="stylesheet" href="../View/css/sobre_mim.css">
<head>
    <meta charset="UTF-8">
    <title>Editar Sobre Mim</title>
</head>
<body>

<h2>Sobre Mim</h2>

<?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>

<form method="POST">
    <label for="sobre_mim">Escreva algo sobre você:</label><br>
    <textarea name="sobre_mim" id="sobre_mim" rows="5" cols="50" maxlength="500"  required><?= htmlspecialchars($sobre_mim_atual) ?></textarea><br><br>
    <button type="submit">Salvar</button>
</form>


</body>
</html>
