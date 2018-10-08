<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/AtletaDAO.php');

$atleta = new Atleta();
$aux_atleta = new Atleta();

$atleta->setId_Atleta($_POST['idAlterar']);

$retorno = ListarUnicoAtletaPendente($atleta->getId_Atleta());

$aux_atleta = $retorno[0];
$aux_unidade = $retorno[1]; 






$array = array("nome" => $aux_atleta->getNome(),
			   "RA" => $aux_atleta->getRa(),
			   "RG" => $aux_atleta->getRg(),
			   "Curso" => $aux_atleta->getCurso(),
			   "Celular" => $aux_atleta->getCelular(),
			   "Email" => $aux_atleta->getEmail(),
			   "Ano" => $aux_atleta->getAno(),
			   "Semestre" => $aux_atleta->getSemestre(),
			   "Turno" => $aux_atleta->getTurno(),
			   "Declaracao" => $aux_atleta->getDeclaracao(),
			   "Unidade" => $aux_unidade->getNome()
);


echo json_encode($array);

?>