<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

include($raiz.'/models/model_validacao.php');

$validate = new validacao;

session_start();

$validate ->ExisteSessao();

$validate ->ValidaSessao($_SESSION['usuarioid']);

$validate ->ValidarPermissao($_SESSION['usuarioid'],6);

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
                            <a href="#"><i class="fa fa-tasks"></i>Delegados</a>
                        </li>
                        <li class="active">
                            <strong><i class="fa fa-user"></i>Alterar Atletas</strong>
                        </li>
                    </ol>

                </div>
            </div>            
            
            <div class="clearfix"></div>
            <!-- MAIN CONTENT AREA STARTS -->            

            <div class="col-lg-12">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Alterar Atletas</h2>
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
                                            <th>Situação</th>
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



<div id="retornocadastro">
</div> 
<!--        Modal Add  End       -->
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
                                <label for="bloqueado" class="control-label">Foto/RG</label>
                                <div class="controls">
                                    <input type="file" class="form-control" id="foto_editar" name="foto_editar"> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <a class="btn btn-primary" data-toggle="modal" onclick="salvar()">Alterar</a>
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

<!--        FOOTER        -->
<?php include("../../views/includes/footer.php");?>

<script src="../../js/delegado/alteraratleta.js" type="text/javascript"></script>

</body>
</html>