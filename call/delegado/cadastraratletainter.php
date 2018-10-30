<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/AtletaDAO.php');

$atleta = new Atleta();

$pacote = $_POST['pacote'];


if(!isset($_POST['check'])){

	 echo 2;
}

else{
	$envio = $_POST['check'];
foreach ($pacote as $chave => $dados) {

 if(isset($envio[$chave])){	
   $atleta->setId_Atleta($chave);
   $pacot = $pacote[$chave];

   CadastraAtletaInter($atleta,$pacot,RetornaNumeroPulseira($pacot));

 
 }
 
}
 echo 1;
}


?>