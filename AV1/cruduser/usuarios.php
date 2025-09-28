<?php
$arquivo = 'usuarios.txt';
$usuarios = [];

if (file_exists($arquivo)) {
    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($linhas as $linha) {
        $usuarios[] = explode(";", $linha);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Usuários</title>
    <style>
        body { 
            font-family: sans-serif;
             margin: 20px; 
            }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }

        th, td {
             border: 1px solid #ccc; 
             padding: 10px; 
             text-align: left;
             }

        thead { 
            background-color: #f2f2f2; 
        }

        .acoes a {
             margin-right: 10px; 
             text-decoration: none; 
            }
        .btn-novo { 
            display: inline-block; 
            margin-top: 20px; 
            padding: 10px 15px; 
            background-color: #01ca1cff; 
            color: black; 
            text-decoration: none; 
            border-radius: 5px; 
        }
        
header {
    background-color: #200573ff;
    padding: 15px;
}
    nav {
    display: flex;
    justify-content: center; 
    gap: 40px; 
    align-items: center;
}

nav a {
    text-decoration: none;
    color: white; 
    font-weight: bold;
    padding: 8px 12px;
    border-radius: 5px;
    transition: background 0.3s;
}

nav a:hover {
    background-color: rgba(255, 255, 255, 0.2); 
}

nav a.active {
    background-color: white;  
    color: #007bff;            
}
    </style>
</head>
<body>
     <header>
    <nav>
        <a href="../index.php">Gerenciamento de Perguntas</a>
        <a href="./cruduser/usuarios.php">Gerenciamento de Usuários</a>
    </nav>
</header>
    <h1>Gerenciamento de Usuários</h1>
    <a href="./criarUsuario.php" class="btn-novo">Novo Usuário</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($usuarios)): ?>
                <tr><td colspan="4">Nenhum usuário cadastrado.</td></tr>
            <?php else: ?>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u[0]) ?></td>
                        <td><?= htmlspecialchars($u[1]) ?></td>
                        <td><?= htmlspecialchars($u[2]) ?></td>
                        <td class="acoes">
                            <a href="./editarUsuario.php?id=<?= $u[0] ?>">Editar</a>
                            <a href="./excluirUsuario.php?id=<?= $u[0] ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

 
</body>
</html>
