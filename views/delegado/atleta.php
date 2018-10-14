<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

include($raiz.'/models/model_validacao.php');

$validate = new validacao;

session_start();

$validate ->ExisteSessao();

$validate ->ValidaSessao($_SESSION['usuarioid']);

$validate ->ValidarPermissao($_SESSION['usuarioid'],5);

?>

<?php include("../../views/includes/header.php");?>

<?php include("../../views/includes/top_bar.php");?>

<div class="page-container row-fluid container-fluid">

    <?php include("../../views/includes/side_bar.php");?>

    <section id="main-content" class="">
        <section class="wrapper main-wrapper row">

            <div class='col-xs-12'>
                <div class="page-title">

                    <ol class="breadcrumb primary">
                        <li>
                             <a href="/"><i class="fa fa-home"></i>Início</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-tasks"></i>Delegado</a>
                        </li>
                        <li class="active">
                            <strong><i class="fa fa-user"></i>Cadastrar de Atleta</strong>
                        </li>
                    </ol>

                </div>
            </div>            
            
            <div class="clearfix"></div>
            <!-- MAIN CONTENT AREA STARTS -->            

            <div class="col-lg-12">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Cadastrar Atleta</h2>
                        <div class="actions panel_actions pull-right">
                        </div>
                    </header>
                    
  <div class="content-body" style="display: block;">
    <div class="row">
      <form method="post" action="" name="formdiv" id="formdiv"  enctype="multipart/form-data">
        <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Nome</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="nome" name="nome">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">RA</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="ra" name="ra">
                                </div>
                            </div>
                        </div>
            </div> 
             <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">RG ou CNH</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="rg" name="rg">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Curso</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="curso" name="curso">
                                </div>
                            </div>
                        </div>
            </div> 
            <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Email</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Celular</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="celular" name="celular" data-mask="(99)99999-9999">
                                </div>
                            </div>
                        </div>
            </div> 
            <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Ano de Matricula</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="ano" name="ano" data-mask="9999">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Semestre</label>
                                <div class="controls">
                                    <select class="form-control" id="semestre" name="semestre">

                                      <option> 1º Semestre </option>
                                      <option> 2º Semestre </option>

                                    </select>  
                                </div>
                            </div>
                        </div>
            </div> 
            <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Turno</label>
                                <div class="controls">
                                    <select class="form-control" id="turno" name="turno">

                                      <option> Diurno </option>
                                      <option> Matutino </option>
                                      <option> Noturno </option>

                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Declaração</label>
                                <div class="controls">
                                   <input type="file" class="form-control" name="declaracao" id="declaracao">  
                                </div>
                            </div>
                        </div>
            </div>
            <div class="row">
                
                <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                               <label for="nome" class="control-label">Unidade</label>
                                <div class="controls">
                                   <select class="form-control" id="unidade" name="unidade">

                                    </select> 
                                </div>
                            </div>
                </div>            


            </div>   
            <div class="row">

                <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                               
                                <div class="controls">
                                    <button type="button" class="btn btn-primary" id="btncadastrar" name="btncadastrar" onclick="cadastrar()">Cadastrar</button>
                                </div>
                            </div>
                </div>            


            </div>                 
       </form>
      </div> 
    </div>
  
 </div> 
                </section>
            </div>
        </section>
    </section>
    <!-- CHAT <?php //include("../../views/includes/chat.php");?> -->
</div>

<?php include("../../views/includes/footer.php");?>

<script src="../../js/delegado/atleta.js" type="text/javascript"></script>