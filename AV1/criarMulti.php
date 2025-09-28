<?php
$arquivo = 'perguntas.txt';
$erro = '';
$sucesso = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pergunta = trim($_POST['pergunta']);
    $opcoes = $_POST['opcoes'] ?? [];
    $correta = $_POST['correta'] ?? '';

   
    $novoId = 1;
    if (file_exists($arquivo) && filesize($arquivo) > 0) {
        $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $ultimo = explode(";", end($linhas));
        $novoId = intval($ultimo[0]) + 1;
    }

    $opcoes = array_map('trim', $opcoes);

    if (empty($pergunta) || count(array_filter($opcoes)) < 2 || $correta === '' || !isset($opcoes[$correta])) {
        $erro = "Preencha todos os campos corretamente!";
    } else {
        $linha = "$novoId;multipla;$pergunta;" . implode('|', $opcoes) . ";$correta\n";
        file_put_contents($arquivo, $linha, FILE_APPEND);
        $sucesso = "Pergunta cadastrada com sucesso!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastrar Pergunta Múltipla</title>

<style>
body {
     font-family: sans-serif; 
     margin:20px; 
    }

label { 
    display:block; 
    margin-top:10px; 
}

input[type=text] { 
    width: 100%; 
    padding: 8px; 
    margin-top:5px; 
}

button { 
    margin-top:15px; 
    padding:10px 15px; 
    background:#28a745; 
    color:white; 
    border:none; 
    border-radius:5px; 
    cursor:pointer; 
}

button:hover { 
    background:#218838; 
}

.voltar { 
    display:inline-block; 
    margin-top:20px; 
    text-decoration:none; 
    color:#007bff; 
}

.erro { 
    color:red; 
    margin-top:10px; 
}

.msg { 
    color:green; 
    margin-top:10px; 
}

</style>
</head>
<body>
<h1>Cadastrar Pergunta Múltipla</h1>
<a href="./index.php" class="voltar">Voltar</a>

<?php if($erro) echo "<div class='erro'>$erro</div>"; ?>
<?php if($sucesso) echo "<div class='msg'>$sucesso</div>"; ?>

<form method="post">
<label>Pergunta:</label>
<textarea name="pergunta" required></textarea>

<label>Opções:</label>
<?php for($i=0;$i<5;$i++): ?>
    <input type="radio" name="correta" value="<?= $i ?>"> 
    <input type="text" name="opcoes[]" placeholder="Opção <?= $i+1 ?>"><br>
<?php endfor; ?>
<small>Marque a opção correta.</small>

<button type="submit">Salvar Pergunta</button>
</form>
</body>
</html>
