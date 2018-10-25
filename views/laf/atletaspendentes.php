<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

include($raiz.'/models/model_validacao.php');

$validate = new validacao;

session_start();

$validate ->ExisteSessao();

$validate ->ValidaSessao($_SESSION['usuarioid']);

$validate ->ValidarPermissao($_SESSION['usuarioid'],3);

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
                            <a href="#"><i class="fa fa-tasks"></i>LAF</a>
                        </li>
                        <li class="active">
                            <strong><i class="fa fa-user"></i>Atletas Pendentes</strong>
                        </li>
                    </ol>

                </div>
            </div>            
            
            <div class="clearfix"></div>
            <!-- MAIN CONTENT AREA STARTS -->            

            <div class="col-lg-12">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Atletas Pendentes</h2>
                        <div class="actions panel_actions pull-right">
                        </div>
                    </header>
                    
                    <div class="content-body">
                        <div class="row">
                            <div class="col-xs-12"> 
                                <br>
                                <table class="display responsive" style="width:100%;" id="atletaTable">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nome</th>
                                            <th>Unidade</th>
                                            <th>Email</th>
                                            <th>RA</th>
                                            <th>Visualizar</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                    </tfoot>

                                    <tbody id="corpo">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </section>
    <!-- CHAT <?php //include("../../views/includes/chat.php");?> -->
</div>

<!--        Modal Add        -->
<div class="modal fade col-xs-12" id="modalUsuario" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 100%;">
        <form name="cadastrousuario" id="cadastrousuario" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Adicionar Usuário</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Nome</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="nome" name="nome">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="cpf" class="control-label">Tipo</label>
                                <div class="controls">
                                     <select class="form-control" id="tipo" name="tipo">
                                        <option value="LAF">LAF</option>
                                        <option value="Delegado">Delegado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                         <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="cpf" class="control-label">Unidade</label>
                                <div class="controls">
                                     <select class="form-control" id="unidade" name="unidade">
                                         
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <div class="controls">
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>                        
                     <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="senha" class="control-label">Senha</label>
                                <div class="controls input-group">
                                    <input type="password" class="form-control" id="senha" name="senha">
                                    <span class="input-group-addon" id="olho">
                                        <span class="arrow"></span>
                                        <i class="fa fa-eye-slash olho"></i>     
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="foto" class="control-label">Foto</label>
                                <div class="controls">
                                    <input type="file" class="form-control" id="foto" name="foto">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="bloqueado" class="control-label">Bloqueado</label>
                                <div class="controls">
                                    <select class="form-control" id="bloqueado" name="bloqueado">
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btncadastrar" name="btncadastrar" onclick="cadastrar()">Adicionar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
                </div>

            </div>
        </form>
    </div>
</div>

<!--        Modal Permissoes        -->
<div class="modal fade col-xs-12" id="modalPermi" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 100%;">

        <form id="formpermi" name="formpermi" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Permissões Usuario</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Permissões</label>
                                <div class="controls">
                                    <input type="hidden" name="idpermi" id="idpermi">
                                     <select class="form-control" id="permissao" name="permissao[]" multiple>
                                    </select>

                                </div>
                                <div class="controls">
                                    
                                     <button class='btn btn-primary' type="button" onclick="AdicionarPermi()">
                                     >>>
                                    </button>

                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Permissões Ativas</label>
                                <div class="controls">
                                     <select class="form-control" id="permissaotem" name="permissaotem[]" multiple>
                                    </select>
                                </div>
                                <div class="controls">
                                    
                                     <button class='btn btn-primary' type="button" onclick="RetirarPermi()">
                                     <<<
                                    </button>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
                </div>

            </div>
        </form>
    </div>
</div>

<!--        Modal Editar        -->
<div class="modal fade col-xs-12" id="modalAprovar" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 100%;">
        <form name="editarusuario" id="editarusuario" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpaModalAlterar()">&times;</button>
                    <h4 class="modal-title">Analisar Atleta</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Nome</label>
                                <div class="controls">
                                    <input type="hidden" name="idAlterar" id="idAlterar">
                                    <input type="text" class="form-control" id="nome_editar" name="nome_editar" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">RA</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="ra_editar" name="ra_editar" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">RG</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="rg_editar" name="rg_editar" readonly="">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="bloqueado" class="control-label">Curso</label>
                                <div class="controls">
                                   <input type="text" class="form-control" id="curso_editar" name="curso_editar" readonly="">   
                               </div>
                            </div>
                        </div>
                           <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="bloqueado" class="control-label">Email</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="email_editar" name="email_editar" readonly=""> 
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="bloqueado" class="control-label">Celular</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="celular_editar" name="celular_editar" readonly=""> 
                                </div>
                            </div>
                        </div>
                         <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="bloqueado" class="control-label">Ano</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="ano_editar" name="ano_editar" readonly=""> 
                                </div>
                            </div>
                        </div>
                         <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="bloqueado" class="control-label">Semestre</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="semestre_editar" name="semestre_editar" readonly=""> 
                                </div>
                            </div>
                        </div>
                         <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="bloqueado" class="control-label">Turno</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="turno_editar" name="turno_editar" readonly=""> 
                                </div>
                            </div>
                        </div>
                             <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="bloqueado" class="control-label">Declaração / Foto</label>
                                <div class="controls">
                                    <a href="" name="declaracao" id="declaracao"> Declaração</a> /
                                    <a href="" name="foto_editar" id="foto_editar"> Foto </a>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <a class="btn btn-primary" data-toggle="modal" href="#modalConfirmar">Aprovar</a>
                             <a class="btn btn-danger" data-toggle="modal" href="#modalRejeitar">Rejeitar</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal" onclick="limpaModalAlterar()">Fechar</button>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- Modal Incluir -->
    <div class="modal fade col-xs-12" id="modalConfirmar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Incluir Atleta</h4>
                </div>
                
                <div class="modal-body">
                        Deseja incluir este registro?
                </div>
                
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                    <button class="btn btn-primary" type="button" onclick="aprovar()"> Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Rejeitar -->
    <div class="modal fade col-xs-12" id="modalRejeitar" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Negar Atleta</h4>
                </div>
                
                <div class="modal-body">
                        Deseja negar este registro?
                </div>
                
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                    <button class="btn btn-danger" type="button" onclick="reprovar()"> Confirmar</button>
                </div>
            </div>
        </div>
    </div>


<div id="retornocadastro">
</div> 
<!--        Modal Add  End       -->


<!--        FOOTER        -->
<?php include("../../views/includes/footer.php");?>

<script src="../../js/laf/atletapendente.js" type="text/javascript"></script>

</body>
</html>