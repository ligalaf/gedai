<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/AtletaDAO.php');

$atleta = new Atleta();


 
$atleta->setNome($_POST['nome']);
$atleta->setRa($_POST['ra']);
$atleta->setRG($_POST['rg']);
$atleta->setFk_Unidade($_POST['unidade']);
$atleta->setCurso($_POST['curso']);
$atleta->setTurno($_POST['turno']);
$atleta->setSemestre($_POST['semestre']);
$atleta->setEmail($_POST['email']);
$atleta->setCelular($_POST['celular']);
$atleta->setAno($_POST['ano']);
$atleta->setDeclaracao($_FILES['declaracao']);


echo CadastrarAtleta($atleta);

?>