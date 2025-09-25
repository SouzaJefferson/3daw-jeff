<?php
$arquivo = 'perguntas.txt';

if (isset($_GET['id'])) {
    $idExcluir = intval($_GET['id']);

    if (file_exists($arquivo) && filesize($arquivo) > 0) {
       
        $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $novasLinhas = [];
        $novoId = 1;

        foreach ($linhas as $linha) {
            list($id, $tipo, $pergunta, $opcoes, $correta) = explode(";", $linha);

            if ((int)$id !== $idExcluir) {
             
                $novasLinhas[] = $novoId . ";" . $tipo . ";" . $pergunta . ";" . $opcoes . ";" . $correta;
                $novoId++;
            }
        }

  
        file_put_contents($arquivo, implode(PHP_EOL, $novasLinhas) . PHP_EOL);
    }
}


header("Location: index.php");
exit;
?>
