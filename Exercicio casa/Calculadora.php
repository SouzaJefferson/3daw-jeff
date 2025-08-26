<?php

if ($_SERVER['REQUEST_METHOD']== 'POST'){

$n1 = $_POST['n1'];
$n2 = $_POST['n2']; //pega os numeros que forem colocados
$operacao = $_POST['operacao'];

switch ($operacao) {
    case 'somar':
        $resultado = $n1 + $n2;
        break;
    case 'subtrair':
        $resultado = $n1 - $n2;
        break;
    case 'multiplicar':
        $resultado = $n1 * $n2;
        break;
    case 'dividir':
        $resultado = $n1 / $n2;
        break;
}
 echo "<p>Resultado: $resultado</p>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <style>
    body {
        margin-top: 50px;
        display: flex;
        flex-direction: column;
        align-items: center;      /* Centraliza o conteúdo no meio da pagina */
        justify-content: center;  
    }

    h1 {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    form {
        display: flex;
        flex-direction: column;
        width: 200px;
        gap: 1rem;
        border: 1px solid #000000ff;
        padding: 10px;
        border-radius: 5px;
        
    }
    p {
        font-size: 1.5rem;
        font-weight: bold;
        margin-top: 1rem;
        position: relative;
        z-index: 1;
        color: #000000ff;
        text-shadow: 1px 1px 0 #ffffff, -1px -1px 0 #ffffff;

    }
   </style>
    <title>Document</title>
</head>
<body>
    <h1>Calculadora</h1>
    <form action="Calculadora.php" method="post">
        <input type="number" name="n1" placeholder="Numero 1">
        <input type="number" name="n2" placeholder="Numero 2">
        <select name="operacao">
            <option value="somar">Somar</option>
            <option value="subtrair">Subtrair</option>
            <option value="multiplicar">Multiplicar</option>
            <option value="dividir">Dividir</option>
        </select>
        <button type="submit">Calcular</button>
    </form>
</body>
</html>