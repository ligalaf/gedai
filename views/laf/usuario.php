<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

include($raiz.'/models/model_validacao.php');

$validate = new validacao;

session_start();

$validate ->ExisteSessao();

$validate ->ValidaSessao($_SESSION['usuarioid']);

$validate ->ValidarPermissao($_SESSION['usuarioid'],2);

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
                            <strong><i class="fa fa-user"></i>Usuários</strong>
                        </li>
                    </ol>

                </div>
            </div>            
            
            <div class="clearfix"></div>
            <!-- MAIN CONTENT AREA STARTS -->            

            <div class="col-lg-12">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Usuários</h2>
                        <div class="actions panel_actions pull-right">
                        </div>
                    </header>
                    
                    <div class="content-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="dt-buttons" align="right">
                                    <a name="preencheCampos" id="preencheCampos" data-toggle ="modal" href ="#modalUsuario">
                                        <button class="btn btn-success" title="Adicionar">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                    
                                </div>
                                <br>
                                <table class="display responsive" style="width:100%;" id="usuarioTable">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Nome</th>
                                            <th>Unidade</th>
                                            <th>Email</th>
                                            <th>Tipo</th>
                                            <th>Ação</th>
                                            <th>Permissões</th>
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
<div class="modal fade col-xs-12" id="modalEditar" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 100%;">
        <form name="editarusuario" id="editarusuario" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpaModalAlterar()">&times;</button>
                    <h4 class="modal-title">Editar Dados de Usuário</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Nome</label>
                                <div class="controls">
                                    <input type="hidden" name="idAlterar" id="idAlterar">
                                    <input type="text" class="form-control" id="nome_editar" name="nome_editar">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <div class="controls">
                                    <input type="email" class="form-control" id="email_editar" name="email_editar">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="senha" class="control-label">Senha</label>
                                <div class="controls input-group">
                                    <input type="password" class="form-control" id="senha_editar" name="senha_editar">
                                    <span class="input-group-addon" id="olho_editar">
                                        <span class="arrow"></span>
                                        <i class="fa fa-eye-slash olho"></i>     
                                     </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="bloqueado" class="control-label">Bloqueado</label>
                                <div class="controls">
                                    <select class="form-control" id="bloqueado_editar" name="bloqueado_editar">
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                           <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="bloqueado" class="control-label">Tipo</label>
                                <div class="controls">
                                    <select class="form-control" id="tipo_editar" name="tipo_editar">
                                        <option value="LAF">LAF</option>
                                        <option value="Delegado">Delegado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="bloqueado" class="control-label">Unidade</label>
                                <div class="controls">
                                    <select class="form-control" id="unidade_editar" name="unidade_editar">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="foto" class="control-label">Foto</label>
                                <div class="controls">
                                    <input type="file" class="form-control" id="foto_editar" name="foto_editar">
                                    <p class="help-block">Jpeg, Jpg, Png, Gif ou Bmp.</p>
                                    <img id="avatar_editar" data-src="holder.js/180x180" src="" alt="Avatar">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btneditar" name="btneditar" onclick="alterar()">Salvar</button>
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

<!-- Modal Excluir -->
<form name="excluiusuario" id="excluiusuario" method="post">
    <div class="modal fade col-xs-12" id="modalExcluir" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Excluir Usuário</h4>
                </div>
                
                <div class="modal-body">
                        Deseja Excluir este registro?
                    <input type="hidden" name="idExcluir" id="idExcluir">
                </div>
                
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                    <button class="btn btn-danger" type="button" onclick="excluir()"> Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div id="retornocadastro">
</div> 
<!--        Modal Add  End       -->

<!--        FOOTER        -->
<?php include("../../views/includes/footer.php");?>

<script src="../../js/laf/usuario.js" type="text/javascript"></script>

</body>
</html>