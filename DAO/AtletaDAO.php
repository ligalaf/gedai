<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/models/model_atleta.php');
require_once($raiz.'/models/model_unidade.php');
require_once($raiz.'/models/model_validacao.php');

function CadastrarAtleta($atleta){

  $validacao = new validacao;


  


  echo $validacao->validarCampo("Nome",$atleta->getNome(), 150, 10);
  echo $validacao->validarCampo("RA",$atleta->getRa(),100,6);
  echo $validacao->validarCampo("RG",$atleta->getRG(),100,12);
  echo $validacao->validarCampo("Curso",$atleta->getCurso(),100,12);
  echo $validacao->validarEmail($atleta->getEmail());
  echo $validacao->validarCampo("Curso",$atleta->getCurso(),100,12);
  echo $validacao->validarCampo("Celular",$atleta->getCelular(),100,10);
  echo $validacao->validarNumero("Ano",$atleta->getAno());
  echo $validacao->validarCampo("Semestre",$atleta->getSemestre(),100,10);
  echo $validacao->validarCampo("Turno",$atleta->getTurno(),100,4);
  echo $validacao->validarNumero("Unidade",$atleta->getFk_Unidade());
  //echo $validacao->ValidaImagem($atleta->getDeclaracao());
  

   

  if($validacao->verifica()){
     
    $foto = $atleta->getDeclaracao();

    // Pega extensão da imagem
    preg_match("/\.(jpeg|jpg|png|gif|bmp|pdf){1}$/i", $foto["name"], $ext);

    // Gera um nome único para a imagem
    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

    $raiz = $_SERVER['DOCUMENT_ROOT'];

    // Caminho de onde ficará a imagem
    $caminho_imagem = $raiz."/images/declaracao/" . $nome_imagem;

    // Faz o upload da imagem para seu respectivo caminho
    move_uploaded_file($foto["tmp_name"], $caminho_imagem);


   
    $conexao = new Conexao();
 
    $sql = "INSERT INTO tb_atleta (Nome, RA, RG,Curso,Email, Celular,Ano,Semestre,Turno,Declaracao,FK_Unidade,Situacao) 
            VALUES ('{$atleta->getNome()}','{$atleta->getRa()}','{$atleta->getRG()}','{$atleta->getCurso()}','{$atleta->getEmail()}','{$atleta->getCelular()}',{$atleta->getAno()},'{$atleta->getSemestre()}','{$atleta->getTurno()}','{$nome_imagem}',{$atleta->getFk_Unidade()},'0')";


        
    
    mysqli_query($conexao->getConexao(),$sql);
    
    $conexao->FechaConexao($conexao->getConexao());

    echo 1;
    
  }
}
 function ListaPendente(){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "
select a.ID_Atleta,a.Nome,u.Nome as Unidade,a.Email,a.RA from
tb_atleta a inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
where a.situacao = 0";

    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($cadastro = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
      <tr>
        <td align = 'center' width = '10%'>".$cadastro['ID_Atleta']."</td>
        <td align = 'center'>".$cadastro['Nome']."</td>
        <td align = 'center'>".$cadastro['Unidade']."</td>
        <td align = 'center'>".$cadastro['Email']."</td>
        <td align = 'center'>".$cadastro['RA']."</td>
            <td align = 'center'>
          <button class='btn btn-info' title='Editar' value='".$cadastro['ID_Atleta']."' onclick='visualizar(this)'>
            <i class='fas fa-edit'></i></td>
      </tr>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}


function ListarUnicoAtletaPendente($id){

  $conexao = new Conexao();

 $cmdsql = "SELECT a.Nome,a.RG,a.RA,a.Curso,Email,a.Ano,a.Semestre,a.Turno,a.Declaracao,u.Nome as Unidade,a.Celular FROM tb_atleta a inner join tb_unidade u on a.FK_Unidade = u.ID_Unidade
  WHERE a.ID_Atleta = $id";
    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);

  $array = mysqli_fetch_assoc($resultado);

  $conexao->FechaConexao($conexao->getConexao());

   $atleta = new Atleta();
   $unidade = new Unidade();

     $atleta->setNome($array['Nome']);
     $atleta->setRg($array['RG']);
     $atleta->setRa($array['RA']);
     $unidade->setNome($array['Unidade']);
     $atleta->setCurso($array['Curso']);
    $atleta->setEmail($array['Email']);
    $atleta->setAno($array['Ano']);
    $atleta->setSemestre($array['Semestre']);
    $atleta->setTurno($array['Turno']);
    $atleta->setCelular($array['Celular']);
    $atleta->setDeclaracao($array['Declaracao']);

     return array($atleta,$unidade);
}

?>