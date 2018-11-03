<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/AgregadoDAO.php');

$agregado = new Agregado();

$agregado->setId_Agregado($_POST['idAlterar']);



echo ExcluiAgregadoInter($agregado->getId_Agregado());

?>