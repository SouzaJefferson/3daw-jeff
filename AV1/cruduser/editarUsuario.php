<?php
$arquivo = 'usuarios.txt';
$id = $_GET['id'] ?? null;
$usuario = null;

if ($id && file_exists($arquivo)) {
    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($linhas as $linha) {
        $dados = explode(";", $linha);
        if ($dados[0] == $id) {
            $usuario = $dados;
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);

    $novaLista = [];
    foreach ($linhas as $linha) {
        $dados = explode(";", $linha);
        if ($dados[0] == $id) {
            $novaLista[] = $id . ";" . $nome . ";" . $email;
        } else {
            $novaLista[] = $linha;
        }
    }

    file_put_contents($arquivo, implode(PHP_EOL, $novaLista) . PHP_EOL);
    header("Location: usuarios.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        label { 
            display: block;
            margin-top: 10px; 
        }
        input{
             width: 100%; 
             padding: 8px; 
             margin-top: 5px; 
            }
        button { 
            margin-top: 15px; 
            padding: 10px 15px; 
            background-color: #007bff; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }
        button:hover { 
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <a href="./usuarios.php">Voltar</a>
    <h1>Editar Usuário</h1>
    <?php if ($usuario): ?>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($usuario[1]) ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($usuario[2]) ?>" required>

        <button type="submit">Salvar Alterações</button>
    </form>
    <?php else: ?>
        <p>Usuário não encontrado!</p>
    <?php endif; ?>
    
</body>
</html>
