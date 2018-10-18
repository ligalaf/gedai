<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/UsuarioDAO.php');

$usuario = new Usuario();

session_start();

$usuario->setId_usuario($_SESSION['usuarioid']);
$usuario->setNome($_POST['nome_editar_menu']);
$usuario->setSenha($_POST['senha_editar_menu']);
if(isset($_FILES['foto_editar_menu']) && !empty($_FILES['foto_editar_menu']['name']) ){
	$usuario->setAvatar($_FILES['foto_editar_menu']);
}else{
	$usuario->setAvatar('');
}
echo AlteraUsuarioMenu($usuario);

?>