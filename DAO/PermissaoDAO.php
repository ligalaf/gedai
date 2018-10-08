<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

require_once($raiz.'/DAO/conexao.php');
require_once($raiz.'/models/model_permissao.php');
require_once($raiz.'/models/model_permissao_usuario.php');

function RetornaMenu($usuario){
 
  

    $conexao = new Conexao();

    $cmdsql = "SELECT FK_Permissao
        FROM tb_permissao_usuario
        WHERE FK_Usuario = {$usuario->getId_Usuario()}";
    
    $exec = mysqli_query($conexao->getConexao(),$cmdsql);

    $permissao = array();
    
  
    while($aux = mysqli_fetch_assoc($exec)){

        $permissao[] = $aux['FK_Permissao'];
         
    }
 
   

    $menu = null;

    if(in_array('1',$permissao)){

        $menu .='<li class="menusection">LAF</li>';
    }
    if(in_array('2',$permissao)){

        $menu .=  '<li class="">
                <a href="/views/laf/usuario.php">
                    <i class="fas fa-users"></i>
                    <span class="title">Usuários</span>
                </a>
            </li>';
    }
      if(in_array('3',$permissao)){

        $menu .=  '<li class="">
                <a href="/views/laf/atletaspendentes.php">
                    <i class="fas fa-edit"></i>
                    <span class="title">Atletas Pendentes</span>
                </a>
            </li>';
    }
        if(in_array('4',$permissao)){

        $menu .='<li class="menusection">Delegados</li>';
    }
    if(in_array('5',$permissao)){

        $menu .=  '<li class="">
                <a href="/views/delegado/atleta.php">
                    <i class="fas fa-edit"></i>
                    <span class="title">Cadastrar Atleta</span>
                </a>
            </li>';
    }
     if(in_array('6',$permissao)){

        $menu .=  '<li class="">
                <a href="/views/cadastro">
                    <i class="fas fa-edit"></i>
                    <span class="title">Lista de Atletas</span>
                </a>
            </li>';
    }



    
    $conexao->FechaConexao($conexao->getConexao());

    return $menu;
  
}

function ListaPermissaoSelect($id){

  $conexao = new Conexao();
    
  $retorno = null;

   $cmdsql = "SELECT ID_Permissao, Nome FROM tb_permissao p
          where id_permissao not in (select FK_Permissao from tb_permissao_usuario where
          fk_usuario =$id)  
              order by Nome asc";


    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($permissao = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
     
        <option value =".$permissao['ID_Permissao'].">".$permissao['Nome']."</option>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}
function ListaPermissaoSelectId($id){

  $conexao = new Conexao();
    
  $retorno = null;

  $cmdsql = "SELECT ID_Permissao, Nome FROM tb_permissao p
            inner join tb_permissao_usuario pu on p.ID_Permissao = pu.FK_Permissao
            where pu.FK_Usuario = $id
              order by Nome asc";

              
    
  $resultado = mysqli_query($conexao->getConexao(), $cmdsql);



  while($permissao = mysqli_fetch_assoc($resultado)){
        
    $retorno = $retorno."
     
        <option value =".$permissao['ID_Permissao'].">".$permissao['Nome']."</option>";
  }

  $conexao->FechaConexao($conexao->getConexao());

  return $retorno;

}

function CadastraPermissao($permissao_usuario,$permissoes){


   $conexao = new Conexao();

   

    foreach($permissoes as $value){

 // Se for validado faz o insert
    $cmdsql = "INSERT INTO tb_permissao_usuario (FK_Usuario,FK_Permissao) 
               VALUES ({$permissao_usuario->getFk_usuario()},{$value})";

   mysqli_query($conexao->getConexao(),$cmdsql);
    


  }

      $conexao->FechaConexao($conexao->getConexao());

   echo 1;            


}
function ExcluiPermissao($permissao_usuario,$permissoes){


   $conexao = new Conexao();

   

    foreach($permissoes as $value){

 // Se for validado faz o insert
    $cmdsql = "DELETE FROM tb_permissao_usuario where FK_USUARIO =
                {$permissao_usuario->getFk_usuario()} and FK_Permissao = {$value}";

              

   mysqli_query($conexao->getConexao(),$cmdsql);
    


  }

      $conexao->FechaConexao($conexao->getConexao());

   echo 1;            


}


?>