<?php
$arquivo = 'perguntas.txt';
$erro = '';
$sucesso = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pergunta = trim($_POST['pergunta']);

    // Gerar ID automático
    $novoId = 1;
    if (file_exists($arquivo) && filesize($arquivo) > 0) {
        $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $ultimo = explode(";", end($linhas));
        $novoId = intval($ultimo[0]) + 1;
    }

    if(empty($pergunta)){
        $erro = "Digite a pergunta.";
    } else {
        $linha = "$novoId;texto;$pergunta;;\n";
        if(file_put_contents($arquivo, $linha, FILE_APPEND) === false){
            $erro = "Falha ao salvar a pergunta.";
        } else {
            $sucesso = "Pergunta cadastrada com sucesso!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastrar Pergunta de Texto</title>
<style>
body { font-family: sans-serif; margin:20px; }
label { display:block; margin-top:10px; }
textarea { width:100%; padding:8px; margin-top:5px; }
button { margin-top:15px; padding:10px 15px; background:#28a745; color:white; border:none; border-radius:5px; cursor:pointer; }
button:hover { background:#218838; }
.voltar { display:inline-block; margin-top:20px; text-decoration:none; color:#007bff; }
.erro { color:red; margin-top:10px; }
.msg { color:green; margin-top:10px; }
</style>
</head>
<body>
<h1>Cadastrar Pergunta de Texto</h1>
<a href="index.php" class="voltar">← Voltar</a>

<?php if($erro) echo "<div class='erro'>$erro</div>"; ?>
<?php if($sucesso) echo "<div class='msg'>$sucesso</div>"; ?>

<form method="post">
<label>Pergunta:</label>
<textarea name="pergunta" required></textarea>
<button type="submit">Salvar Pergunta</button>
</form>
</body>
</html>
