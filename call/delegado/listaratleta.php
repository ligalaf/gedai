<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/AtletaDAO.php');

echo ListaAtleta();
 
?>