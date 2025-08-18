<?php
$v1= $_GET["a"];
$v2= $_GET["b"];
$resultado=0;
if ($v1==null) {
    $v1=0;
}
switch ($operador) {
    case 'value':
        # code...
        break;
    
    default:
        # code...
        break;
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
   echo "<br/> <br/>";
   echo "<h1> Resultado: $resultado </h1>"
   ?>
    <form action="soma.php" method="get">

       a: <input type="text" placeholder="primeiro elemento" name="a"> 
      Operação: <input type="text" placeholder="segundo elemento" name="op"> 
       b: <input type="text" placeholder="segundo elemento" name="b"> 
 
      <input type="submit" name="+">
    </form>
</body>
</html>