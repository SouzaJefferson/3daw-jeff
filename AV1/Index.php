<?php
$arquivo = 'perguntas.txt';


$buscaId = $_GET['id'] ?? '';
$filtroTipo = $_GET['tipo'] ?? 'todos';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>WaterFalls - Perguntas</title>
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

form.filtros {
    margin-top: 20px;
    display: flex;
    gap: 15px;
    align-items: center;
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
        <a href="index.php">Gerenciamento de Perguntas</a>
        <a href="./cruduser/usuarios.php">Gerenciamento de Usuários</a>
    </nav>
</header>


   <section>
        <h1>Gerenciar Perguntas</h1>
        <a href="criarMulti.php" class="btn-novo">Cadastrar Nova Multipla</a>
        <a href="criarTexto.php" class="btn-novo">Cadastrar Nova Texto</a>

        
        <form method="get" class="filtros">
            <label>Buscar por ID:
                <input type="number" name="id" value="<?= htmlspecialchars($buscaId) ?>" placeholder="Ex: 2">
            </label>
            <label>Filtrar por tipo:
                <select name="tipo">
                    <option value="todos" <?= $filtroTipo === 'todos' ? 'selected' : '' ?>>Todos</option>
                    <option value="multipla" <?= $filtroTipo === 'multipla' ? 'selected' : '' ?>>Múltipla</option>
                    <option value="texto" <?= $filtroTipo === 'texto' ? 'selected' : '' ?>>Texto</option>
                </select>
            </label>
            <button type="submit">Aplicar</button>
            <a href="index.php">Limpar</a>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pergunta</th>
                    <th>Tipo</th>
                    <th>Opções</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (file_exists($arquivo) && filesize($arquivo) > 0) {
                    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $encontrou = false;

                    foreach ($linhas as $linha) {
                        list($idPergunta, $tipo, $pergunta, $opcoes, $correta) = explode(';', $linha);

                        // Aplica filtros
                        if ($buscaId && $idPergunta != $buscaId) continue;
                        if ($filtroTipo !== 'todos' && $tipo !== $filtroTipo) continue;

                        $encontrou = true;
                        $listaOpcoes = explode('|', $opcoes);

                        foreach ($listaOpcoes as $index => &$op) {
                            if ($index == $correta) {
                                $op = "<strong>" . htmlspecialchars($op) . "</strong>";
                            } else {
                                $op = htmlspecialchars($op);
                            }
                        }

                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($idPergunta) . "</td>";
                        echo "<td>" . htmlspecialchars($pergunta) . "</td>";
                        echo "<td>" . htmlspecialchars($tipo) . "</td>";

                        if ($tipo === "multipla") {
                            echo "<td>" . implode('<br>', $listaOpcoes) . "</td>";
                        } else {
                            echo "<td><em>Resposta aberta</em></td>";
                        }

                        echo "<td class='acoes'>
                                <a href='editarPergunta.php?id=$idPergunta'>Editar</a>
                                <a href='excluirPergunta.php?id=$idPergunta' onclick='return confirm(\"Tem certeza que deseja excluir esta pergunta?\");'>Excluir</a>
                              </td>";
                        echo "</tr>";
                    }

                    if (!$encontrou) {
                        echo "<tr><td colspan='5'>Nenhuma pergunta encontrada com os filtros aplicados.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhuma pergunta cadastrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</body>
</html>
