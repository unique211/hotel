<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
    <!-- SEARCH
    <li class="xn-search">
        <form role="form">
            <input type="text" name="search" placeholder="Search..."/>
        </form>
    </li>
     END SEARCH -->

    <!-- PROFILE -->
    <!-- <li class="pull-right">
        <a href="#" style="padding-left:50px;margin-right:30px"><img class="thumbnail-img" src="assets/assets/images/users/no-image.jpg" alt="User"/></a>
        <div class="panel panel-primary animated zoomIn xn-drop-left">
            <div class="panel-body">

              <div class="profile">
                  <div class="profile-data">
                      <div class="profile-data-name"></div>
                      <div class="profile-data-id"></div>
                      <div class="profile-data-title"></div>
                      <div class="profile-data-title"></div>
                  </div>
              </div>

            </div>

        </div>

    </li> -->

    <li class="pull-right">
        <a tabindex="-1"
            style="height:30px; width:30px; margin-top:10px;padding-top:6px;padding-left:5px;margin-right:20px; margin-left:20px"
            class="main-link btn-danger btn-sm" href="{{ url('/logout') }}" data-toggle="tooltip" title="Logout!">
            <i class="fa fa-power-off fa-sm txt-white"></i>

        </a>
    </li>
    <?php

    ?>
    <li style="float:right;margin-top:10px;color:#ffffff;" class="pull-right">
        <div class="profile-user-name"><b>Welcome <?php echo Session::get('userid');?></b></div>
    </li>
    <!-- END PROFILE -->
    <!-- SETTINGS -->
    <!-- <li class="pull-right">
        <a href="#"><span class="fa fa-gear"></span> Settings</a>
    </li> -->
    <!-- END SETTINGS -->
    <!-- MESSAGES -->
    <!-- <li class="xn-icon-button pull-right">
        <a href="#"><span class="fa fa-bell"></span></a>
        <div class="informer informer-danger">4</div>
        <div class="panel panel-primary animated zoomIn xn-drop-right xn-panel-dragging" style="width:250px;">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-bell"></span> Notifications</h3>
                <div class="pull-right">
                    <span class="label label-danger">4 new</span>
                </div>
            </div>
            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;overflow:auto;">
                <a href="#" class="list-group-item">
                    <div class="list-group-status status-online"></div>
                    <span class="contacts-title">John Doe</span>
                    <p>Praesent placerat tellus id augue condimentum</p>
                </a>
                <a href="#" class="list-group-item">
                    <div class="list-group-status status-away"></div>
                    <span class="contacts-title">Dmitry Ivaniuk</span>
                    <p>Donec risus sapien, sagittis et magna quis</p>
                </a>
                <a href="#" class="list-group-item">
                    <div class="list-group-status status-away"></div>
                    <span class="contacts-title">Nadia Ali</span>
                    <p>Mauris vel eros ut nunc rhoncus cursus sed</p>
                </a>
                <a href="#" class="list-group-item">
                    <div class="list-group-status status-offline"></div>
                    <span class="contacts-title">Darth Vader</span>
                    <p>I want my money back!</p>
                </a>
            </div>
            <div class="panel-footer text-center">
                <a href="pages-messages.html">Show all notifications</a>
            </div>
        </div>
    </li> -->
    <!-- END MESSAGES -->
</ul>
