 
<!-- Teste para conseguir fazer a requisição em 1 só arquivo -->

<?php

if ($_SERVER['REQUEST_METHOD']== 'POST'){

  $nome = $_POST["nome"];
     $sigla = $_POST["sigla"];
      $hora = $_POST["hora"];
      echo "nome: $nome <br> sigla $sigla <br> horas:$hora";

    if (!file_exists("disciplinas.txt")) {
      $arqDisc = fopen("disciplinas.txt" , "a") or die ("Erro na abertura"); //cria variavél como nome do disco?
      $linha = "nome;sigla;carga\n" ; // cria variavél para escrever na linha
      fwrite($arqDisc, $linha);
      fclose($arqDisc); // fecha o arquivo
     }

     $arqDisc = fopen("disciplinas.txt" , "a") or die ("Erro na abertura"); //cria variavél como nome do disco?
      $linha = "$nome;$sigla;$hora\n" ; // subistitui agora pelas variaveis
      fwrite($arqDisc, $linha);
      fclose($arqDisc); // fecha o arquivo
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>incluir disciplina</title>
</head>
<body>
    <form action="Teste.php" method="post">
    <input type="text" placeholder="nome" name="nome"> 
    <input type="text" placeholder="Sigla" name="sigla"> 
    <input type="number" placeholder="Carga Horaria" name="hora"> 
    <input type="submit" value="criar curso">
    </form>
</body>
</html>
