<?php 

ob_start();
session_start();

include_once 'fonksiyon.php';


$girisim = new yetkiler();


?>


<html>
    <title>Aziz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   
    <body>
    
    <?php 
    
    switch(@$_GET["yeni"]):
    
    case "sifreyenile";

    $girisim->sifreyenile($db);
    
    break;

    endswitch;

    ?>

    </body>
</html>