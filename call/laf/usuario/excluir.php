<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/UsuarioDAO.php');

$usuario = new Usuario();

$usuario->setId_usuario($_POST['idExcluir']);

echo ExcluiUsuario($usuario);
 
?>