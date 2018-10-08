
<?php



include('models/model_validacao.php');

$validate = new validacao;

session_start();

$validate ->ExisteSessao();

$validate ->ValidaSessao($_SESSION['usuarioid']);

?>
<?php include("views/includes/header.php");?>

<?php include("views/includes/top_bar.php");?>   
    
<div class="page-container row-fluid container-fluid">

    <?php include("views/includes/side_bar.php");?>

    <section id="main-content" class="">
        <section class="wrapper main-wrapper row" style=''>

            <div class='col-xs-12'>
                <div class="page-title">
                    <ol class="breadcrumb primary">
                        <li class="active">
                            <strong><i class="fa fa-home"></i>Início</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="col-lg-12">
                <section class="box nobox marginBottom0">
                    <div class="content-body">
                        <div class="row">

                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="r4_counter db_box">
                                    <i class='pull-left fa fa-thumbs-up icon-md icon-rounded icon-primary'></i>
                                    <div class="stats">
                                        <h4><strong>45%</strong></h4>
                                        <span>New Orders</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="r4_counter db_box">
                                    <i class='pull-left fa fa-shopping-cart icon-md icon-rounded icon-accent'></i>
                                    <div class="stats">
                                        <h4><strong>243</strong></h4>
                                        <span>New Products</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="r4_counter db_box">
                                    <i class='pull-left fa fa-dollar icon-md icon-rounded icon-purple'></i>
                                    <div class="stats">
                                        <h4><strong>$3424</strong></h4>
                                        <span>Profit Today</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="r4_counter db_box">
                                    <i class='pull-left fa fa-users icon-md icon-rounded icon-warning'></i>
                                    <div class="stats">
                                        <h4><strong>1433</strong></h4>
                                        <span>New Users</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- End .row -->
                    </div>
                </section>
            </div>
            <!-- END CONTENT -->
        </section>
    </section>
    <!-- CHAT <?php //include("../../views/includes/chat.php");?> -->
</div>

<?php include("views/includes/footer.php");?>

</body>
</html>
