<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/AgregadoDAO.php');

$agregado = new Agregado();

$pacote = $_POST['pacote'];


if(!isset($_POST['check'])){

	 echo 2;
}

else{
	$envio = $_POST['check'];
foreach ($pacote as $chave => $dados) {

 if(isset($envio[$chave])){	
   $agregado->setId_Agregado($chave);
   $pacot = $pacote[$chave];

   CadastraAgregadoInter($agregado,$pacot,RetornaNumeroPulseira($pacot));

 
 }
 
}
 echo 1;
}


?>