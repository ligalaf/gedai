<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/PermissaoDAO.php');
require_once($raiz.'/models/model_permissao_usuario.php');



$permissao = new PermissaoUsuario();

$permissao->setFk_usuario($_POST['idAlterar']);


echo ListaPermissaoSelect($permissao->getFk_usuario());

?>