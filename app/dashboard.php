<!DOCTYPE html>
<html>

<head>
    <title>Dashboard | CMSC-207 - Group B - Login Module</title>
    <link rel="stylesheet" href="assets/lib/onsenui/css/onsenui.css">
    <link rel="stylesheet" href="assets/lib/onsenui/css/onsen-css-components.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/lib/onsenui/js/onsenui.min.js"></script>
    <script src="assets/lib/jquery/js/jquery.min.js"></script>
    <script src="assets/js/common.js"></script>
    <script src="assets/js/admin.js"></script>






</head>

<body>
  <?php
    session_start();
    if (!isset($_SESSION['user'])) { header('Location: login.php'); }
  ?>
<ons-splitter>
    <ons-splitter-side id="menu" side="left" width="220px" collapse swipeable>
      <ons-page>
        <ons-list>
          <ons-list-item onclick="location.href = 'dashboard.php';" tappable>
            Dashboard  
          </ons-list-item>
          <ons-list-item onclick="location.href = 'change.php';" tappable>
            Change Password
          </ons-list-item>
          <ons-list-item onclick="logout(true)" tappable>
            Logout
          </ons-list-item>
        </ons-list>
      </ons-page>
    </ons-splitter-side>
    <ons-splitter-content id="content" page="home"></ons-splitter-content>
  </ons-splitter>
    <template id="home">
        <ons-page>
            <ons-toolbar>
                <div class="left">
                    <ons-toolbar-button onclick="fn.open()">
                      <img class="logoBorder" src="assets/images/upoulogo.png" alt="UPOU Logo">
                    </ons-toolbar-button>
                </div>
                <div class="center">Dashboard</div>
                <div class="right">
                  <div id="currentUser" style="margin-right: 10px;"></div>
                </div>
            </ons-toolbar>

            <div style="margin: 10px;">   
              <ons-button id="registerButton" onclick="location.href = 'register.php?mode=add';" style="visibility: hidden;">Register New User</ons-button>          
            </div>

            <div style="text-align: center; margin-top: 30px;">      
                <div id="userDetail" style="visibility: hidden;"></div>        
                <ons-list id="usersList" modifier="inset" style="visibility: hidden;" onload="loadUsers(this)">
                    <ons-list-header>Users</ons-list-header>
                </ons-list>
            </div>
            <div class="footer">
              <p><small>&copy; CMSC-207 - Group B - Login Module</small></p>
            </div>
        </ons-page>
    </template>
    <ons-modal direction="up">
      <div style="text-align: center">
        <p>
          <ons-icon icon="md-spinner" size="28px" spin></ons-icon>
        </p>
      </div>
    </ons-modal>
</body>

</html>