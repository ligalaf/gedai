<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/UsuarioDAO.php');

$usuario = new Usuario();

$usuario->setId_usuario($_POST['idAlterar']);
$usuario->setNome($_POST['nome_editar']);
$usuario->setSenha($_POST['senha_editar']);
$usuario->setEmail($_POST['email_editar']);
$usuario->setBloqueado($_POST['bloqueado_editar']);
$usuario->setTipo($_POST['tipo_editar']);
$usuario->setFk_Unidade($_POST['unidade_editar']);
if(isset($_FILES['foto_editar']) && !empty($_FILES['foto_editar']['name']) ){
	$usuario->setAvatar($_FILES['foto_editar']);
}else{
	$usuario->setAvatar('');
}
echo AlteraUsuario($usuario);

?>