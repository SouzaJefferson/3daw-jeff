<?php
$v1=0;
$v2= 0;
$resultado=0;

if ($_SERVER['REQUEST_METHOD']=='POST') {
    echo "<h3>Resultado: $resultado</h3>";
} 
else {
    echo"é get";
}
?>
 <HTML lang="pt-br">
 <head>
 <meta charset="UTF-8"> </meta>
 <link rel="stylesheet" href="./style.css">
<title> "ola mundo"</title>
</head>
<body>
    
   <?php
   if ($_SERVER['REQUEST_METHOD']=='POST') {
    echo "<h3>Resultado: $resultado</h3>"
}

   echo "<br/> <br/>";
   echo "<h1> Resultado: $resultado </h1>"
   ?>
    <form action="soma.php" method="post">

       a: <input type="text" placeholder="primeiro elemento" name="a"> 
      Operação: <input type="text" placeholder="segundo elemento" name="op"> 
       b: <input type="text" placeholder="segundo elemento" name="b"> 
 
      <input type="submit" name="enviar">
    </form>
</body>
</html>