<?php 

ob_start();
session_start();

include_once 'fonksiyon.php';


$girisim = new yetkiler();


?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<title>Aziz - STOK GÜNCELLME SİSTEMİ</title>
</head>
<body>

 <div class="container text-center">
 	<div class="row text-center">
		<div class="col-xl-4 col-lg-4 col-md-4 text-center mx-auto mt-5">
							<div class="row text-center mx-auto bg-light border p-2">
									<?php 
									$girisim->giriskontrol($db); ?>	
							</div>
		
		
		</div>
	
	</div>
 
 
 </div>

	<?php 


switch(@$_GET["sifre"]):

case "sifreyenile";

$girisim->sifreyenile($db);

break;

endswitch;



?>
</body>
</html>










