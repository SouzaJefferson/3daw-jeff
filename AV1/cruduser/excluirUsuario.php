<?php
$arquivo = 'usuarios.txt';
$id = $_GET['id'] ?? null;

if ($id && file_exists($arquivo)) {
    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $novaLista = [];
    $novoId = 1;

    foreach ($linhas as $linha) {
        $dados = explode(";", $linha);
        if ($dados[0] != $id) {
            $dados[0] = $novoId++;
            $novaLista[] = implode(";", $dados);
        }
    }

    file_put_contents($arquivo, implode(PHP_EOL, $novaLista) . PHP_EOL);
}

header("Location: usuarios.php");
exit;
?>
