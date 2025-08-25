<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listar</title>
</head>
<body>
    
<?php
$arqDisc = fopen("disciplinas.txt", "r") or die("ERRO DE ABERTURA DO ARQUIVO");
while (!feof($arqDisc)) {
   $linha = fgets($arqDisc);
   $colunaDados = explode(";", $linha);
echo "<table><tr> <td> $colunaDados[0] </td><td> $colunaDados[1] </td><td> $colunaDados[2] </td> </tr> </table>";

   
}

?>
</body>
</html>