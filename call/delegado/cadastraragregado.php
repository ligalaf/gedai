<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/AgregadoDAO.php');

$agregado = new Agregado();


 
$agregado->setNome($_POST['nome']);
$agregado->setRG($_POST['rg']);
$agregado->setFk_Unidade($_POST['unidade']);
$agregado->setTipo($_POST['tipo']);
$agregado->setEmail($_POST['email']);
$agregado->setCelular($_POST['celular']);
$agregado->setFoto($_FILES['foto']);

echo CadastrarAgregado($agregado);

?>