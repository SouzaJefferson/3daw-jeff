<?php
$arquivo = 'usuarios.txt';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    $novoId = 1;
    if (file_exists($arquivo) && filesize($arquivo) > 0) {
        $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $ultimo = explode(";", end($linhas));
        $novoId = intval($ultimo[0]) + 1;
    }

    $linha = $novoId . ";" . $nome . ";" . $email . PHP_EOL;
    file_put_contents($arquivo, $linha, FILE_APPEND);

    header("Location: usuarios.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Usuário</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="email"] { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 15px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>
    <a href="usuarios.php">Voltar</a>
    <h1>Cadastrar Usuário</h1>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <button type="submit">Salvar</button>
    </form>
    
</body>
</html>
