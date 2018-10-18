<div class='page-topbar '>
    <div class='logo-area'>

    </div>
    <div class='quick-area'>
        <div class='pull-left'>
            <ul class="info-menu left-links list-inline list-unstyled">
                <li class="sidebar-toggle-wrap">
                    <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>      
        <div class='pull-right'>
            <ul class="info-menu right-links list-inline list-unstyled">
                <li class="profile">
                    <a href="#" data-toggle="dropdown" class="toggle">
                        <img src="/images/avatar/<?php echo $_SESSION['avatar'];?>" alt="user-image" class="img-circle img-inline">
                        <span><?php echo $_SESSION['usuarionome'];?> <i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="dropdown-menu profile animated fadeIn">
                        <li>
                            <form method="post" name="form">
                            <input type="hidden" name="idAlterarmenu" id="idAlterarmenu" value="<?php echo  $_SESSION['usuarioid'];?>">
                             </form>
                            <a href="#" onclick='preencheridAlterarMenu()'>
                                <i class="fa fa-user"></i>
                                Perfil
                            </a>
                        </li>
                        <li>
                            <a href="/call/default/logout.php">
                                <i class="fa fa-lock"></i>
                                Logout
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>           
        </div>      
    </div>

</div>
<!-- END TOPBAR -->

<!--        Modal Editar        -->
<div class="modal fade col-xs-12" id="modalEditarMenu" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="width: 100%;">
        <form name="editarusuariomenu" id="editarusuariomenu" method="POST" enctype="multipart/form-data">
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
                                    <input type="hidden" name="idAlterar_menu" id="idAlterar_menu">
                                    <input type="text" class="form-control" id="nome_editar_menu" name="nome_editar_menu">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="senha" class="control-label">Senha</label>
                                <div class="controls input-group">
                                    <input type="password" class="form-control" id="senha_editar_menu" name="senha_editar_menu">
                                    <span class="input-group-addon" id="olho_editar_menu">
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
                                    <input type="file" class="form-control" id="foto_editar_menu" name="foto_editar_menu">
                                    <p class="help-block">Jpeg, Jpg, Png, Gif ou Bmp.</p>
                                    <img id="avatar_editar_menu" data-src="holder.js/180x180" src="" alt="Avatar">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" id="btneditarmenu" name="btneditarmenu" onclick="alterarmenu()">Salvar</button>
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
    <script src="/js/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script src="/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="../../js/laf/usuariomenu.js" type="text/javascript"></script>
