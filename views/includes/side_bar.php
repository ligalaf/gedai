<div class="page-sidebar fixedscroll">

    <!-- MAIN MENU - START -->
    <div class="page-sidebar-wrapper" id="main-menu-wrapper">

        <!-- USER INFO - START -->
        <div class="profile-info row">

            <div class="profile-image col-xs-4">
                <img alt="" src="/images/avatar/<?php echo $_SESSION['avatar'];?>" class="img-responsive img-circle">
            </div>

            <div class="profile-details col-xs-8">

                <h3>
                    <a href="ui-profile.html"><?php echo $_SESSION['usuarionome'];?></a>

                    
                    <span class="profile-status online"></span>
                </h3>

                <p class="profile-title"><?php echo $_SESSION['tipo'];?></p>

            </div>

        </div>
        <!-- USER INFO - END -->

        <ul class='wraplist'>
          <div id="menu">
          </div>
        </ul>

    </div>
    <!-- MAIN MENU - END -->
</div>
<script src="/js/jquery-1.11.2.min.js" type="text/javascript"></script> 
<script src="/js/default/menu.js" type="text/javascript"></script> 