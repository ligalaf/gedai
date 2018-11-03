<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/AtletaDAO.php');

$atleta = new Atleta();

$atleta->setId_Atleta($_POST['idAlterar']);



echo ExcluiAtletaInter($atleta->getId_Atleta());

?>