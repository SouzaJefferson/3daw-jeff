<?php
// Arquivo: criarPerguntas.php

$arquivo = 'perguntas.txt';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WaterFalls - Perguntas</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        thead { background-color: #f2f2f2; }
        .acoes a { margin-right: 10px; text-decoration: none; }
        .btn-novo { display: inline-block; margin: 20px 3rem 0 0; padding: 10px 15px; background-color: #2bff00ff; color: black; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
   <header> 
        <h1>Bem vindo ao Quiz!</h1>
        <h4>Treine suas capacidades corporativas!</h4>
   </header>

   <section>
        <h1>Gerenciar Perguntas</h1>
        <a href="criarMulti.php" class="btn-novo">Cadastrar Nova Pergunta multipla</a>
        <a href="criarTexto.php" class="btn-novo">Cadastrar Nova Pergunta Texto</a>
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

                    foreach ($linhas as $linha) {
                        
                        list($idPergunta, $tipo, $pergunta, $opcoes, $correta) = explode(';', $linha);

                        
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
                        if ($tipo == "multipla") {
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
                } else {
                    echo "<tr><td colspan='5'>Nenhuma pergunta cadastrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</body>
</html>
