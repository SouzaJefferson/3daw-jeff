<?php
$arqNome= fopen(filename: "alunos.txt", mode: "r") or die("erro na abertura do aqrquivo");
fgets($arqNome); //faz a leitura do arquivo e ignora o titulo?

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Lista</title>
</head>
<body>
    <header>
        <h1>Lista Aluno</h1>
</header>
<table>
    <thead> <!-- titulo da tabela(ignorado pelo php)-->
        <tr>
            <th>nome</th>
            <th>Cpf</th>
            <th>Mat</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
            while(!feof($arqNome)) {
               $array= explode(";", fgets($arqNome)); //inicio do loop sem fechar
        ?>
            <tr>
                <td><?php echo  $array[0] ?></td> <!-- o explode retorna uma posição do array-->
                <td><?php echo  $array[1] ?></td> <!-- primeiro parametro é o ";" que é aonde ele para-->
                <td><?php echo  $array[2] ?></td> 
                 <td><a href="editar.php?id=<?php echo $i ?>">Editar</a></td>
            </tr>
        <?php
         $i++;
            } //o codigo do php permite isso fazendo com que o loop insira o campo a cima
        ?>
    </tbody>
    </table>
   
</body>
</html>