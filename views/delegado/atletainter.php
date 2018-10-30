<?php

$raiz = $_SERVER['DOCUMENT_ROOT'];

include($raiz.'/models/model_validacao.php');

$validate = new validacao;

session_start();

$validate ->ExisteSessao();

$validate ->ValidaSessao($_SESSION['usuarioid']);

$validate ->ValidarPermissao($_SESSION['usuarioid'],8);

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
                            <strong><i class="fa fa-user"></i>Selecionar Atletas Inter</strong>


                        </li>
                    </ol>

                </div>
            </div>            
            
            <div class="clearfix"></div>
            <!-- MAIN CONTENT AREA STARTS -->            

            <div class="col-lg-12">
                <section class="box ">
                    <header class="panel_header">
                        <h2 class="title pull-left">Selecionar Atletas Inter</h2>
                        <div class="actions panel_actions pull-right">
                        </div>
                    </header>
              <form method="post" id="formpacote" name="formpacote">   
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
                                            <th>Pacote</th>
                                            <th>Selecionar</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                    </tfoot>

                                    <tbody id="corpo">
                                    </tbody>
                                </table>
                                 <div class="controls">
                                    <button type="button" class="btn btn-primary" id="btncadastrar" name="btncadastrar" onclick="cadastrar()">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
     

                  </form>  
                </section>
            </div>
        </section>
    </section>
    <!-- CHAT <?php //include("../../views/includes/chat.php");?> -->
</div>




<div id="retornocadastro">
</div> 
<!--        Modal Add  End       -->


<!--        FOOTER        -->
<?php include("../../views/includes/footer.php");?>

<script src="../../js/delegado/listaatletainter.js" type="text/javascript"></script>

</body>
</html>