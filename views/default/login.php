<!DOCTYPE html>
<html class="">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Faça seu Login!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />


        <!-- CORE CSS FRAMEWORK - START -->
        <link href="/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="/css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS FRAMEWORK - END -->

        <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        
        <link href="/plugins/messenger/css/messenger.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="/plugins/messenger/css/messenger-theme-future.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="/plugins/messenger/css/messenger-theme-flat.css" rel="stylesheet" type="text/css" media="screen"/>

        <!-- HEADER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE CSS TEMPLATE - START -->
        <link href="/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="/css/responsive.css" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS TEMPLATE - END -->

    </head>
    
<body class="login_page">
 <div id="loaderModal">
        <i class="fa fa-spinner blue"></i>
    </div>


    <div class="container-fluid">
        <div class="login-wrapper row">
            <div id="login" class="login loginpage col-lg-offset-4 col-md-offset-3 col-sm-offset-3 col-xs-offset-0 col-xs-12 col-sm-6 col-lg-4">
                <h1><a href="#" title="Login Page" tabindex="-1">Consome Dados</a></h1>

                <form enctype="multipart/form-data" name="form_login" id="form_login" action="" method="post">
                    <p>
                        <label for="user_pass">Email<br />
                        <input type="text" name="user" id="user" class="input" size="20" /></label>
                    </p>
                    <p>
                        <label for="user_pass">Senha<br />
                        <input type="password" name="senha" id="senha" class="input" size="20" /></label>
                    </p>
                    <p class="submit">
                        <input type="button" name="wp-submit" id="wp-submit" class="btn btn-accent btn-block" value="Logar" onclick="logar()" />
                    </p>
                     <p>
                      <a data-toggle ="modal" href ="#modalAdd">
                            <i class="ace-icon fa fa-arrow-left"></i>
                            Solicitar Cadastro
                      </a>  
                        
                    </p>
                    <p>
                      <a href="#" data-target="#forgot-box" class="forgot-password-link">
                            <i class="ace-icon fa fa-arrow-left"></i>
                             Esqueceu a senha?
                        </a>  

                    </p>
                </form>

            </div>
        </div>
    </div>
    <div id="retornochamada" name="retornochamada">
    </div>
    <!--        Modal Add        -->
<div class="modal fade col-xs-12" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 100%;">
        <form enctype="multipart/form-data" name="cadastroFornecedor" id="cadastroFornecedor" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Solicitar Cadastro</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="razao" class="control-label">Razão Social</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="razao" name="razao">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="nome" class="control-label">Nome Fantasia</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="nome" name="nome">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="cnpj" class="control-label">CNPJ</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="cnpj" name="cnpj" data-mask="99.999.999/9999-99">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="ie" class="control-label">Inscrição Estadual</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="ie" name="ie">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="cep" class="control-label">Cep</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="cep" name="cep" data-mask="99999-999">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="logradouro" class="control-label">Logradouro</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="logradouro" name="logradouro">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="numero" class="control-label">Número</label>
                                <div class="controls">
                                    <input type="number" class="form-control" id="numero" name="numero">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="bairro" class="control-label">Bairro</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="bairro" name="bairro">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="complemento" class="control-label">Complemento</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="complemento" name="complemento">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="cidade" class="control-label">Cidade</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="cidade" name="cidade">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="estado" class="control-label">Estado</label>
                                <div class="controls">
                                    <select class="form-control" name="estado" id="estado">
                                        <option value="AC">Acre</option>
                                        <option value="AL">Alagoas</option>
                                        <option value="AP">Amapá</option>
                                        <option value="AM">Amazonas</option>
                                        <option value="BA">Bahia</option>
                                        <option value="CE">Ceará</option>
                                        <option value="DF">Distrito Federal</option>
                                        <option value="ES">Espírito Santo</option>
                                        <option value="GO">Goiás</option>
                                        <option value="MA">Maranhão</option>
                                        <option value="MT">Mato Grosso</option>
                                        <option value="MS">Mato Grosso do Sul</option>
                                        <option value="MG">Minas Gerais</option>
                                        <option value="PA">Pará</option>
                                        <option value="PB">Paraíba</option>
                                        <option value="PR">Paraná</option>
                                        <option value="PE">Pernambuco</option>
                                        <option value="PI">Piauí</option>
                                        <option value="RJ">Rio de Janeiro</option>
                                        <option value="RN">Rio Grande do Norte</option>
                                        <option value="RS">Rio Grande do Sul</option>
                                        <option value="RO">Rondônia</option>
                                        <option value="RR">Roraima</option>
                                        <option value="SC">Santa Catarina</option>
                                        <option value="SP">São Paulo</option>
                                        <option value="SE">Sergipe</option>
                                        <option value="TO">Tocantins</option>
                                        <option value="Carregando..." hidden>Carregando...</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="telefone" class="control-label">Telefone</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="telefone" data-mask="(99)99999-9999" name="telefone">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <div class="controls">
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="email" class="control-label">Logo</label>
                               <div class="controls">
                                    <input type="file" class="form-control" id="foto" name="foto">
                                    <p class="help-block">Jpeg, Jpg, Png, Gif ou Bmp.</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btncadastrar" name="btncadastrar" onclick="cadastrarsolicitacao()">Solicitar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
                </div>
                <div id="retornocadastro">
                </div> 
            </div>
        </form>
    </div>
</div>

    <!-- CORE JS FRAMEWORK - START --> 
    <script src="/js/jquery-1.11.2.min.js" type="text/javascript"></script> 
    <script src="/js/jquery.easing.min.js" type="text/javascript"></script> 
    <script src="/js/jquery.validate.min.js" type="text/javascript"></script>  
    <script src="/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
    <script src="/plugins/pace/pace.min.js" type="text/javascript"></script>  
    <script src="/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script> 
    <script src="/plugins/viewport/viewportchecker.js" type="text/javascript"></script>  
    <script>window.jQuery||document.write('<script src="/js/jquery-1.11.2.min.js"><\/script>');</script>
    <!-- CORE JS FRAMEWORK - END -->


    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
    <script src="/plugins/messenger/js/messenger.min.js" type="text/javascript"></script>
    <script src="/plugins/messenger/js/messenger-theme-future.js" type="text/javascript"></script>
    <script src="/plugins/messenger/js/messenger-theme-flat.js" type="text/javascript"></script>
    <script src="/js/messenger.js" type="text/javascript"></script>
     <!-- Start Input Mask Plugin -->
    <script src="/plugins/autonumeric/autoNumeric-min.js" type="text/javascript"></script>
    <script src="/plugins/inputmask/min/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
    <!-- End Input Mask Plugin -->
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


    <!-- CORE TEMPLATE JS - START --> 
    <script src="/js/scripts.js" type="text/javascript"></script> 
    <!-- END CORE TEMPLATE JS - END --> 
    <script src="/js/default/login.js" type="text/javascript"></script> 
  

</body>
</html>
