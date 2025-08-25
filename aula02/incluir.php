<?php
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $nome = $_POST["nome"];
     $sigla = $_POST["sigla"];
      $hora = $_POST["hora"];
      echo "nome: $nome <br> sigla $sigla <br> horas:$hora";


      if (!file_exists("disciplinas.txt")) {
        # code...
      }
}

?>