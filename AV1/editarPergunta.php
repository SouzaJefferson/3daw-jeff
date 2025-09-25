<?php
$arquivo = 'perguntas.txt';
$id = $_GET['id'] ?? null;
$perguntaAtual = null;
$linhas = [];

if ($id && file_exists($arquivo)) {
    $linhas = file($arquivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($linhas as $linha) {
        list($idPergunta, $tipo, $pergunta, $opcoes, $correta) = explode(";", $linha);
        if ($idPergunta == $id) {
            $perguntaAtual = [
                'id' => $idPergunta,
                'tipo' => $tipo,
                'pergunta' => $pergunta,
                'opcoes' => $opcoes,
                'correta' => $correta
            ];
            break;
        }
    }
}

// Se enviou o formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idEdicao = $_POST['id'];
    $tipo = $_POST['tipo'];
    $pergunta = trim($_POST['pergunta']);

    if ($tipo == "multipla") {
        $opcoesArray = array_filter($_POST['opcoes'], fn($op) => trim($op) !== "");
        $opcoes = implode("|", $opcoesArray);
        $correta = $_POST['correta'] ?? 0;
    } else {
        $opcoes = "";
        $correta = "";
    }

    // Monta a nova linha
    $novaLinha = "$idEdicao;$tipo;$pergunta;$opcoes;$correta";

    // Reescreve o arquivo
    foreach ($linhas as $i => $linha) {
        list($idPergunta) = explode(";", $linha);
        if ($idPergunta == $idEdicao) {
            $linhas[$i] = $novaLinha;
            break;
        }
    }
    file_put_contents($arquivo, implode(PHP_EOL, $linhas) . PHP_EOL);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Pergunta</title>
<style>
body { font-family: sans-serif; margin:20px; }
label { display:block; margin-top:10px; font-weight:bold; }
textarea, input[type=text] { width:100%; padding:8px; margin-top:5px; }
.opcao-container { margin-top:10px; display:flex; align-items:center; gap:10px; }
button { margin-top:20px; padding:10px 15px; background:#007bff; color:white; border:none; border-radius:5px; cursor:pointer; }
button:hover { background:#0056b3; }
.voltar { display:inline-block; margin-top:20px; text-decoration:none; color:#007bff; }
</style>
</head>
<body>
<h1>Editar Pergunta</h1>
<a href="index.php" class="voltar">← Voltar</a>

<?php if ($perguntaAtual): ?>
    <form method="post">
        <input type="hidden" name="id" value="<?= $perguntaAtual['id'] ?>">
        <input type="hidden" name="tipo" value="<?= $perguntaAtual['tipo'] ?>">

        <label>Pergunta:</label>
        <textarea name="pergunta" required><?= htmlspecialchars($perguntaAtual['pergunta']) ?></textarea>

        <?php if ($perguntaAtual['tipo'] == "multipla"): ?>
            <h3>Opções de resposta</h3>
            <?php 
                $opcoes = explode("|", $perguntaAtual['opcoes']);
                foreach ($opcoes as $i => $opcao): 
            ?>
                <div class="opcao-container">
                    <input type="radio" name="correta" value="<?= $i ?>" <?= ($i == $perguntaAtual['correta']) ? "checked" : "" ?>>
                    <input type="text" name="opcoes[]" value="<?= htmlspecialchars($opcao) ?>">
                </div>
            <?php endforeach; ?>

            <!-- Campo para adicionar mais opções -->
            <?php for ($j = count($opcoes); $j < 5; $j++): ?>
                <div class="opcao-container">
                    <input type="radio" name="correta" value="<?= $j ?>">
                    <input type="text" name="opcoes[]" placeholder="Nova opção...">
                </div>
            <?php endfor; ?>
        <?php endif; ?>

        <button type="submit">Salvar Alterações</button>
    </form>
<?php else: ?>
    <p style="color:red;">Pergunta não encontrada.</p>
<?php endif; ?>
</body>
</html>
