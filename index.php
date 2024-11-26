<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jardim Pet</title>
    <link rel="stylesheet" href="index.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>
<body>
<?php

    include_once("templates/topo.php");
    include_once("templates/menu.php");

    if(empty($_SERVER["QUERY_STRING"])){
        $var = "principal.php";
        include_once($var);
    }else{
        $pg = $_GET["pg"];
        include_once("$pg.php");
    }

    include_once("templates/rodape.php");
?>
</body>
</html>
